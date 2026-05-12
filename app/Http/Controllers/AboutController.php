<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        return view('about', compact('settings'));
    }
}
