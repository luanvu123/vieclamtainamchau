<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployerProfileController extends Controller
{
    public function edit()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.profile.edit', compact('employer'));
    }

    public function update(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'business_license' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'detail' => 'nullable|string',
            'scale' => 'nullable|string|max:255',
            'mst' => 'nullable|string|max:50',
        ]);

        $data = $request->except(['logo', 'business_license']);
        $data['slug'] = Str::slug($request->company_name);

        if ($request->hasFile('logo')) {
            if ($employer->logo) {
                Storage::delete($employer->logo);
            }
            $data['logo'] = $request->file('logo')->store('employer/logos');
        }

        if ($request->hasFile('business_license')) {
            if ($employer->business_license) {
                Storage::delete($employer->business_license);
            }
            $data['business_license'] = $request->file('business_license')->store('employer/licenses');
        }

        $employer->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

      public function dashboard()
    {
        return view('employer.job_posting');
    }
     public function getCreateJobPosting()
    {
        $categories = Category::all(); // Lấy danh sách danh mục
        $countries = Country::all(); // Lấy danh sách quốc gia
         $employer = Auth::guard('employer')->user();

        return view('employer.create', compact('categories', 'countries','employer'));
    }

    // Hàm lưu bài đăng tuyển dụng (đã được viết trước)
    public function createJobPosting(Request $request)
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
            'experience' => 'nullable|string|max:100',
            'rank' => 'nullable|string|max:100',
            'number_of_recruits' => 'nullable|integer',
            'sex' => 'nullable|string|max:50',
            'status' => 'required|in:0,1',
            'skills_required' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'countries' => 'nullable|array',
            'countries.*' => 'exists:countries,id',
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
            'status' => $validated['status'],
            'skills_required' => $validated['skills_required'],
            'area' => $validated['area'],
        ]);

        if (!empty($validated['categories'])) {
            $jobPosting->categories()->sync($validated['categories']);
        }

        if (!empty($validated['countries'])) {
            $jobPosting->countries()->sync($validated['countries']);
        }

        return redirect()->route('employer.dashboard')
            ->with('success', 'Bài đăng tuyển dụng đã được tạo thành công.');
    }
}
