@extends('admin.layouts.admin')

@section('title', 'Application Details')
@section('page_title', 'Application Details')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.applications.index') }}" class="text-sm font-bold text-amber-600 hover:text-amber-700 flex items-center gap-2 mb-4">
        <i class="fa-solid fa-arrow-left"></i> Back to Applications
    </a>
    <h3 class="text-2xl font-bold text-slate-800">Application from {{ $application->name }}</h3>
    <p class="text-sm text-slate-500">Submitted on {{ $application->created_at->format('F d, Y @ h:i A') }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        <div class="glass p-8 rounded-3xl">
            <h4 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Applicant Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Full Name</label>
                    <p class="text-slate-800 font-semibold">{{ $application->name }}</p>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Email Address</label>
                    <p class="text-slate-800 font-semibold">{{ $application->email }}</p>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Phone Number</label>
                    <p class="text-slate-800 font-semibold">{{ $application->phone }}</p>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Applying For</label>
                    <p class="text-blue-600 font-bold">{{ $application->career->job_title }}</p>
                </div>
            </div>
        </div>

        <div class="glass p-8 rounded-3xl">
            <h4 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Cover Letter / Message</h4>
            <div class="prose prose-slate max-w-none text-slate-600">
                {!! nl2br(e($application->cover_letter ?? 'No cover letter provided.')) !!}
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div class="glass p-8 rounded-3xl">
            <h4 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Status & Actions</h4>
            <form action="{{ route('admin.applications.update', $application) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Update Status</label>
                    <select name="status" class="w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-amber-500">
                        <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewed" {{ $application->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                        <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-900 transition-all">
                    Update Status
                </button>
            </form>
        </div>

        <div class="glass p-8 rounded-3xl bg-blue-50/50 border-blue-100">
            <h4 class="text-lg font-bold text-slate-800 mb-6 border-b border-blue-100 pb-4">Documents</h4>
            <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="flex items-center gap-4 p-4 bg-white border border-blue-100 rounded-2xl hover:shadow-md transition-all group">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-file-pdf text-xl"></i>
                </div>
                <div>
                    <p class="font-bold text-slate-800 text-sm">Download Resume</p>
                    <p class="text-xs text-slate-500">PDF / DOCX File</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
