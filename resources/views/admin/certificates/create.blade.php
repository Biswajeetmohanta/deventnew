@extends('admin.layouts.admin')

@section('title', 'Add Certificate')
@section('page_title', 'Create Certificate')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title">Certificate Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="e.g. ISO 9001:2015 Quality Management System">
            </div>

            <div>
                <label for="issuer">Issuer (Optional)</label>
                <input type="text" name="issuer" id="issuer" value="{{ old('issuer') }}" placeholder="e.g. IAS Accreditations">
            </div>

            <div>
                <label for="issue_date">Issue Date (Optional)</label>
                <input type="date" name="issue_date" id="issue_date" value="{{ old('issue_date') }}">
            </div>

            <div>
                <label for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" required value="{{ old('sort_order', 0) }}" placeholder="e.g. 0">
            </div>

            <div>
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="1" {{ old('status') == '1' || old('status') === null ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div>
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description" rows="4" placeholder="Brief description of the certificate, its scope, or impact...">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="image_or_pdf">Certificate Document (Image or PDF)</label>
            <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50">
                <div class="space-y-1 text-center">
                    <i class="fa-solid fa-file-arrow-up text-slate-300 text-3xl mb-2"></i>
                    <div class="flex text-sm text-slate-600">
                        <input type="file" name="image_or_pdf" id="image_or_pdf" required class="sr-only">
                        <label for="image_or_pdf" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none">
                            <span>Upload a file</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-500">PDF, PNG, JPG up to 5MB</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.certificates.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Save Certificate
            </button>
        </div>
    </form>
</div>
@endsection
