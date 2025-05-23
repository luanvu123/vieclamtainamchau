<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationManageController;
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
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\AdvertisesManageController;
use App\Http\Controllers\CompanyPartnerController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\KeySearchController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\SavedStudyAbroadController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StudyAbroadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployerManageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\LaborexportController;
use App\Http\Controllers\LanguageTrainingController;
use App\Http\Controllers\LanguageTrainingManageController;
use App\Http\Controllers\NewsManageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterStudyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SoftSkillController;
use App\Http\Controllers\StudyAbroadManageController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\SupportManageController;
use App\Http\Controllers\TypeLanguageTrainingController;
use App\Http\Controllers\TypeserviceController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

Route::get('/', [SiteController::class, 'index'])->name('/');
Route::get('/job', [SiteController::class, 'job'])->name('job')->middleware('candidate');
Route::get('/about', [SiteController::class, 'about'])->name('about')->middleware('candidate');
Route::get('/lien-he', [SiteController::class, 'hotline'])->name('hotline');
Route::get('/genre/{slug}', [SiteController::class, 'genre'])->name('genre.show')->middleware('candidate');
// Route cho API gợi ý tìm kiếm
Route::get('/job-suggestions', [SiteController::class, 'getJobSuggestions'])->name('job.suggestions');
Route::get('/category/{slug}', [SiteController::class, 'category'])->name('category.show')->middleware('candidate');
Route::get('/country/{slug}', [SiteController::class, 'country'])->name('country.show')->middleware('candidate');
Route::get('/search', [SiteController::class, 'search'])->name('site.search')->middleware('candidate');
Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');
Route::get('/tin-tuc', [SiteController::class, 'news'])->name('news.home');
Route::get('/tin-tuc/{id}', [SiteController::class, 'newsDetail'])->name('news.detail.home');
Route::get('/study-abroad/{id}/details', [SiteController::class, 'getStudyDetails']);
Route::get('/study-abroad', [SiteController::class, 'studyIndex'])->name('site.study-abroad');
Route::get('/study-abroad/{slug}', [SiteController::class, 'studyShow'])->name('study-abroad.show');
Route::get('/language-training/{slug}', [SiteController::class, 'detailLanguageTrainings'])->name('site.language-training.detail');
Route::get('/language-training/type/{type:slug}', [SiteController::class, 'filterByType'])->name('site.language-training');


Auth::routes();





