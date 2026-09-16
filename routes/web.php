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

    // Portal Clients & Projects management
    Route::resource('portal-clients', \App\Http\Controllers\Admin\PortalClientController::class);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::post('projects/{project}/milestones', [\App\Http\Controllers\Admin\ProjectController::class, 'addMilestone'])->name('projects.milestones.add');
    Route::post('projects/{project}/milestones/{milestone}/toggle', [\App\Http\Controllers\Admin\ProjectController::class, 'toggleMilestone'])->name('projects.milestones.toggle');
    Route::delete('projects/{project}/milestones/{milestone}', [\App\Http\Controllers\Admin\ProjectController::class, 'deleteMilestone'])->name('projects.milestones.delete');
    Route::post('projects/{project}/invoices', [\App\Http\Controllers\Admin\ProjectController::class, 'addInvoice'])->name('projects.invoices.add');
    Route::delete('projects/{project}/invoices/{invoice}', [\App\Http\Controllers\Admin\ProjectController::class, 'deleteInvoice'])->name('projects.invoices.delete');

    // Calculator Settings Management
    Route::get('calculator-settings', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'index'])->name('calculator-settings.index');
    
    Route::post('calculator-settings/project-type', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'storeProjectType'])->name('calculator-settings.project-type.store');
    Route::put('calculator-settings/project-type/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'updateProjectType'])->name('calculator-settings.project-type.update');
    Route::delete('calculator-settings/project-type/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'destroyProjectType'])->name('calculator-settings.project-type.destroy');
    
    Route::post('calculator-settings/complexity', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'storeComplexity'])->name('calculator-settings.complexity.store');
    Route::put('calculator-settings/complexity/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'updateComplexity'])->name('calculator-settings.complexity.update');
    Route::delete('calculator-settings/complexity/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'destroyComplexity'])->name('calculator-settings.complexity.destroy');
    
    Route::post('calculator-settings/feature', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'storeFeature'])->name('calculator-settings.feature.store');
    Route::put('calculator-settings/feature/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'updateFeature'])->name('calculator-settings.feature.update');
    Route::delete('calculator-settings/feature/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'destroyFeature'])->name('calculator-settings.feature.destroy');
    
    Route::post('calculator-settings/screen', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'storeScreen'])->name('calculator-settings.screen.store');
    Route::put('calculator-settings/screen/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'updateScreen'])->name('calculator-settings.screen.update');
    Route::delete('calculator-settings/screen/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'destroyScreen'])->name('calculator-settings.screen.destroy');
    
    Route::post('calculator-settings/timeline', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'storeTimeline'])->name('calculator-settings.timeline.store');
    Route::put('calculator-settings/timeline/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'updateTimeline'])->name('calculator-settings.timeline.update');
    Route::delete('calculator-settings/timeline/{id}', [\App\Http\Controllers\Admin\CalculatorSettingsController::class, 'destroyTimeline'])->name('calculator-settings.timeline.destroy');

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

// 301 Permanent Redirects for Legacy Service URLs
Route::redirect('/service/web-app-development', '/services/custom-software-development', 301);
Route::redirect('/service/digital-commerce', '/services/retail-e-commerce-software-development', 301);
Route::redirect('/service/it-outsourcing', '/services/software-development-consulting', 301);
Route::redirect('/services/software-development-consulting-services', '/services/software-development-consulting', 301);
Route::redirect('/service/blockchain-development', '/services', 301);
Route::redirect('/service', '/services', 301);
Route::get('/service/{slug}', function ($slug) {
    if ($slug === 'web-app-development') {
        return redirect('/services/custom-software-development', 301);
    } elseif ($slug === 'digital-commerce') {
        return redirect('/services/retail-e-commerce-software-development', 301);
    } elseif ($slug === 'it-outsourcing') {
        return redirect('/services/software-development-consulting', 301);
    } elseif ($slug === 'blockchain-development') {
        return redirect('/services', 301);
    }
    if (\App\Models\Service::where('slug', $slug)->exists()) {
        return redirect('/services/' . $slug, 301);
    }
    return redirect('/services', 301);
});

// XML Sitemap
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

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
Route::get('/portfolio', [\App\Http\Controllers\ClientController::class, 'index'])->name('portfolio.index');
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

// Price Calculator Routes
Route::get('/price-calculator', [\App\Http\Controllers\PriceCalculatorController::class, 'index'])->name('price-calculator');
Route::post('/price-calculator/submit', [\App\Http\Controllers\PriceCalculatorController::class, 'submit']);

// Client Portal Routes
Route::get('/portal/login', [\App\Http\Controllers\Portal\PortalLoginController::class, 'showLoginForm'])->name('portal.login');
Route::post('/portal/login', [\App\Http\Controllers\Portal\PortalLoginController::class, 'login']);
Route::post('/portal/logout', [\App\Http\Controllers\Portal\PortalLoginController::class, 'logout'])->name('portal.logout');

Route::middleware([\App\Http\Middleware\PortalMiddleware::class])->prefix('portal')->as('portal.')->group(function() {
    Route::get('/', [\App\Http\Controllers\Portal\PortalDashboardController::class, 'index'])->name('dashboard');
    Route::get('/projects/{project}', [\App\Http\Controllers\Portal\PortalProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{project}/files', [\App\Http\Controllers\Portal\PortalProjectController::class, 'uploadFile'])->name('projects.files.upload');
    Route::get('/projects/{project}/invoices/{invoice}/download', [\App\Http\Controllers\Portal\PortalProjectController::class, 'downloadInvoice'])->name('projects.invoices.download');
});

// Run Only SeoMetadataSeeder via Browser (for Live Server without Terminal)
Route::get('/run-seo-seeder', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\SeoMetadataSeeder',
            '--force' => true,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'SeoMetadataSeeder executed successfully on live website!',
            'output' => \Illuminate\Support\Facades\Artisan::output(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

// Run Only SiteAuditFixSeeder via Browser (SAFE for Live Server with real data)
Route::get('/run-audit-seeder', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\SiteAuditFixSeeder',
            '--force' => true,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'SiteAuditFixSeeder executed successfully without altering other database records!',
            'output' => \Illuminate\Support\Facades\Artisan::output(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

