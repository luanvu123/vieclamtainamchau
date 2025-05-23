<?php

namespace App\Providers;

use App\Models\Advertise;
use App\Models\Application;
use App\Models\Genre;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Employer;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Info;
use App\Models\JobPosting;
use App\Models\LanguageTraining;
use App\Models\News;
use App\Models\OnlineVisitor;
use App\Models\Order;
use App\Models\RegisterStudy;
use App\Models\StudyAbroad;
use App\Models\Support;
use App\Models\TypeLanguageTraining;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Đếm số lượng hỗ trợ
        $supportCount = Support::count();

        // Đếm số lượng nhà tuyển dụng
        $employerCount = Employer::count();

        // Đếm số lượng ứng viên
        $candidateCount = Candidate::count();

        // Đếm số lượng bài đăng tuyển dụng
        $jobPostingCount = JobPosting::count();

        // Đếm số lượng bài đăng tuyển dụng với trạng thái 'active'
        $activeJobPostingCount = JobPosting::where('status', 'active')->count();

        // Chia sẻ các giá trị đếm với tất cả các views
        View::share('supportCount', $supportCount);
        View::share('employerCount', $employerCount);
        View::share('candidateCount', $candidateCount);
        View::share('jobPostingCount', $jobPostingCount);
        View::share('activeJobPostingCount', $activeJobPostingCount);
        // Count the number of employers created in the last 2 hours
        $employerCountTwoHour = Employer::where('created_at', '>=', Carbon::now()->subHours(2))->count();

        // Count the number of candidates created in the last 2 hours
        $candidateCountTwoHour = Candidate::where('created_at', '>=', Carbon::now()->subHours(2))->count();

        // Count the number of job postings created in the last 2 hours
        $jobPostingCountTwoHour = JobPosting::where('created_at', '>=', Carbon::now()->subHours(2))->count();
        $supportCountTwoHour = Support::where('created_at', '>=', Carbon::now()->subHours(2))->count();
        $orderCountTwoHour = Order::where('created_at', '>=', Carbon::now()->subHours(2))->count();
        // Đếm tổng số lượt truy cập
        $totalVisitors = OnlineVisitor::count();

        // Đếm số người đang online (5 phút qua)
        $onlineVisitors = OnlineVisitor::where('last_active', '>=', now()->subMinutes(5))->count();

        // Chia sẻ thông tin với tất cả các view
        view()->share('totalVisitors', $totalVisitors);
        view()->share('onlineVisitors', $onlineVisitors);
        // Share these counts with all views
        View::share('employerCountTwoHour', $employerCountTwoHour);
        View::share('candidateCountTwoHour', $candidateCountTwoHour);
        View::share('jobPostingCountTwoHour', $jobPostingCountTwoHour);
        View::share('supportCountTwoHour', $supportCountTwoHour);
        View::share('orderCountTwoHour', $orderCountTwoHour);
        View::share('TypeLanguageTraining_app', TypeLanguageTraining::where('status', 1)->get());

        // Optionally, you can share other data like genres as shown in your existing code
        view()->composer('*', function ($view) {
            $twoHoursAgo = Carbon::now()->subHours(2);

            $genre_home = Genre::where('status', 'active')->orderBy('updated_at', 'asc')->get();
            $categoryHot = Category::where('isHot', 1)->where('status', 'active')->get();
            $typeLanguageTraining_app = TypeLanguageTraining::where('status', true)->orderBy('name')->get();
            $languagetrainingCountTwoHour = LanguageTraining::where('created_at', '>=', $twoHoursAgo)->count();
            $newsCountTwoHour = News::where('created_at', '>=', $twoHoursAgo)->count();
            $advertisesCountTwoHour = Advertise::where('created_at', '>=', $twoHoursAgo)->count();
            $studyabroadCountTwoHour = StudyAbroad::where('created_at', '>=', $twoHoursAgo)->count();
            $applicationlayout = Application::where('approve_application', 'Chờ duyệt')
                ->where('created_at', '>=', Carbon::now()->subHours(24))
                ->count();
            $basicJobCountTwoHour = JobPosting::where('created_at', '>=', Carbon::now()->subHours(2))
                ->where('service_type', 'Tin cơ bản')

                ->count();

            $outstandingJobCountTwoHour = JobPosting::where('created_at', '>=', Carbon::now()->subHours(2))
                ->where('service_type', 'Tin nổi bật')
                ->count();

            $specialJobCountTwoHour = JobPosting::where('created_at', '>=', Carbon::now()->subHours(2))
                ->where('service_type', 'Tin đặc biệt')

                ->count();
            $view->with(compact(
                'genre_home',
                'categoryHot',
                'typeLanguageTraining_app',
                'languagetrainingCountTwoHour',
                'newsCountTwoHour',
                'advertisesCountTwoHour',
                'studyabroadCountTwoHour',
                'applicationlayout',
                'basicJobCountTwoHour',
                'outstandingJobCountTwoHour',
                'specialJobCountTwoHour',
            ));
        });

        View::share('info_layout', Info::first());

    }
}
