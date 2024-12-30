<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Genre;
use App\Models\JobPosting;
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
        return view('pages.hotline');
    }
    public function countries()
    {
        $countries = Country::where('status', true)->get();
        return view('pages.flag', compact('countries'));
    }
    public function news()
    {
        // Lấy tin tức được kích hoạt, sắp xếp mới nhất và phân trang
        $news = News::where('status', true)
                    ->orderBy('created_at', 'desc')
                    ->paginate(12); // 12 tin một trang

        // Lấy các tin nổi bật
        $outstandingNews = News::where('status', true)
                              ->where('isOutstanding', true)
                              ->orderBy('created_at', 'desc')
                              ->take(5) // Lấy 5 tin nổi bật
                              ->get();

        return view('pages.news', compact('news', 'outstandingNews'));
    }

    public function newsDetail($id)
    {
        try {
            // Lấy chi tiết tin tức
            $news = News::where('status', true)
                       ->findOrFail($id);

            // Lấy tin tức liên quan (cùng trạng thái active, không bao gồm tin hiện tại)
            $relatedNews = News::where('status', true)
                              ->where('id', '!=', $id)
                              ->latest()
                              ->take(6) // Lấy 6 tin liên quan
                              ->get();

            return view('pages.news-detail', compact('news', 'relatedNews'));

        } catch (\Exception $e) {
            abort(404); // Trả về trang 404 nếu không tìm thấy tin tức
        }
    }
    public function country($slug)
    {
        $country = Country::where('slug', $slug)->firstOrFail(); // Lấy quốc gia theo slug

        $jobPostings = $country->jobPostings()
            ->where('status', 'active')
            ->where('closing_date', '>', now())
            ->with('employer')
            ->latest()
            ->get();

        return view('pages.country', compact('country', 'jobPostings'));
    }

    public function index(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $genres = Genre::with(['jobPostings' => function ($query) {
            $query->with(['employer', 'countries']) // Nạp cả employer và countries
                ->where('status', 'active')
                ->where('closing_date', '>', now())
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
    $categories = Category::where('status', 'active')->get();
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

        $categories = Category::where('status', 'active')->get();

        return view('pages.job', compact('jobPosting', 'categories', 'orderJob'));
    }
  public function category($slug)
{
    $categories = Category::where('status', 'active')->get();
    $countries = Country::where('status', 'active')->get();

    // Sửa lại phần query để lấy jobPostings
    $category = Category::where('slug', $slug)
        ->where('status', 'active')
        ->firstOrFail();

    $jobPostings = JobPosting::whereHas('categories', function($query) use ($category) {
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

        $categories = Category::where('status', 'active')->get();
        $countries = Country::where('status', 'active')->get();
        return view('pages.search', compact('jobPostings', 'categories', 'countries'));
    }
}
