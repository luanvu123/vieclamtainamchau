<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Genre;
use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployerManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:employer-list|employer-create|employer-edit|employer-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:employer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employer-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $employers = Employer::with(['jobPostings', 'gallery'])->get();
        return view('admin.employers.index', compact('employers'));
    }

    public function indexJobPosting()
    {
        // Lấy tất cả bài đăng tuyển dụng
        $jobPostings = JobPosting::with(['employer', 'categories', 'genres', 'countries'])->get();

        // Trả về view và gửi dữ liệu $jobPostings
        return view('admin.employers.index-job-posting', compact('jobPostings'));
    }
    public function show($id)
    {
        $employer = Employer::findOrFail($id);
        $jobPostings = JobPosting::where('employer_id', $id)
            ->with(['categories', 'genres', 'countries'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.employers.show', compact('employer', 'jobPostings'));
    }

    public function edit(Employer $employer)
    {
        $user = Auth::user();
        if ($user->roles()->where('id', 1)->exists() || $employer->user_id === $user->id) {
            $users = User::all(); // Lấy danh sách tất cả user
            return view('admin.employers.edit', compact('employer', 'users'));
        }
        abort(403, 'Bạn không có quyền truy cập.');
    }


    public function editJobPosting($employerId, $jobPostingId)
    {
        $employer = Employer::findOrFail($employerId);
        $jobPosting = JobPosting::where('employer_id', $employerId)
            ->with(['categories', 'genres', 'countries'])
            ->findOrFail($jobPostingId);

        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();

        return view('admin.employers.edit-job-posting', compact(
            'employer',
            'jobPosting',
            'categories',
            'countries',
            'genres'
        ));
    }

    public function updateJobPosting(Request $request, $employerId, $jobPostingId)
    {
        $jobPosting = JobPosting::where('employer_id', $employerId)->findOrFail($jobPostingId);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime,intern,freelance',
            'description' => 'required|string',
            'location' => 'required|string',
            'salary' => 'required|string',
            'experience' => 'required|string',
            'skills_required' => 'required|string',
            'closing_date' => 'required|date',
            'application_email_url' => 'required|email',
            'status' => 'required|in:active,inactive,pending,rejected',
            'categories' => 'required|array',
            'countries' => 'required|array',
            'genres' => 'required|array'
        ]);

        $jobPosting->update($request->except(['categories', 'countries', 'genres']));

        // Sync relationships
        $jobPosting->categories()->sync($request->categories);
        $jobPosting->countries()->sync($request->countries);
        $jobPosting->genres()->sync($request->genres);

        return redirect()->route('manage.employers.show', $employerId)
            ->with('success', 'Bài đăng tuyển dụng đã được cập nhật thành công');
    }

    public function update(Request $request, Employer $employer)
    {
        $user = Auth::user();
        if (!$user->roles()->where('id', 1)->exists() && $employer->user_id !== $user->id) {
            abort(403, 'Bạn không có quyền chỉnh sửa.');
        }
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email,' . $employer->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'scale' => 'required|string|max:100',
            'mst' => 'required|string|max:20',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'detail' => 'nullable|string',
            'status' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'IsBasicnews' => 'boolean',
             'isVerifyCompany' => 'boolean',
            'isUrgentrecruitment' => 'boolean',
            'IsPartner' => 'boolean',
            'IsHoteffect' => 'boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Handle boolean fields
        $booleanFields = [
            'status',
            'IsBasicnews',
            'isUrgentrecruitment',
            'IsPartner',
            'IsHoteffect',
            'isVerifyCompany'
        ];

        foreach ($booleanFields as $field) {
            $validated[$field] = $request->has($field);

            // Kiểm tra nếu giá trị thay đổi thì cập nhật timestamp
            if ($employer->$field !== $validated[$field]) {
                $validated[$field . '_updated_at'] = now();
            }
        }
        if ($user->roles()->where('id', 1)->exists() && $request->filled('user_id')) {
            $validated['user_id'] = $request->user_id;
        } else {
            // Đảm bảo giữ nguyên user_id nếu không phải admin
            $validated['user_id'] = $employer->user_id;
        }
        // Xử lý logo nếu có
        if ($request->hasFile('logo')) {
            if ($employer->avatar) {
                Storage::delete($employer->avatar);
            }
            $validated['logo'] = $request->file('logo')->store('employers/logos', 'public');
        }

        // Thêm slug
        $validated['slug'] = Str::slug($validated['company_name']);

        // Cập nhật employer với tất cả dữ liệu đã validate
        $employer->update($validated);

        return redirect()->route('manage.employers.edit', $employer)
            ->with('success', 'Thông tin nhà tuyển dụng đã được cập nhật thành công.');
    }
}
