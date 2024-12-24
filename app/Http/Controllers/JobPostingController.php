<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\JobPosting;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JobPostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('employer');
    }

    public function index()
    {
        $employer = Auth::guard('employer')->user();
        $jobPostings = JobPosting::where('employer_id', $employer->id)->get();

        return view('employer.job-posting.index', compact('jobPostings'));
    }
    public function create()
    {
        $categories = Category::all(); // Lấy danh sách danh mục
        $countries = Country::all(); // Lấy danh sách quốc gia
        $genres = Genre::all(); // Lấy danh sách thể loại
        $employer = Auth::guard('employer')->user();

        return view('employer.job-posting.create', compact('categories', 'countries', 'employer', 'genres'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime,intern,freelance',
            'age_range' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'application_email_url' => 'required|email|max:255',
            'closing_date' => 'nullable|date',
            'salary' => 'nullable|string|max:50',
            'experience' => 'nullable|in:Không yêu cầu,1 năm,2 năm,3 năm,4 năm,5 năm,5+ năm',
            'rank' => 'nullable|string|max:100',
            'number_of_recruits' => 'nullable|integer',
            'sex' => 'nullable|string|max:50',
            'skills_required' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'countries' => 'nullable|array',
            'countries.*' => 'exists:countries,id',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $jobPosting = JobPosting::create([
            'employer_id' => auth('employer')->id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'type' => $validated['type'],
            'age_range' => $validated['age_range'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'application_email_url' => $validated['application_email_url'],
            'closing_date' => $validated['closing_date'],
            'salary' => $validated['salary'],
            'experience' => $validated['experience'],
            'rank' => $validated['rank'],
            'number_of_recruits' => $validated['number_of_recruits'],
            'sex' => $validated['sex'],
            'skills_required' => $validated['skills_required'],
        ]);

        if (!empty($validated['categories'])) {
            $jobPosting->categories()->sync($validated['categories']);
        }

        if (!empty($validated['countries'])) {
            $jobPosting->countries()->sync($validated['countries']);
        }
        if (!empty($validated['genres'])) {
            $jobPosting->genres()->sync($validated['genres']);
        }
        return redirect()->route('employer.job-posting.index')
            ->with('success', 'Bài đăng tuyển dụng đã được tạo thành công.');
    }
    public function edit($id)
    {
        $jobPosting = JobPosting::with(['categories', 'countries', 'genres'])->findOrFail($id);
        $employer = auth()->user();

        // Check if the job posting belongs to the authenticated employer
        if ($jobPosting->employer_id !== $employer->id) {
            return redirect()->route('employer.job-posting.index')
                ->with('error', 'Bạn không có quyền chỉnh sửa bài đăng này');
        }

        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();

        return view('employer.job-posting.edit', compact(
            'jobPosting',
            'employer',
            'categories',
            'countries',
            'genres'
        ));
    }

    public function update(Request $request, $id)
    {
        $jobPosting = JobPosting::findOrFail($id);

        // Check if the job posting belongs to the authenticated employer
        if ($jobPosting->employer_id !== auth()->id()) {
            return redirect()->route('employer.job-posting.index')
                ->with('error', 'Bạn không có quyền cập nhật bài đăng này');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime,intern,freelance',
            'age_range' => 'nullable|string|max:50',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:50',
            'rank' => 'required|string|max:50',
            'number_of_recruits' => 'required|integer|min:1',
            'sex' => 'required|string|max:20',
            'skills_required' => 'nullable|string',
            'description' => 'required|string',
            'application_email_url' => 'required|email',
            'closing_date' => 'required|date|after:today',
            'salary' => 'required|string|max:100',
            'categories' => 'required|array|exists:categories,id',
            'countries' => 'required|array|exists:countries,id',
            'genres' => 'required|array|exists:genres,id'
        ]);

        try {
            DB::beginTransaction();

            // Update job posting
            $jobPosting->update($validated);

            // Sync relationships
            $jobPosting->categories()->sync($request->categories);
            $jobPosting->countries()->sync($request->countries);
            $jobPosting->genres()->sync($request->genres);

            DB::commit();

            return redirect()->route('employer.job-posting.index')
                ->with('success', 'Cập nhật bài đăng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật bài đăng: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $jobPosting = JobPosting::findOrFail($id);

            // Kiểm tra xem bài đăng có thuộc về nhà tuyển dụng đang đăng nhập hay không
            if ($jobPosting->employer_id !== auth('employer')->id()) {
                return redirect()->route('employer.job-posting.index')
                    ->with('error', 'Bạn không có quyền xóa bài đăng này.');
            }

            // Xóa bài đăng
            $jobPosting->delete();

            return redirect()->route('employer.job-posting.index')
                ->with('success', 'Bài đăng tuyển dụng đã được xóa thành công.');
        } catch (\Exception $e) {
            return back()->with('error', 'Đã xảy ra lỗi khi xóa bài đăng: ' . $e->getMessage());
        }
    }

    public function viewApplications($id)
    {
        $employer = Auth::guard('employer')->user();
        $jobPosting = JobPosting::where('employer_id', $employer->id)
            ->findOrFail($id);

        $applications = Application::with('candidate')
            ->where('job_posting_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job-posting.applications', compact('jobPosting', 'applications'));
    }

    public function updateApplicationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected'
        ]);

        $application = Application::findOrFail($id);

        // Verify employer owns this job posting
        if ($application->jobPosting->employer_id !== Auth::guard('employer')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $application->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công'
        ]);
    }
    public function toggleSave($id)
    {
        $application = Application::findOrFail($id);

        // Verify employer owns this job posting
        if ($application->jobPosting->employer_id !== Auth::guard('employer')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $application->saved = !$application->saved;
        $application->save();

        return response()->json([
            'success' => true,
            'saved' => $application->saved,
            'message' => $application->saved ? 'Đã lưu hồ sơ' : 'Đã bỏ lưu hồ sơ'
        ]);
    }

    public function savedApplications()
    {
        $employer = Auth::guard('employer')->user();
        $savedApplications = Application::with('candidate', 'jobPosting')
            ->whereHas('jobPosting', function ($query) use ($employer) {
                $query->where('employer_id', $employer->id);
            })
            ->where('saved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job-posting.saved-applications', compact('savedApplications'));
    }
     public function services()
    {
        $services = Service::where('status', Service::STATUS_ACTIVE)
            ->orderBy('created_at', 'desc')
            ->get();

        $banks = Bank::where('status', '1')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job-posting.services', compact('services', 'banks'));
    }
}
