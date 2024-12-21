<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function countries()
    {
        $countries = Country::where('status', true)->get();
        return view('pages.country', compact('countries'));
    }

    public function index()
    {
        $categories = Category::where('status', 'active')->get();
        $genres = Genre::with(['jobPostings' => function ($query) {
            $query->with('employer')
                ->where('status', '1')
                ->where('closing_date', '>', now())
                ->latest();
        }])->get();
        return view('pages.home', compact('categories', 'genres'));
    }
 public function genre($slug)
{
     $categories = Category::where('status', 'active')->get();
    // Tìm genre dựa trên slug
    $genre = Genre::where('slug', $slug)
        ->with(['jobPostings' => function ($query) {
            $query->with('employer')
                ->where('status', '1')
                ->where('closing_date', '>', now())
                ->latest();
        }])
        ->firstOrFail();
    return view('pages.genre', compact('genre','categories'));
}
public function job($slug)
{
    // Tìm JobPosting dựa trên slug
    $jobPosting = JobPosting::where('slug', $slug)
        ->with('employer') // Lấy thông tin employer liên quan
        ->firstOrFail(); // Trả về 404 nếu không tìm thấy

    // Lấy danh mục (nếu cần thiết cho thanh điều hướng)
    $categories = Category::where('status', 'active')->get();

    // Trả về view với dữ liệu
    return view('pages.job', compact('jobPosting', 'categories'));
}

}
