<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share settings with all views
        // Using cache to avoid DB hits on every request
        $settings = Cache::rememberForever('site_settings', function () {
            return Setting::all()->pluck('value', 'key');
        });

        View::share('settings', $settings);
    }
}
