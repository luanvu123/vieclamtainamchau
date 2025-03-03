<?php
// Trong file app/Http/Controllers/SavedJobController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    public function toggleSave($jobPostingId)
    {
        $candidate = Auth::guard('candidate')->user();

        if (!$candidate) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thực hiện chức năng này'], 401);
        }

        $jobPosting = JobPosting::findOrFail($jobPostingId);

        // Kiểm tra xem tin tuyển dụng đã được lưu chưa
        $exists = $candidate->savedJobPostings()->where('job_posting_id', $jobPostingId)->exists();

        if ($exists) {
            // Nếu đã lưu, bỏ lưu
            $candidate->savedJobPostings()->detach($jobPostingId);
            return response()->json(['saved' => false, 'message' => 'Đã bỏ lưu tin tuyển dụng']);
        } else {
            // Nếu chưa lưu, lưu tin
            $candidate->savedJobPostings()->attach($jobPostingId);
            return response()->json(['saved' => true, 'message' => 'Đã lưu tin tuyển dụng']);
        }
    }

    public function savedJobs()
    {
        $candidate = Auth::guard('candidate')->user();

        if (!$candidate) {
            return redirect()->route('login.candidate');
        }

        $savedJobs = $candidate->savedJobPostings()->paginate(10);

        return view('candidate.saved-jobs', compact('savedJobs'));
    }
}
