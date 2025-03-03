<?php

namespace App\Http\Controllers;

use App\Models\SavedJobPosting;
use Illuminate\Http\Request;
use App\Models\JobPosting;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
   public function toggleSave($jobPostingId)
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        // Kiểm tra xem công việc đã được lưu chưa
        $savedJob = SavedJobPosting::where('candidate_id', $candidateId)
            ->where('job_posting_id', $jobPostingId)
            ->first();

        if ($savedJob) {
            // Nếu đã lưu, xóa khỏi danh sách
            $savedJob->delete();
            return response()->json(['success' => true, 'saved' => false, 'message' => 'Đã xóa khỏi danh sách yêu thích!']);
        } else {
            // Nếu chưa lưu, thêm vào danh sách
            SavedJobPosting::create([
                'candidate_id' => $candidateId,
                'job_posting_id' => $jobPostingId
            ]);

            return response()->json(['success' => true, 'saved' => true, 'message' => 'Đã thêm vào danh sách yêu thích!']);
        }
    }

    // Kiểm tra xem công việc đã được lưu hay chưa
    public function checkSaved($jobPostingId)
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $isSaved = SavedJobPosting::where('candidate_id', $candidateId)
            ->where('job_posting_id', $jobPostingId)
            ->exists();

        return response()->json(['success' => true, 'saved' => $isSaved]);
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
