@extends('admin.layouts.admin')

@section('title', 'Edit Testimonial')
@section('page_title', 'Edit: ' . $testimonial->client_name)

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="client_name">Client Name</label>
                <input type="text" name="client_name" id="client_name" required value="{{ old('client_name', $testimonial->client_name) }}">
            </div>

            <div>
                <label for="client_position">Position / Company</label>
                <input type="text" name="client_position" id="client_position" value="{{ old('client_position', $testimonial->client_position) }}">
            </div>

            <div>
                <label for="rating">Rating (Stars)</label>
                <select name="rating" id="rating" required>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                    @endfor
                </select>
            </div>
        </div>

        <div>
            <label for="content">Testimonial Content</label>
            <textarea name="content" id="content" rows="6" required>{{ old('content', $testimonial->content) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
            <div>
                <label>Client Photo</label>
                <div class="flex items-center space-x-6">
                    @if($testimonial->image)
                        <img src="{{ asset('storage/' . $testimonial->image) }}" class="w-20 h-20 rounded-full object-cover border-2 border-amber-500/20 shadow-sm" alt="">
                    @else
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center border-2 border-slate-200 border-dashed">
                            <i class="fa-solid fa-user text-slate-400"></i>
                        </div>
                    @endif
                    <div class="flex-1">
                        <label for="image" class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-2">Change Photo</label>
                        <input type="file" name="image" id="image" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm w-full">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Update Testimonial
            </button>
        </div>
    </form>
</div>
@endsection
