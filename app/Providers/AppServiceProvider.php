<?php

namespace App\Providers;

use App\Models\Genre;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
          view()->composer('*', function ($view) {
        $genre_home = Genre::where('status', 'active')->get();
        $view->with('genre_home', $genre_home);
    });
    }
}
