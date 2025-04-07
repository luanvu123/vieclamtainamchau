<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\JobPosting;
use App\Models\Genre;
use Illuminate\Http\Request;

class LaborexportController extends Controller
{

    public function index()
    {
        $jobPostings = JobPosting::whereHas('genres', function ($query) {
            $query->where('slug', 'xuat-khau-lao-dong');
        })
            ->with(['employer', 'genres', 'categories', 'countries'])
            ->latest()
            ->get();

        return view('admin.labor_export.index', compact('jobPostings'));
    }
    public function edit($id)
    {
        $jobPosting = JobPosting::with(['categories', 'genres', 'countries', 'employer'])
            ->whereHas('genres', function ($query) {
                $query->where('slug', 'xuat-khau-lao-dong');
            })
            ->findOrFail($id);

        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();

        return view('admin.labor_export.edit', compact('jobPosting', 'categories', 'countries', 'genres'));
    }
    public function update(Request $request, $id)
    {
        $jobPosting = JobPosting::with(['genres'])->whereHas('genres', function ($query) {
            $query->where('slug', 'xuat-khau-lao-dong');
        })->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'age_range' => 'nullable|string',
            'location' => 'nullable|string',
            'experience' => 'nullable|string',
            'rank' => 'nullable|string',
            'number_of_recruits' => 'nullable|integer',
            'sex' => 'nullable|string',
            'skills_required' => 'nullable|string',
            'description' => 'required|string',
            'application_email_url' => 'required|email',
            'closing_date' => 'nullable|date',
            'salary' => 'nullable|string',
            'categories' => 'nullable|array',
            'genres' => 'nullable|array',
        ]);

        $jobPosting->update($validated);

        $jobPosting->categories()->sync($request->categories ?? []);
        $jobPosting->genres()->sync($request->genres ?? []);
        $jobPosting->countries()->sync($request->countries ?? []);

        return redirect()->route('labor-exports.index')->with('success', 'Cập nhật thành công!');
    }

}
