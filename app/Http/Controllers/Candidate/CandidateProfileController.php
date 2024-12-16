<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class CandidateProfileController extends Controller
{
    public function edit()
    {
        $candidate = Auth::guard('candidate')->user();
        return view('candidate.profile', compact('candidate'));
    }

    /**
     * Update the candidate's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:candidates,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'avatar_candidate' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'position' => 'nullable|string',
            'is_public' => 'nullable|boolean',
            'cv_public' => 'nullable|boolean',
            'linkedin' => 'nullable|string',
            'level' => 'nullable|string',
            'desired_level' => 'nullable|string',
            'desired_salary' => 'nullable|numeric',
            'education_level' => 'nullable|string',
            'years_of_experience' => 'nullable|integer',
            'working_form' => 'nullable|string',
        ]);

        // Retrieve the authenticated candidate
        $candidate = Auth::guard('candidate')->user();

        // Update the candidate's profile fields
        $candidate->name = $request->input('name');
        $candidate->email = $request->input('email');
        $candidate->phone = $request->input('phone');
        $candidate->dob = $request->input('dob');
        $candidate->gender = $request->input('gender');
        $candidate->address = $request->input('address');
        $candidate->position = $request->input('position');
        $candidate->is_public = $request->has('is_public');
        $candidate->cv_public = $request->has('cv_public');
        $candidate->linkedin = $request->input('linkedin');
        $candidate->level = $request->input('level');
        $candidate->desired_level = $request->input('desired_level');
        $candidate->desired_salary = $request->input('desired_salary');
        $candidate->education_level = $request->input('education_level');
        $candidate->years_of_experience = $request->input('years_of_experience');
        $candidate->working_form = $request->input('working_form');

        // Handle file uploads
        if ($request->hasFile('avatar_candidate')) {
            // Delete the old avatar from storage if exists
            if ($candidate->avatar_candidate && Storage::exists('public/avatars/' . $candidate->avatar_candidate)) {
                Storage::delete('public/avatars/' . $candidate->avatar_candidate);
            }

            // Store the new avatar and get the filename
            $avatarPath = $request->file('avatar_candidate')->store('avatars', 'public');
            $candidate->avatar_candidate = basename($avatarPath); // Save only the filename
        }

        if ($request->hasFile('cv_path')) {
            // Delete the old CV file if exists
            if ($candidate->cv_path && Storage::exists('public/cvs/' . $candidate->cv_path)) {
                Storage::delete('public/cvs/' . $candidate->cv_path);
            }

            // Store the new CV and get the filename
            $cvPath = $request->file('cv_path')->store('cvs', 'public');
            $candidate->cv_path = basename($cvPath); // Save only the filename
        }

        // Save the updated candidate profile
        $candidate->save();

        // Redirect back to the profile page with success message
        return redirect()->route('candidate.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
