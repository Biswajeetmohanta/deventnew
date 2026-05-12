@extends('admin.layouts.admin')

@section('title', 'Create New Post')
@section('page_title', 'New Blog Post')

@section('content')
<div class="glass p-8 rounded-3xl max-w-5xl mx-auto">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div>
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="Enter an engaging title...">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="image">Featured Image</label>
                <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50">
                    <div class="space-y-1 text-center">
                        <i class="fa-solid fa-camera-retro text-slate-300 text-3xl mb-2"></i>
                        <div class="flex text-sm text-slate-600">
                            <input type="file" name="image" id="image" class="sr-only">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none">
                                <span>Upload an image</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label for="status">Publication Status</label>
                <select name="status" id="status" required>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
                <p class="mt-4 text-xs text-slate-500 bg-slate-50 p-3 rounded-lg border border-slate-100">
                    <i class="fa-solid fa-circle-info mr-1 text-amber-500"></i> Published posts will appear immediately on the website.
                </p>
            </div>
        </div>

        <div>
            <label for="content">Post Content</label>
            <textarea name="content" id="content" rows="15" required placeholder="Write your post content here (HTML supported)...">{{ old('content') }}</textarea>
            <p class="text-xs text-slate-400 mt-2 italic flex items-center">
                <i class="fa-solid fa-code mr-1"></i> Tip: You can use HTML tags for rich content formatting.
            </p>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Save Post
            </button>
        </div>
    </form>
</div>
@endsection
