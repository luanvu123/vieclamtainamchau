<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Employer;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $days = collect();
        $currentMonth = Carbon::now()->month;

        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $date = Carbon::create(Carbon::now()->year, $currentMonth, $i);
            $days->put($date->format('Y-m-d'), 0);
        }

        // Đếm số lượng nhà tuyển dụng theo ngày
        $employerStats = Employer::whereMonth('created_at', $currentMonth)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        // Đếm số lượng ứng viên theo ngày
        $candidateStats = Candidate::whereMonth('created_at', $currentMonth)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        // Kết hợp số liệu với các ngày
        $employerData = $days->merge($employerStats);
        $candidateData = $days->merge($candidateStats);

        return view('home', [
            'employerChartData' => $employerData,
            'candidateChartData' => $candidateData,
        ]);
    }
}
