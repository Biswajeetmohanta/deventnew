<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->latest()->paginate(9);
        $settings = Setting::pluck('value', 'key')->all();
        
        return view('blog.index', compact('posts', 'settings'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $settings = Setting::pluck('value', 'key')->all();
        $recent_posts = Post::where('status', 'published')
                            ->where('id', '!=', $post->id)
                            ->latest()
                            ->limit(3)
                            ->get();

        return view('blog.show', compact('post', 'settings', 'recent_posts'));
    }
}
