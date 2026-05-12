@extends('admin.layouts.admin')

@section('title', 'Edit Blog Post')
@section('page_title', 'Edit: ' . $post->title)

@section('content')
<div class="glass p-8 rounded-3xl max-w-5xl mx-auto">
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $post->title) }}">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label>Current Image</label>
                @if($post->image)
                    <div class="relative group w-48 h-28 mb-4">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full rounded-xl object-cover border border-slate-200 shadow-sm" alt="">
                    </div>
                @else
                    <div class="w-48 h-28 mb-4 bg-slate-50 border border-slate-200 border-dashed rounded-xl flex items-center justify-center text-slate-400 italic text-xs">
                        No image uploaded
                    </div>
                @endif
                
                <label for="image" class="text-xs text-slate-500 font-semibold mb-2">Change Image</label>
                <input type="file" name="image" id="image" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm w-full">
            </div>

            <div>
                <label for="status">Publication Status</label>
                <select name="status" id="status" required>
                    <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
        </div>

        <div>
            <label for="content">Post Content</label>
            <textarea name="content" id="content" rows="15" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection
