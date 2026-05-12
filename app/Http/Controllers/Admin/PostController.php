<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'posts');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($post->image) {
                $this->deleteImageDirect($post->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'posts');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            $this->deleteImageDirect($post->image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Blog post deleted successfully.');
    }
}
