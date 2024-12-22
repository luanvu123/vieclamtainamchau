<?php

use App\Http\Controllers\Auth\CandidateAuthController;
use App\Http\Controllers\Auth\CandidateForgotPasswordController;
use App\Http\Controllers\Auth\CandidateResetPasswordController;
use App\Http\Controllers\Auth\EmployerAuthController;
use App\Http\Controllers\Auth\EmployerForgotPasswordController;
use App\Http\Controllers\Auth\EmployerResetPasswordController;
use App\Http\Controllers\Candidate\CandidateProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [SiteController::class, 'index'])->name('/');
Route::get('/job', [SiteController::class, 'job'])->name('job');
Route::get('/genre/{slug}', [SiteController::class, 'genre'])->name('genre.show');
Route::get('/job/{slug}', [SiteController::class, 'job'])->name('job.show');
Route::get('/category/{slug}', [SiteController::class, 'category'])->name('category.show');
Route::get('/country/{slug}', [SiteController::class, 'country'])->name('country.show');
Route::get('/search', [SiteController::class, 'search'])->name('site.search');


Auth::routes();


Route::get('/danh-sach-cac-quoc-gia', [SiteController::class, 'countries'])->name('site.countries');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('countries', CountryController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('genres', GenreController::class);
});


Route::prefix('candidate')->name('candidate.')->group(function () {
    Route::get('register', [CandidateAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [CandidateAuthController::class, 'register'])->name('register.submit');
    Route::get('login', [CandidateAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CandidateAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [CandidateAuthController::class, 'logout'])->name('logout');

    // Protected routes with 'auth:candidate' middleware
    Route::get('dashboard', [CandidateAuthController::class, 'dashboard'])
        ->middleware('auth:candidate')
        ->name('dashboard');
    Route::get('/profile/edit', [CandidateProfileController::class, 'edit'])->middleware('auth:candidate')->name('profile.edit');
    Route::post('/profile/edit', [CandidateProfileController::class, 'update'])->middleware('auth:candidate')->name('profile.update');


    // Password reset routes
    Route::get('password/reset', [CandidateForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [CandidateForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [CandidateResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [CandidateResetPasswordController::class, 'reset'])->name('password.update');
});

Route::prefix('employer')->name('employer.')->group(function () {
    // Authentication Routes
    Route::get('register', [EmployerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [EmployerAuthController::class, 'register'])->name('register.submit');
    Route::get('login', [EmployerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [EmployerAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [EmployerAuthController::class, 'logout'])->name('logout');
    Route::resource('job-posting', JobPostingController::class)
        ->middleware('auth:employer');
    Route::delete('employer/gallery/{id}', [EmployerProfileController::class, 'deleteGalleryImage'])->middleware('auth:employer')->name('gallery.delete');


    Route::get('/profile/edit', [EmployerProfileController::class, 'edit'])
        ->middleware('auth:employer')
        ->name('profile.edit');
    Route::post('/profile/update', [EmployerProfileController::class, 'updateInfo'])
        ->middleware('auth:employer')
        ->name('profile.updateInfo');
    Route::put('/employer/update-company', [EmployerProfileController::class, 'updateCompany'])->name('updateCompany')->middleware('auth:employer');

    Route::post('/profile/edit', [EmployerProfileController::class, 'update'])
        ->middleware('auth:employer')
        ->name('profile.update');

    // Password reset routes
    Route::get('password/reset', [EmployerForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('password/email', [EmployerForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('password/reset/{token}', [EmployerResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('password/reset', [EmployerResetPasswordController::class, 'reset'])
        ->name('password.update');
});
