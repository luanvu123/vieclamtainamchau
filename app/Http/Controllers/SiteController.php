<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Genre;
use App\Models\JobPosting;
use App\Models\Location;
use App\Models\News;
use App\Models\OnlineVisitor;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }
    public function hotline()
    {
        $locations = Location::where('status', 'active')->orderBy('updated_at', 'desc')->get();
        $defaultLocation = $locations->first(); // Lấy địa điểm mới nhất

        return view('pages.hotline', compact('locations', 'defaultLocation'));
    }
    public function getLocations()
    {
        $locations = Location::where('status', 'active')->get();
        return response()->json($locations);
    }
    public function countries()
    {
        $categories = Category::where('status', 'active')->where('isHot', 0)->get();
        $countries = Country::where('status', true)->get();
        return view('pages.flag', compact('countries', 'categories'));
    }
    public function news()
    {
        // Get featured/outstanding news
        $outstandingNews = News::where('status', 1)
            ->where('isOutstanding', 1)
            ->first();
        $promotion = News::where('status', 1)
            ->where('isOutstanding', 1)
            ->take(3)
            ->get();

        $newsList = News::where('status', 1)
            ->where('isOutstanding', 0)
            ->where('isBanner', 0)
            ->paginate(6); // Show 6 items per page

        // Get banner news
        $bannerNews = News::where('status', 1)
            ->where('isBanner', 1)
            ->get();

        return view('pages.news', compact('outstandingNews', 'newsList', 'bannerNews', 'promotion'));
    }

    public function newsDetail($id)
    {
        // Get the specific news
        $news = News::findOrFail($id);

        // Get banner news for right sidebar
        $bannerNews = News::where('status', 1)
            ->where('isBanner', 1)
            ->get();

        // Get related news (optional)
        $relatedNews = News::where('status', 1)
            ->where('id', '!=', $id)
            ->where('isOutstanding', 0)
            ->where('isBanner', 0)
            ->take(5)
            ->get();

        return view('pages.news-detail', compact('news', 'bannerNews', 'relatedNews'));
    }
    public function country($slug)
    {
        $country = Country::where('slug', $slug)->firstOrFail(); // Lấy quốc gia theo slug
        $categories = Category::where('status', 'active')->where('isHot', 0)->get();
        $countries = Country::where('status', true)->get();
        $jobPostings = $country->jobPostings()
            ->where('status', 'active')
            ->where('closing_date', '>', now())
            ->with('employer')
            ->latest()
            ->get();

        return view('pages.country', compact('country', 'jobPostings', 'countries', 'categories'));
    }

    public function index(Request $request)
    {
        $categories = Category::where('status', 'active')->where('isHot', 0)->get();
        $genres = Genre::with(['jobPostings' => function ($query) {
            $query->with(['employer', 'countries'])
                ->where('status', 'active')
                ->where('closing_date', '>', now())
                 ->whereHas('employer', function ($query) {
                $query->where('IsHome', 1); // Filter job postings where employer IsHome is 1
            })
                ->latest();
        }])->get();
        OnlineVisitor::trackVisitor($request->ip());
        $countries = Country::where('status', 'active')->get(); // Lấy quốc gia từ bảng Country
        $employerIsPartner = Employer::where('isPartner', 1)->withCount('jobPostings')->get();
        return view('pages.home', compact('categories', 'genres', 'countries', 'employerIsPartner',));
    }

    public function genre($slug)
    {
        $genres = Genre::where('status', 'active')->get();
        $categories = Category::where('status', 'active')->where('isHot', 0)->get();
        $countries = Country::where('status', 'active')->get();

        $genre = Genre::where('slug', $slug)
            ->with(['jobPostings' => function ($query) {
                $query->with(['employer', 'countries'])
                    ->where('status', 'active')
                    ->where('closing_date', '>', now())
                    ->latest();
            }])
            ->firstOrFail();

        // Nhóm jobs theo country
        $jobsByCountry = collect();
        foreach ($genre->jobPostings as $job) {
            foreach ($job->countries as $country) {
                if (!$jobsByCountry->has($country->id)) {
                    $jobsByCountry[$country->id] = collect();
                }
                $jobsByCountry[$country->id]->push($job);
            }
        }

        return view('pages.genre', compact('genre', 'genres', 'categories', 'countries', 'jobsByCountry'));
    }
    public function job($slug)
    {
        $jobPosting = JobPosting::where('slug', $slug)
            ->with('employer')
            ->firstOrFail();
        $jobPosting->increment('views');
        $orderJob = JobPosting::where('employer_id', $jobPosting->employer_id)
            ->where('slug', '!=', $slug)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $categories = Category::where('status', 'active')->where('isHot', 0)->get();

        return view('pages.job', compact('jobPosting', 'categories', 'orderJob'));
    }
    public function category($slug)
    {
        $categories = Category::where('status', 'active')->where('isHot', 0)->get();
        $countries = Country::where('status', 'active')->get();

        // Sửa lại phần query để lấy jobPostings
        $category = Category::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $jobPostings = JobPosting::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })
            ->with('employer')
            ->where('status', 'active')
            ->where('closing_date', '>', now())
            ->latest()
            ->paginate(12);  // Thêm phân trang

        return view('pages.category', compact('category', 'categories', 'countries', 'jobPostings'));
    }
    public function search(Request $request)
    {
        $query = JobPosting::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('country')) {
            $query->whereHas('countries', function ($q) use ($request) {
                $q->where('slug', $request->country);
            });
        }

        $jobPostings = $query->with('employer')->where('status', 'active')->paginate(10);

        $categories = Category::where('status', 'active')->where('isHot', 0)->get();
        $countries = Country::where('status', 'active')->get();
        return view('pages.search', compact('jobPostings', 'categories', 'countries'));
    }
}
