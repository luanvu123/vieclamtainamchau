<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
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

            if ($existingApplication) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bạn đã nộp hồ sơ cho vị trí này rồi'
                ], 400);
            }

            // Store CV file
            $cvPath = $request->file('cv')->store('cv', 'public');

            // Create application
            $application = Application::create([
                'candidate_id' => auth('candidate')->id(),
                'job_posting_id' => $request->job_posting_id,
                'cv_path' => $cvPath,
                'introduction' => $request->introduction
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Nộp hồ sơ thành công'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại'
            ], 500);
        }
    }
}