Route::group(['middleware' => ['auth']], function () {
    Route::resource('keysearch', KeySearchController::class);
    Route::resource('company-partners', CompanyPartnerController::class);
    Route::resource('application-manage', ApplicationManageController::class);
    Route::post('application-manage/{id}/add-hidden-cv', [ApplicationManageController::class, 'addHiddenCv'])
        ->name('application-manage.add-hidden-cv');
    Route::post('application-manage/{id}/update-cv-path', [ApplicationManageController::class, 'updateCvPath'])
        ->name('application-manage.update-cv-path');
    Route::post('application-manage/{id}/delete-hidden-cv', [ApplicationManageController::class, 'deleteHiddenCv'])
        ->name('application-manage.delete-hidden-cv');
    Route::resource('languages', LanguageController::class);
    Route::get('manage/job-postings/basic', [EmployerManageController::class, 'indexBasic'])->name('manage.employers.indexBasic');
    Route::get('manage/job-postings/outstanding', [EmployerManageController::class, 'indexOutstanding'])->name('manage.employers.indexOutstanding');
    Route::get('manage/job-postings/special', [EmployerManageController::class, 'indexSpecial'])->name('manage.employers.indexSpecial');

    Route::resource('news-manage', NewsManageController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('soft-skills', SoftSkillController::class);
    Route::resource('advertises-manage', AdvertisesManageController::class);
    Route::resource('language-training-manage', LanguageTrainingManageController::class);
    Route::resource('study-abroad-manage', StudyAbroadManageController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('labor-exports', LaborexportController::class);

    Route::resource('typeservice', TypeserviceController::class);

    Route::resource('typeLanguagetrainings', TypeLanguageTrainingController::class);

    Route::resource('manage/employers', EmployerManageController::class, [
        'as' => 'manage'
    ]);
    Route::get('manage/orders', [EmployerManageController::class, 'orders'])->name('manage.orders.index');
    Route::get('manage/orders/{id}', [EmployerManageController::class, 'showOrder'])->name('manage.orders.show');
    Route::post('manage/orders/{id}/status', [EmployerManageController::class, 'updateOrderStatus'])->name('manage.orders.updateStatus');

    // Routes for order details
    Route::get('manage/order-details', [EmployerManageController::class, 'orderDetails'])->name('manage.orderDetails.index');
    Route::post('manage/order-details/{id}/active', [EmployerManageController::class, 'updateOrderDetailActive'])->name('manage.orderDetails.updateActive');

    Route::get('manage/job-postings', [EmployerManageController::class, 'indexJobPosting'])->name('manage.employers.indexJobPosting');
    Route::resource('banks', BankController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::get('/admin/info/edit', [InfoController::class, 'edit'])->name('info.edit');
    Route::put('/admin/info/update', [InfoController::class, 'update'])->name('info.update');
    Route::get('/hotline', [InfoController::class, 'hotline'])->name('hotline.edit');

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

Route::get('/candidate/check-application/{jobPostingId}', [ApplicationController::class, 'checkApplicationStatus'])->name('candidate.check-application')->middleware('candidate');
Route::post('/applications/{application}/view-info', [JobPostingController::class, 'viewInfo'])
    ->name('applications.viewInfo')
    ->middleware('employer');


Route::prefix('candidate')->name('candidate.')->group(function () {


    Route::post('/apply', [ApplicationController::class, 'store'])->middleware('candidate')->name('apply');
    Route::get('/job/{slug}', [CandidateProfileController::class, 'job'])->name('job.show')->middleware('candidate');
    Route::post('upload-cv', [CandidateProfileController::class, 'uploadCV'])->name('uploadCV');
    Route::delete('cv/{id}', [CandidateProfileController::class, 'deleteCV'])->name('deleteCV');

    Route::resource('experiences', ExperienceController::class);
    Route::resource('educations', EducationController::class);
    Route::resource('certificates', CertificateController::class);
    Route::post('/register-study-abroad/{studyAbroadId}', [SavedStudyAbroadController::class, 'registerConsultation'])
        ->middleware('candidate')
        ->name('register.study.abroad');

    Route::post('/language-training/register', [CandidateProfileController::class, 'registerTraining'])->name('site.language-training.register');
    Route::get('/notifications', [CandidateProfileController::class, 'notify'])
        ->name('notifications');
    Route::post('/notifications/{id}/mark-as-read', [CandidateProfileController::class, 'markNotificationAsRead'])
        ->name('notifications.mark-as-read');
    Route::post('/notifications/clear-all', [CandidateProfileController::class, 'clearAllNotifications'])
        ->name('notifications.clear-all');
    Route::get('/applications', [CandidateProfileController::class, 'applications'])->middleware('candidate')->name('applications');
    Route::post('/save-job/{jobPostingId}', [SavedJobController::class, 'toggleSave'])
        ->middleware('candidate')
        ->name('save.job');

    Route::get('/jobs/{jobPostingId}/check-saved', [SavedJobController::class, 'checkSaved'])
        ->middleware('candidate')
        ->name('check.saved.job');

    Route::post('/save-study-abroad/{studyAbroadId}', [SavedStudyAbroadController::class, 'toggleSave'])->middleware('candidate')->name('save.study.abroad');
    Route::get('/study-abroad/{studyAbroadId}/check-saved', [SavedStudyAbroadController::class, 'checkSaved'])->middleware('candidate')->name('check.saved.study.abroad');
    Route::get('/saved-study-abroad', [SavedStudyAbroadController::class, 'savedStudyAbroad'])->middleware('candidate')->name('saved.study.abroad');

    Route::get('/saved-jobs', [SavedJobController::class, 'savedJobs'])->middleware('candidate')->name('saved.jobs');

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
    Route::get('register', [EmployerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [EmployerAuthController::class, 'register'])->name('register.submit');
    Route::get('job-posting-export', [JobPostingController::class, 'indexExport'])
        ->name('job-posting.export')
        ->middleware('employer');
    Route::get('/banks', [EmployerProfileController::class, 'bankList'])
        ->middleware('employer')
        ->name('banks.index');
    Route::resource('news', NewsController::class);
    Route::resource('advertises', AdvertiseController::class);
    Route::resource('study-abroads', StudyAbroadController::class);
    Route::get('study-abroads/{id}/candidates', [StudyAbroadController::class, 'showCandidates'])
        ->name('study-abroads.candidates');

    Route::get('languagetrainings/{id}/candidates', [LanguageTrainingController::class, 'showCandidates'])->name('languagetrainings.candidates');
    Route::delete('candidate-registrations/{id}', [LanguageTrainingController::class, 'destroyCandidateRegistration'])
        ->name('languagetrainings.candidate.destroy');


    Route::resource('languagetrainings', LanguageTrainingController::class);
    Route::post('send-message', [JobPostingController::class, 'sendMessage'])->name('send-message');
    // Authentication Routes
    Route::get('job-posting/find-candidate', [JobPostingController::class, 'findCandidate'])
        ->name('job-posting.find-candidate')->middleware('employer');
    Route::get('/services', [JobPostingController::class, 'services'])->name('services')->middleware('employer');
    Route::post('/add-to-cart', [JobPostingController::class, 'addToCart'])->name('addToCart')->middleware('employer');
    // web.php
    Route::delete('/cart/{id}', [JobPostingController::class, 'removeFromCart'])->name('removeFromCart')->middleware('employer');

    Route::get('/get-cart-count', [JobPostingController::class, 'getCartCount'])->name('getCartCount')->middleware('employer');

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
    Route::post('applications/update-view', [JobPostingController::class, 'updateApplicationView'])
        ->name('applications.update-view');
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

    Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout')->middleware('employer');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('employer');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show')->middleware('employer');
    Route::post('/orders/{id}/mark-as-paid', [OrderController::class, 'markAsPaid'])->name('orders.markAsPaid')->middleware('employer');

});
