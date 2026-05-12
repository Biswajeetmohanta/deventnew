@extends('admin.layouts.admin')

@section('title', 'Post New Job')
@section('page_title', 'Create Job Opening')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.careers.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="job_title">Job Title</label>
                <input type="text" name="job_title" id="job_title" required value="{{ old('job_title') }}" placeholder="e.g. Senior Laravel Developer">
            </div>

            <div>
                <label for="deadline">Application Deadline</label>
                <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}" class="bg-white border border-slate-200 rounded-xl px-4 py-3 w-full">
            </div>
        </div>

        <div>
            <label for="description">Job Description</label>
            <textarea name="description" id="description" rows="5" placeholder="Detailed job role and responsibilities...">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="requirements">Requirements</label>
            <textarea name="requirements" id="requirements" rows="5" placeholder="Skills, experience, and qualifications needed...">{{ old('requirements') }}</textarea>
        </div>

        <div>
            <label for="benefits">Benefits</label>
            <textarea name="benefits" id="benefits" rows="3" placeholder="What we offer (Salary, Insurance, etc.)...">{{ old('benefits') }}</textarea>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_open" id="is_open" value="1" {{ old('is_open', true) ? 'checked' : '' }}
                class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
            <label for="is_open" class="ml-2 mb-0 cursor-pointer text-slate-600 font-medium">Open for Applications</label>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.careers.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Post Job
            </button>
        </div>
    </form>
</div>
@endsection
