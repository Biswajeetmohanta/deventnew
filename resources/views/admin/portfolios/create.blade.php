@extends('admin.layouts.admin')

@section('title', 'Add New Project')
@section('page_title', 'Create Portfolio')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title">Project Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="e.g. E-commerce Website">
            </div>

            <div>
                <label for="client">Client Name</label>
                <input type="text" name="client" id="client" value="{{ old('client') }}" placeholder="e.g. Acme Corp">
            </div>
        </div>

        <div>
            <label for="description">Project Description</label>
            <textarea name="description" id="description" rows="6" placeholder="Describe the project details...">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Technologies Used</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 border border-slate-200 rounded-2xl bg-slate-50">
                @foreach($technologies as $tech)
                    <div class="flex items-center">
                        <input type="checkbox" name="technologies[]" id="tech_{{ $tech->id }}" value="{{ $tech->id }}" 
                            class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                        <label for="tech_{{ $tech->id }}" class="ml-2 mb-0 cursor-pointer text-slate-600 font-medium text-sm">{{ $tech->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="image">Featured Image</label>
                <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50">
                    <div class="space-y-1 text-center">
                        <i class="fa-solid fa-cloud-arrow-up text-slate-300 text-3xl mb-2"></i>
                        <div class="flex text-sm text-slate-600">
                            <input type="file" name="image" id="image" class="sr-only">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none">
                                <span>Upload a file</span>
                            </label>
                        </div>
                        <p class="text-xs text-slate-500">PNG, JPG up to 2MB</p>
                    </div>
                </div>
            </div>

            <div>
                <label for="link">Live Link (URL)</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}" placeholder="https://example.com">
                <div class="mt-8 flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                    <label for="is_active" class="ml-2 mb-0 cursor-pointer text-slate-600 font-medium">Active (Visible on website)</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.portfolios.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Save Project
            </button>
        </div>
    </form>
</div>
@endsection
