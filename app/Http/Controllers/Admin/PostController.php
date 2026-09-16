<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
            'image' => 'nullable|image|max:51200',
            'status' => 'required|in:draft,published',
        ], [
            'image.max' => 'The image size must not exceed 50 MB.',
            'image.image' => 'The uploaded file must be an image.',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'posts');
        }

        $post = Post::create($data);

        // Dynamic Social Media Webhook Trigger (Instagram, LinkedIn via Make.com)
        if ($post->status === 'published' && $request->input('auto_social_share', '1') == '1') {
            $this->sendSocialMediaWebhook($post);
        }

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
            'image' => 'nullable|image|max:51200',
            'status' => 'required|in:draft,published',
        ], [
            'image.max' => 'The image size must not exceed 50 MB.',
            'image.image' => 'The uploaded file must be an image.',
        ]);

        $previousStatus = $post->status;
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($post->image) {
                $this->deleteImageDirect($post->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'posts');
        }

        $post->update($data);

        // Trigger social media webhook if newly published, or manually requested
        if ($post->status === 'published' && ($previousStatus === 'draft' || $request->input('auto_social_share') == '1')) {
            $this->sendSocialMediaWebhook($post);
        }

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

    /**
     * Dynamically send blog post details to Make.com Webhook for LinkedIn & Instagram publishing
     */
    protected function sendSocialMediaWebhook(Post $post)
    {
        try {
            $enabled = Setting::where('key', 'make_blog_webhook_enabled')->value('value') ?? '1';
            $webhookUrl = Setting::where('key', 'make_blog_webhook_url')->value('value');

            if ($enabled == '1' && !empty($webhookUrl)) {
                $imageUrl = null;
                if ($post->image) {
                    $imageUrl = filter_var($post->image, FILTER_VALIDATE_URL) ? $post->image : asset('storage/' . $post->image);
                }

                Http::timeout(6)->post($webhookUrl, [
                    'id'           => $post->id,
                    'title'        => $post->title,
                    'slug'         => $post->slug,
                    'excerpt'      => Str::limit(strip_tags($post->content), 200),
                    'url'          => url('/blog/' . $post->slug),
                    'image_url'    => $imageUrl,
                    'published_at' => $post->created_at ? $post->created_at->toDateTimeString() : now()->toDateTimeString(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Make.com social media auto-post webhook failed: ' . $e->getMessage());
        }
    }
}
