<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CandidateLanguageTraining;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CandidateProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate');
    }
    public function edit()
    {
        $candidate = Auth::guard('candidate')->user();
        return view('candidate.profile', compact('candidate'));
    }
     public function registerTraining(Request $request)
    {
        $candidateId = Auth::guard('candidate')->id();

        // Check nếu đã đăng ký
        $exists = CandidateLanguageTraining::where('candidate_id', $candidateId)
            ->where('language_training_id', $request->language_training_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Bạn đã đăng ký khóa học này rồi.');
        }

        CandidateLanguageTraining::create([
            'candidate_id' => $candidateId,
            'language_training_id' => $request->language_training_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Đăng ký thành công!');
    }
public function notify()
{
    $candidate = Auth::guard('candidate')->user();
    $notifications = Notification::where('candidate_id', $candidate->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

    return view('candidate.notify', compact('notifications'));
}

public function markNotificationAsRead($id)
{
    $notification = Notification::where('candidate_id', Auth::guard('candidate')->id())
                              ->findOrFail($id);

    $notification->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

public function clearAllNotifications()
{
    Notification::where('candidate_id', Auth::guard('candidate')->id())
                ->update(['is_read' => true]);

    return redirect()->back()->with('success', 'Đã đánh dấu tất cả thông báo là đã đọc');
}
    public function cvWhite()
    {
        return view('candidate.cv_white');
    }
    public function cvBlack()
    {
        return view('candidate.cv_black');
    }
    public function cvLogistic()
    {
        return view('candidate.cv_logistic');
    }
    public function applications()
    {
        // Lấy candidate hiện tại
        $candidate = Auth::guard('candidate')->user();

        // Lấy danh sách ứng tuyển với eager loading
        $applications = Application::with(['jobPosting', 'jobPosting.employer'])
            ->where('candidate_id', $candidate->id)
           ->orderBy('updated_at', 'desc')
            ->paginate(10); // Phân trang, mỗi trang 10 items

        return view('candidate.applications', compact('applications'));
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
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'avatar_candidate' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'gender' => 'required|string',
            'address' => 'required|string',
            'position' => 'required|string',
            'is_public' => 'nullable|in:0,1',
            'cv_public' => 'nullable|in:0,1',
            'linkedin' => 'required|string',
            'level' => 'required|string',
            'desired_level' => 'required|string',
            'desired_salary' => 'required|string',
            'education_level' => 'required|string',
            'years_of_experience' => 'required|integer',
            'working_form' => 'required|string',
            'skill' => 'required|string|max:255',

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
        $candidate->is_public = $request->input('is_public', 0); // Default to 0 if not set
        $candidate->cv_public = $request->input('cv_public', 0); // Default to 0 if not set
        $candidate->linkedin = $request->input('linkedin');
        $candidate->level = $request->input('level');
        $candidate->desired_level = $request->input('desired_level');
        $candidate->desired_salary = $request->input('desired_salary');
        $candidate->education_level = $request->input('education_level');
        $candidate->years_of_experience = $request->input('years_of_experience');
        $candidate->working_form = $request->input('working_form');
         $candidate->skill = $request->input('skill');

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
