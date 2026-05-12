<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\Post;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $otherServices = Service::where('slug', '!=', $slug)->where('is_active', true)->take(6)->get();
        $latestPosts = Post::where('status', 'published')->latest()->take(3)->get();
        return view('services.show', compact('service', 'otherServices', 'latestPosts'));
    }
}
