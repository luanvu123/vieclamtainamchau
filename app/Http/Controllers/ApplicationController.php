<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationNotification;
use App\Mail\ApplicationSubmitted;
use App\Models\Application;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cv_id' => 'nullable|exists:cvs,id',
            'introduction' => 'nullable|string|max:1000'
        ]);

        $candidate = auth('candidate')->user();

        $existing = Application::where('candidate_id', $candidate->id)
            ->where('job_posting_id', $request->job_posting_id)
            ->latest()
            ->first();

        $cvPath = null;

        // Trường hợp chọn CV có sẵn
        if ($request->cv_id) {
            $cv = $candidate->cvs()->where('cvs.id', $request->cv_id)->first();
            if (!$cv)
                return response()->json(['status' => 'error', 'message' => 'CV không hợp lệ'], 422);
            $cvPath = $cv->file_path;
        }

        // Trường hợp upload CV mới
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv', 'public');
        }

        if (!$cvPath) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng chọn hoặc tải lên CV'], 422);
        }

        if ($existing && $existing->created_at->diffInHours(now()) < 24) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn chỉ có thể cập nhật CV sau 24 giờ kể từ lần nộp trước.'
            ], 422);
        }

      if ($existing) {
    if ($existing->created_at->diffInHours(now()) < 24) {
        return response()->json([
            'status' => 'error',
            'message' => 'Bạn chỉ có thể nộp lại hồ sơ sau 24 giờ kể từ lần nộp trước.'
        ], 422);
    }

    // Nếu nộp lại sau 24h -> Lưu CV mới vào cv_path_resubmit
    $existing->update([
        'cv_path_resubmit' => $cvPath,
        'introduction' => $request->introduction,
        'updated_at' => now(),
    ]);

    $application = $existing;
} else {
    // Tạo mới
    $application = Application::create([
        'candidate_id' => $candidate->id,
        'job_posting_id' => $request->job_posting_id,
        'cv_path' => $cvPath,
        'introduction' => $request->introduction,
    ]);
}


        $jobPosting = $application->jobPosting;
        if ($jobPosting->employer->email) {
            Mail::to($jobPosting->employer->email)->send(new ApplicationNotification($application));
        }

        return response()->json([
            'status' => 'success',
            'message' => $existing ? 'Nộp lại hồ sơ thành công' : 'Nộp hồ sơ thành công'
        ]);
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

    public function viewInfo(Request $request, Application $application)
{
    $employer = Auth::guard('employer')->user();

    // Kiểm tra employer có gói "Xem thông tin ứng viên" còn số lượng không
    $orderDetail = OrderDetail::whereHas('order', function ($query) use ($employer) {
        $query->where('employer_id', $employer->id)
            ->where('status', 'Đã thanh toán');
    })
    ->whereHas('service', function ($query) {
        $query->where('name', 'Xem thông tin ứng viên');
    })
    ->where('number_of_active', '>', 0)
    ->whereDate('expiring_date', '>=', now())
    ->first();

    if (!$orderDetail) {
        return response()->json(['message' => 'Bạn chưa mua gói hoặc đã hết lượt xem.'], 403);
    }

    DB::transaction(function () use ($orderDetail, $application) {
        // Trừ number_of_active
        $orderDetail->decrement('number_of_active');

        // Gán order_id vào Application
        $application->order_id = $orderDetail->order_id;
        $application->save();
    });

    return response()->json([
        'phone' => $application->candidate->phone,
        'email' => $application->candidate->email,
    ]);
}
}
