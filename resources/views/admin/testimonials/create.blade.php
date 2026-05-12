@extends('admin.layouts.admin')

@section('title', 'Add Testimonial')
@section('page_title', 'Create Testimonial')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="client_name">Client Name</label>
                <input type="text" name="client_name" id="client_name" required value="{{ old('client_name') }}" placeholder="e.g. John Doe">
            </div>

            <div>
                <label for="client_position">Position / Company</label>
                <input type="text" name="client_position" id="client_position" value="{{ old('client_position') }}" placeholder="e.g. CEO at TechCorp">
            </div>

            <div>
                <label for="rating">Rating (Stars)</label>
                <select name="rating" id="rating" required>
                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 Stars</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                </select>
            </div>
        </div>

        <div>
            <label for="content">Testimonial Content</label>
            <textarea name="content" id="content" rows="6" required placeholder="What did the client say about your service?"></textarea>
        </div>

        <div>
            <label for="image">Client Photo (Optional)</label>
            <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50">
                <div class="space-y-1 text-center">
                    <i class="fa-solid fa-user-plus text-slate-300 text-3xl mb-2"></i>
                    <div class="flex text-sm text-slate-600">
                        <input type="file" name="image" id="image" class="sr-only">
                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none">
                            <span>Upload a photo</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-500">Square images look best</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Save Testimonial
            </button>
        </div>
    </form>
</div>
@endsection
