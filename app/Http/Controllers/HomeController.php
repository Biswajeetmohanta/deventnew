<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HeroBanner;
use App\Models\Service;
use App\Models\Technology;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Industry;

class HomeController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $technologies = Technology::where('is_active', true)->get();
        $portfolios = Portfolio::where('is_active', true)->latest()->take(6)->get();
        $testimonials = Testimonial::all();
        $industries = Industry::all();
        $settings = \App\Models\Setting::all()->pluck('value', 'key');

        return view('home', compact('banners', 'services', 'technologies', 'portfolios', 'testimonials', 'settings', 'industries'));
    }
}
