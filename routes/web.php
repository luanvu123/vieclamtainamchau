<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CandidateManageController;
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
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployerManageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportManageController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

Route::get('/', [SiteController::class, 'index'])->name('/');
Route::get('/job', [SiteController::class, 'job'])->name('job');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/lien-he', [SiteController::class, 'hotline'])->name('hotline');
Route::get('/genre/{slug}', [SiteController::class, 'genre'])->name('genre.show');
Route::get('/job/{slug}', [SiteController::class, 'job'])->name('job.show');
Route::get('/category/{slug}', [SiteController::class, 'category'])->name('category.show');
Route::get('/country/{slug}', [SiteController::class, 'country'])->name('country.show');
Route::get('/search', [SiteController::class, 'search'])->name('site.search');
Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');
Route::get('/tin-tuc', [SiteController::class, 'news'])->name('news.home');
Route::get('/tin-tuc/{id}', [SiteController::class, 'newsDetail'])->name('news.detail.home');
Auth::routes();





Route::get('/danh-sach-cac-quoc-gia', [SiteController::class, 'countries'])->name('site.countries');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('services', ServiceController::class);
    Route::resource('manage/employers', EmployerManageController::class, [
        'as' => 'manage'
    ]);
    Route::get('manage/job-postings', [EmployerManageController::class, 'indexJobPosting'])->name('manage.employers.indexJobPosting');
    Route::resource('banks', BankController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('news', NewsController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('countries', CountryController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('candidate-manage', CandidateManageController::class);
    Route::resource('support-manage', SupportManageController::class)->only([
        'index',
        'edit',
        'update',
        'destroy'
    ]);
});


Route::prefix('candidate')->name('candidate.')->group(function () {

    Route::get('/applications', [CandidateProfileController::class, 'applications'])->middleware('candidate')->name('applications');
    Route::get('register', [CandidateAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [CandidateAuthController::class, 'register'])->name('register.submit');
    Route::get('login', [CandidateAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CandidateAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [CandidateAuthController::class, 'logout'])->name('logout');
    Route::get('auth/google', [CandidateAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [CandidateAuthController::class, 'handleGoogleCallback']);
    Route::get('/verify/{token}', [CandidateAuthController::class, 'verify'])->name('verify');
    Route::get('dashboard', [CandidateAuthController::class, 'dashboard'])
        ->middleware('candidate')
        ->name('dashboard');
    Route::post('/apply', [ApplicationController::class, 'store'])->middleware('candidate')->name('apply');
    Route::get('/profile/edit', [CandidateProfileController::class, 'edit'])->middleware('candidate')->name('profile.edit');

    Route::get('/cv-white', [CandidateProfileController::class, 'cvWhite'])->middleware('candidate')->name('cv.white');
    Route::get('/cv-black', [CandidateProfileController::class, 'cvBlack'])->middleware('candidate')->name('cv.black');
    Route::get('/cv-logistic', [CandidateProfileController::class, 'cvLogistic'])->middleware('candidate')->name('cv.logistic');

    Route::post('/profile/edit', [CandidateProfileController::class, 'update'])->middleware('candidate')->name('profile.update');
    Route::get('forget-password', [CandidateForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [CandidateForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [CandidateForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [CandidateForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::prefix('employer')->name('employer.')->group(function () {
    // Authentication Routes
    Route::get('job-posting/find-candidate', [JobPostingController::class, 'findCandidate'])
        ->name('job-posting.find-candidate')->middleware('employer');
    Route::get('/services', [JobPostingController::class, 'services'])->name('services')->middleware('employer');
    Route::get('register', [EmployerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [EmployerAuthController::class, 'register'])->name('register.submit');
    Route::get('login', [EmployerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [EmployerAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [EmployerAuthController::class, 'logout'])->name('logout');
    Route::resource('job-posting', JobPostingController::class)
        ->middleware('employer');
    Route::get(
        'admin/employers/{employerId}/job-postings/{jobPostingId}/edit',
        [EmployerManageController::class, 'editJobPosting']
    )
        ->name('admin.job-postings.edit');
    Route::get('dich-vu-da-mua', [JobPostingController::class, 'serviceActive'])
        ->name('service-active')->middleware('employer');
    Route::put(
        'admin/employers/{employerId}/job-postings/{jobPostingId}',
        [EmployerManageController::class, 'updateJobPosting']
    )
        ->name('admin.job-postings.update');

    Route::get('job-posting/{id}/applications', [JobPostingController::class, 'viewApplications'])
        ->name('job-posting.applications')->middleware('employer');
    Route::put('applications/{id}/status', [JobPostingController::class, 'updateApplicationStatus'])
        ->name('applications.update-status')->middleware('employer');
    Route::get('/verify/{token}', [EmployerAuthController::class, 'verify'])->name('verify');
    Route::put('applications/{id}/toggle-save', [JobPostingController::class, 'toggleSave'])
        ->name('applications.toggle-save')->middleware('employer');
    Route::get('saved-applications', [JobPostingController::class, 'savedApplications'])
        ->name('saved-applications')->middleware('employer');
    Route::get('/profile/edit', [EmployerProfileController::class, 'edit'])
        ->middleware('employer')
        ->name('profile.edit');
    Route::post('/profile/update', [EmployerProfileController::class, 'updateInfo'])
        ->middleware('employer')
        ->name('profile.updateInfo');
    Route::put('/update-company', [EmployerProfileController::class, 'updateCompany'])->name('updateCompany')->middleware('employer');

    Route::post('/profile/edit', [EmployerProfileController::class, 'update'])
        ->middleware('employer')
        ->name('profile.update');
    Route::get('forget-password', [EmployerForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [EmployerForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [EmployerForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [EmployerForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});
