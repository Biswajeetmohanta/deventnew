<?php

namespace App\Http\Controllers;

use App\Models\TeamRole;
use App\Models\Post;
use Illuminate\Http\Request;

class TeamRoleController extends Controller
{
    public function index()
    {
        $roles = TeamRole::where('is_active', true)->orderBy('order')->get();
        return view('team-roles.index', compact('roles'));
    }

    public function show($slug)
    {
        $role = TeamRole::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Fetch other roles for related section
        $otherRoles = TeamRole::where('id', '!=', $role->id)
            ->where('is_active', true)
            ->limit(10)
            ->get();

        // Fetch latest blog posts
        $latestPosts = Post::latest()->limit(3)->get();

        return view('team-roles.show', compact('role', 'otherRoles', 'latestPosts'));
    }
}
