<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationNotification;
use App\Mail\ApplicationSubmitted;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate');
    }
    public function store(Request $request)
    {
        $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'introduction' => 'nullable|string|max:1000'
        ]);

        try {
            // Check if already applied
            $existingApplication = Application::where('candidate_id', auth('candidate')->id())
                ->where('job_posting_id', $request->job_posting_id)
                ->first();

            // Store CV file
            $cvPath = $request->file('cv')->store('cv', 'public');

            if ($existingApplication) {
                // Update existing application
                Storage::disk('public')->delete($existingApplication->cv_path);

                $existingApplication->update([
                    'cv_path' => $cvPath,
                    'introduction' => $request->introduction,
                    'updated_at' => now()
                ]);

                $application = $existingApplication;
            } else {
                // Create new application
                $application = Application::create([
                    'candidate_id' => auth('candidate')->id(),
                    'job_posting_id' => $request->job_posting_id,
                    'cv_path' => $cvPath,
                    'introduction' => $request->introduction
                ]);
            }

            // Get job posting and employer's email
            $jobPosting = $application->jobPosting;
            $employerEmail = $jobPosting->employer->email;

            if ($employerEmail) {
                Mail::to($employerEmail)->send(new ApplicationNotification($application));
            }

            return response()->json([
                'status' => 'success',
                'message' => $existingApplication ? 'Nộp lại hồ sơ thành công' : 'Nộp hồ sơ thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại'
            ], 500);
        }
    }

   public function checkApplicationStatus($jobPostingId)
    {
        $existingApplication = Application::where('candidate_id', auth('candidate')->id())
            ->where('job_posting_id', $jobPostingId)
            ->first();

        return response()->json([
            'hasApplied' => !is_null($existingApplication),
            'applicationDate' => $existingApplication ? $existingApplication->created_at : null,
            'lastUpdateDate' => $existingApplication && $existingApplication->updated_at->gt($existingApplication->created_at)
                ? $existingApplication->updated_at
                : null
        ]);
    }
}
