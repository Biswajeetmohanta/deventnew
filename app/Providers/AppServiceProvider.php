<?php

namespace App\Providers;

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
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $settings = \App\Models\Setting::all()->pluck('value', 'key');
            view()->share('settings', $settings);
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('services')) {
            $footerServices = \App\Models\Service::where('is_active', true)->orderBy('order')->take(6)->get();
            $navServices = \App\Models\Service::where('is_active', true)->orderBy('order')->get();
            view()->share('footerServices', $footerServices);
            view()->share('navServices', $navServices);
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('industries')) {
            $navIndustries = \App\Models\Industry::all();
            view()->share('navIndustries', $navIndustries);
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('technologies')) {
            $navTechnologies = \App\Models\Technology::where('is_active', true)->get();
            view()->share('navTechnologies', $navTechnologies);
        }
    }
}
