<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = \App\Models\Technology::where('is_active', true)
            ->get()
            ->groupBy('category');
            
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        
        return view('technology', compact('technologies', 'settings'));
    }

    public function show($slug)
    {
        $technology = \App\Models\Technology::where('slug', $slug)->firstOrFail();
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        $technology->load('portfolios');
        $otherTechnologies = \App\Models\Technology::where('is_active', true)->get();
        
        return view('technology.show', compact('technology', 'settings', 'otherTechnologies'));
    }
}
