<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = \App\Models\Testimonial::all();
        return view('testimonials', compact('testimonials'));
    }
}
