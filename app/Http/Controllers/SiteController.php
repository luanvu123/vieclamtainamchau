<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\Category;
use App\Models\CompanyPartner;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Genre;
use App\Models\JobPosting;
use App\Models\KeySearch;
use App\Models\LanguageTraining;
use App\Models\Location;
use App\Models\News;
use App\Models\OnlineVisitor;
use App\Models\RegisterStudy;
use App\Models\StudyAbroad;
use App\Models\TypeLanguageTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
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
    public function news()
    {
        $promotion = News::where('status', 1)->paginate(10);

        $bannerNews = Advertise::where('status', 1)->latest()->get(); // hoặc điều kiện tùy theo nhu cầu

        return view('pages.news', compact('promotion', 'bannerNews'));
    }

    public function newsDetail($id)
    {
        // Get the specific news
        $news = News::findOrFail($id);

        $bannerNews = Advertise::where('status', 1)->latest()->get();
        // Get related news (optional)
        $relatedNews = News::where('status', 1)
            ->where('id', '!=', $id)
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
            ->whereIn('service_type', ['Tin nổi bật', 'Tin đặc biệt'])
            ->with('employer')
            ->latest()
            ->paginate(12);

        return view('pages.country', compact('country', 'jobPostings', 'countries', 'categories'));
    }

    public function index(Request $request)
    {
        $categories = Category::where('status', 'active')->where('isHot', 0)->where('hot', 1)->get();

        // Lấy danh sách genres mà không kèm theo phân trang
        $genres = Genre::whereHas('jobPostings', function ($query) {
            $query->where('status', 'active')
                ->where('closing_date', '>', now())
                ->whereIn('service_type', ['Tin nổi bật', 'Tin đặc biệt']);
        })->get();

        // Tạo mảng để lưu trữ các jobs đã phân trang cho mỗi genre
        $paginatedJobsByGenre = [];

        // Với mỗi genre, truy vấn và phân trang jobs riêng biệt
        foreach ($genres as $genre) {
            $paginatedJobs = JobPosting::with(['employer', 'countries'])
                ->where('status', 'active')
                ->where('closing_date', '>', now())
                ->whereIn('service_type', ['Tin nổi bật', 'Tin đặc biệt'])
                ->whereHas('genres', function ($query) use ($genre) {
                    $query->where('genres.id', $genre->id);
                })
                ->latest()
                ->paginate(12, ['*'], 'genre_' . $genre->id); // Mỗi genre có một tên phân trang riêng

            $paginatedJobsByGenre[$genre->id] = $paginatedJobs;
        }

        $jobTitles = JobPosting::where('status', 'active')
            ->where('closing_date', '>', now())
            ->whereIn('service_type', ['Tin cơ bản', 'Tin nổi bật', 'Tin đặc biệt'])
            ->select('id', 'title', 'slug')
            ->get()
            ->toArray();

        // Tạo thư mục và file jobs.json
        $path = public_path() . "/json/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path . 'jobs.json', json_encode($jobTitles));

        OnlineVisitor::trackVisitor($request->ip());
        $countries = Country::where('status', 'active')->where('hot', 1)->get();
        $employerIsPartner = Employer::where('isPartner', 1)->withCount('jobPostings')->get();
        $studyAbroads = StudyAbroad::where('status', 1)
            ->with(['categories', 'countries'])
            ->get();

        // Fetch CompanyPartner data - limit to 18 active partners
        $companyPartners = CompanyPartner::where('status', 1)->take(18)->get();
        $keySearches = KeySearch::where('status', 1)->get();

        return view('pages.home', compact(
            'categories',
            'genres',
            'countries',
            'employerIsPartner',
            'studyAbroads',
            'companyPartners',
            'keySearches',
            'paginatedJobsByGenre'
        ));
    }
    public function genre($slug)
    {
        $genres = Genre::where('status', 'active')->get();
        $categories = Category::where('status', 'active')->get();
        $countries = Country::where('status', 'active')->get();

        // Lấy thông tin genre
        $genre = Genre::where('slug', $slug)->firstOrFail();

        // Lấy danh sách job postings với phân trang
        $jobPostings = $genre->jobPostings()
            ->with(['employer', 'countries'])
            ->where('status', 'active')
            ->where('closing_date', '>', now())
            ->whereIn('service_type', ['Tin cơ bản', 'Tin nổi bật', 'Tin đặc biệt'])
            ->latest()
            ->paginate(12); // Số lượng bài đăng mỗi trang, có thể điều chỉnh

        return view('pages.genre', compact('genre', 'genres', 'categories', 'countries', 'jobPostings'));
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
            ->whereIn('service_type', ['Tin cơ bản', 'Tin nổi bật', 'Tin đặc biệt'])
            ->latest()
            ->paginate(12);  // Thêm phân trang

        return view('pages.category', compact('category', 'categories', 'countries', 'jobPostings'));
    }
    public function getJobSuggestions(Request $request)
    {
        $keyword = $request->input('keyword');

        if (strlen($keyword) < 2) {
            return response()->json([]);
        }

        $suggestions = JobPosting::where('status', 'active')
            ->where('closing_date', '>', now())
            ->whereIn('service_type', ['Tin cơ bản', 'Tin nổi bật', 'Tin đặc biệt'])
            ->where('title', 'LIKE', "%{$keyword}%")
            ->select('title', 'slug')
            ->distinct('title')
            ->limit(10)
            ->get();

        return response()->json($suggestions);
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

        $jobPostings = $query->with('employer')
            ->where('status', 'active')
            ->where('closing_date', '>', now())
            ->whereIn('service_type', ['Tin cơ bản', 'Tin nổi bật', 'Tin đặc biệt'])
            ->latest()
            ->paginate(10);

        $categories = Category::where('status', 'active')->where('isHot', 0)->get();
        $countries = Country::where('status', 'active')->get();
        return view('pages.search', compact('jobPostings', 'categories', 'countries'));
    }




    public function studyShow($slug)
    {
        // Tìm bài viết theo slug với eager loading cho countries và categories
        $study = StudyAbroad::where('slug', $slug)
            ->where('status', 1)
            ->with(['countries', 'categories'])
            ->firstOrFail();

        // Lấy các bài viết liên quan cùng danh mục
        $relatedStudies = StudyAbroad::where('status', 1)
            ->whereHas('categories', function ($query) use ($study) {
                $query->whereIn('categories.id', $study->categories->pluck('id'));
            })
            ->where('id', '!=', $study->id)
            ->limit(3)
            ->get();

        return view('pages.studyabroad_detail', compact('study', 'relatedStudies'));
    }

    public function studyIndex(Request $request)
    {
        $query = StudyAbroad::where('status', 1)->with(['countries', 'categories']);

        if ($request->has('category_id') && $request->category_id != '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id); // Chỉ định rõ bảng categories
            });
        }

        if ($request->has('country_id') && $request->country_id != '') {
            $query->whereHas('countries', function ($q) use ($request) {
                $q->where('countries.id', $request->country_id); // Chỉ định rõ bảng countries
            });
        }

        $studyAbroads = $query->paginate(6);

        $categories = Category::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();

        return view('pages.studyabroad', compact('studyAbroads', 'categories', 'countries'));
    }

    public function indexLanguageTrainings()
    {
        $languageTrainings = LanguageTraining::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('pages.index_languageTrainings', compact('languageTrainings'));
    }

    public function detailLanguageTrainings($slug)
    {
        $training = LanguageTraining::where('slug', $slug)
            ->where('status', true)
            ->with('typeLanguageTraining')
            ->firstOrFail();

        return view('pages.detail_languageTrainings', compact('training'));
    }

    public function filterByType(TypeLanguageTraining $type)
    {
        $trainings = $type->languageTrainings()->where('status', true)->paginate(10);
        return view('pages.index_languageTrainings', compact('type', 'trainings'));
    }

}
