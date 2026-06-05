<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CaseStudyController as AdminCaseStudyController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

// Admin Authentication
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('logout');

// Protected Admin Dashboard
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('services', AdminServiceController::class);
    Route::resource('case-studies', AdminCaseStudyController::class);
    Route::resource('inquiries', AdminInquiryController::class)->only(['index', 'show', 'destroy']);
    Route::resource('testimonials', AdminTestimonialController::class);
    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);
    Route::resource('certificates', \App\Http\Controllers\Admin\CertificateController::class);
    Route::resource('careers', AdminCareerController::class);
    Route::resource('applications', \App\Http\Controllers\Admin\JobApplicationController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('posts', AdminPostController::class);
    Route::resource('industries', \App\Http\Controllers\Admin\IndustryController::class);
    Route::resource('technologies', \App\Http\Controllers\Admin\TechnologyController::class);
    Route::resource('team-roles', \App\Http\Controllers\Admin\TeamRoleController::class);

    // Global Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Live Chat
    Route::get('/chats', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/unread-count', [\App\Http\Controllers\Admin\ChatController::class, 'getUnreadCount'])->name('chats.unread');
    Route::get('/chats/{id}', [\App\Http\Controllers\Admin\ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/{id}/reply', [\App\Http\Controllers\Admin\ChatController::class, 'reply'])->name('chats.reply');
    Route::get('/chats/{id}/poll', [\App\Http\Controllers\Admin\ChatController::class, 'getNewMessages'])->name('chats.poll');
    Route::post('/chats/{id}/close', [\App\Http\Controllers\Admin\ChatController::class, 'close'])->name('chats.close');
    Route::resource('chat-auto-replies', \App\Http\Controllers\Admin\ChatAutoReplyController::class);
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{slug}', [ServiceController::class, 'show']);
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies.index');
Route::get('/case-studies/{slug}', [CaseStudyController::class, 'show'])->name('case-studies.show');
Route::get('/industry', [\App\Http\Controllers\IndustryController::class, 'index']);
Route::get('/industry/{slug}', [\App\Http\Controllers\IndustryController::class, 'show']);
Route::get('/technology', [\App\Http\Controllers\TechnologyController::class, 'index']);
Route::get('/technology/{slug}', [\App\Http\Controllers\TechnologyController::class, 'show']);
Route::get('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'index']);
Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
Route::get('/certificates', [\App\Http\Controllers\CertificateController::class, 'index'])->name('certificates.index');
Route::get('/build-your-team', [\App\Http\Controllers\TeamRoleController::class, 'index']);
Route::get('/build-your-team/{slug}', [\App\Http\Controllers\TeamRoleController::class, 'show']);
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/about', [AboutController::class, 'index']);
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index']);
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show']);
Route::get('/careers', [CareerController::class, 'index']);
Route::get('/careers/{id}', [CareerController::class, 'show']);
Route::post('/careers/{id}/apply', [CareerController::class, 'storeApplication'])->name('careers.apply');

// Privacy Policy
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

// Chat API (public)
Route::post('/chat/start', [\App\Http\Controllers\ChatController::class, 'startSession']);
Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'sendMessage']);
Route::post('/chat/submit-details', [\App\Http\Controllers\ChatController::class, 'submitDetails']);
Route::post('/chat/skip', [\App\Http\Controllers\ChatController::class, 'skipLead']);
Route::get('/chat/messages', [\App\Http\Controllers\ChatController::class, 'getMessages']);
