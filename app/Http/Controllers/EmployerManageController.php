<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployerManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employers = Employer::with(['jobPostings', 'gallery'])->get();
        return view('admin.employers.index', compact('employers'));
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
        return view('admin.employers.edit', compact('employer'));
    }

   public function update(Request $request, Employer $employer)
{
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
        'isUrgentrecruitment' => 'boolean',
        'IsPartner' => 'boolean',
        'IsHoteffect' => 'boolean',
    ]);

    // Handle boolean fields
    $booleanFields = [
        'status', 'IsBasicnews', 'isUrgentrecruitment',
        'IsPartner', 'IsHoteffect'
    ];

    foreach ($booleanFields as $field) {
        $validated[$field] = $request->has($field);
    }

    if ($request->hasFile('logo')) {
        if ($employer->logo) {
            Storage::delete($employer->logo);
        }
        $validated['logo'] = $request->file('logo')->store('employers/logos', 'public');
    }

    $validated['slug'] = Str::slug($validated['company_name']);

    $employer->update($validated);

    return redirect()->route('manage.employers.edit', $employer)
        ->with('success', 'Thông tin nhà tuyển dụng đã được cập nhật thành công.');
}
}
