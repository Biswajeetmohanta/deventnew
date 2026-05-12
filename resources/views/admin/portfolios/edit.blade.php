@extends('admin.layouts.admin')

@section('title', 'Edit Project')
@section('page_title', 'Edit: ' . $portfolio->title)

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title">Project Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $portfolio->title) }}">
            </div>

            <div>
                <label for="client">Client Name</label>
                <input type="text" name="client" id="client" value="{{ old('client', $portfolio->client) }}">
            </div>
        </div>

        <div>
            <label for="description">Project Description</label>
            <textarea name="description" id="description" rows="6">{{ old('description', $portfolio->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Technologies Used</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 border border-slate-200 rounded-2xl bg-slate-50">
                @foreach($technologies as $tech)
                    <div class="flex items-center">
                        <input type="checkbox" name="technologies[]" id="tech_{{ $tech->id }}" value="{{ $tech->id }}" 
                            {{ $portfolio->technologies->contains($tech->id) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                        <label for="tech_{{ $tech->id }}" class="ml-2 mb-0 cursor-pointer text-slate-600 font-medium text-sm">{{ $tech->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label>Current Image</label>
                @if($portfolio->image)
                    <div class="relative group w-40 h-24 mb-4">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" class="w-full h-full rounded-xl object-cover border border-slate-200 shadow-sm" alt="">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                            <span class="text-white text-xs font-bold uppercase tracking-wider">Current</span>
                        </div>
                    </div>
                @else
                    <div class="w-40 h-24 mb-4 bg-slate-50 border border-slate-200 border-dashed rounded-xl flex items-center justify-center text-slate-400 italic text-xs">
                        No image
                    </div>
                @endif
                
                <label for="image" class="text-xs text-slate-500 font-semibold mb-2">Change Image</label>
                <input type="file" name="image" id="image" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm w-full">
            </div>

            <div>
                <label for="link">Live Link (URL)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $portfolio->link) }}">
                
                <div class="mt-8 flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $portfolio->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                    <label for="is_active" class="ml-2 mb-0 cursor-pointer text-slate-600 font-medium">Active (Visible on website)</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.portfolios.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Update Project
            </button>
        </div>
    </form>
</div>
@endsection
