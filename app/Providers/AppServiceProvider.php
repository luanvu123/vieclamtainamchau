<?php

namespace App\Providers;

use App\Models\Genre;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Employer;
use App\Models\Candidate;
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
        // Count the number of employers created in the last 2 hours
        $employerCountTwoHour = Employer::where('created_at', '>=', Carbon::now()->subHours(2))->count();

        // Count the number of candidates created in the last 2 hours
        $candidateCountTwoHour = Candidate::where('created_at', '>=', Carbon::now()->subHours(2))->count();

        // Share these counts with all views
        View::share('employerCountTwoHour', $employerCountTwoHour);
        View::share('candidateCountTwoHour', $candidateCountTwoHour);

        // Optionally, you can share other data like genres as shown in your existing code
        view()->composer('*', function ($view) {
            $genre_home = Genre::where('status', 'active')->get();
            $view->with('genre_home', $genre_home);
        });
    }
}
