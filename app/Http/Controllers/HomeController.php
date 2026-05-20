<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HeroBanner;
use App\Models\Service;
use App\Models\Technology;
use App\Models\CaseStudy;
use App\Models\Testimonial;
use App\Models\Industry;

class HomeController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $technologies = Technology::where('is_active', true)->get();
        $caseStudies = CaseStudy::where('is_active', true)->orderBy('order')->take(6)->get();
        $testimonials = Testimonial::all();
        $industries = Industry::all();
        $settings = \App\Models\Setting::all()->pluck('value', 'key');

        return view('home', compact('banners', 'services', 'technologies', 'caseStudies', 'testimonials', 'settings', 'industries'));
    }

    public function privacyPolicy()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        return view('privacy-policy', compact('settings'));
    }
}
