<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Genre;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function countries()
    {
        $countries = Country::where('status', true)->get();
        return view('pages.flag', compact('countries'));
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

    public function index()
    {
        $categories = Category::where('status', 'active')->get();
        $genres = Genre::with(['jobPostings' => function ($query) {
            $query->with(['employer', 'countries']) // Nạp cả employer và countries
                ->where('status', 'active')
                ->where('closing_date', '>', now())
                ->latest();
        }])->get();


        $countries = Country::where('status', 'active')->get(); // Lấy quốc gia từ bảng Country
        $employerIsPartner = Employer::where('isPartner', 1)->withCount('jobPostings')->get();
        return view('pages.home', compact('categories', 'genres', 'countries', 'employerIsPartner'));
    }

    public function genre($slug)
    {
        $genres = Genre::where('status', 'active')->get();
        $categories = Category::where('status', 'active')->get();
        $countries = Country::where('status', 'active')->get(); // Lấy quốc gia từ bảng Country
        // Tìm genre dựa trên slug
        $genre = Genre::where('slug', $slug)
            ->with(['jobPostings' => function ($query) {
                $query->with('employer')
                    ->where('status', 'active')
                    ->where('closing_date', '>', now())
                    ->latest();
            }])
            ->firstOrFail();
        return view('pages.genre', compact('genre', 'genres', 'categories', 'countries'));
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
