@extends('admin.layouts.admin')

@section('title', 'Edit Portfolio Project')
@section('page_title', 'Edit Portfolio Project')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.clients.update', $client) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name">Project Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $client->name) }}" placeholder="e.g. Acme Corporation">
            </div>

            <div>
                <label for="website_url">Website URL (Optional)</label>
                <input type="url" name="website_url" id="website_url" value="{{ old('website_url', $client->website_url) }}" placeholder="e.g. https://acme.com">
            </div>

            <div>
                <label for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" required value="{{ old('sort_order', $client->sort_order) }}" placeholder="e.g. 0">
            </div>

            <div>
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="1" {{ old('status', $client->status ? '1' : '0') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $client->status ? '1' : '0') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div>
            <label for="description">Project Details (Optional)</label>
            <textarea name="description" id="description" rows="4" placeholder="Brief details about the project, partnership, or work delivered...">{{ old('description', $client->description) }}</textarea>
        </div>

        <div>
            <label for="logo">Project Logo (Leave blank to keep current)</label>
            <div class="mt-1 flex items-center justify-between gap-6 px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50">
                <div class="space-y-1 text-center">
                    <i class="fa-solid fa-image text-slate-300 text-3xl mb-2"></i>
                    <div class="flex text-sm text-slate-600">
                        <input type="file" name="logo" id="logo" class="sr-only">
                        <label for="logo" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none">
                            <span>Upload a new logo image</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-500">PNG, JPG up to 2MB (transparent SVG/PNG looks best)</p>
                </div>
                @if($client->logo)
                    <div class="text-center">
                        <p class="text-xs font-semibold text-slate-500 mb-2">Current Logo</p>
                        <img src="{{ asset('storage/' . $client->logo) }}" class="h-20 w-auto object-contain border border-slate-200 rounded-lg p-2 bg-white shadow-sm" alt="Current Logo">
                    </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.clients.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Update Project
            </button>
        </div>
    </form>
</div>
@endsection
