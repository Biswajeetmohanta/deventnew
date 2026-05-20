@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'System Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Stat Card -->
    <div class="glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 border border-amber-100">
                <i class="fa-solid fa-gears text-xl"></i>
            </div>
            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Services</span>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800">{{ \App\Models\Service::count() }}</h3>
        <p class="text-slate-500 text-xs mt-1 font-medium">Total services offered</p>
    </div>

    <!-- Stat Card -->
    <div class="glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 border border-blue-100">
                <i class="fa-solid fa-laptop-code text-xl"></i>
            </div>
            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Case Studies</span>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800">{{ \App\Models\CaseStudy::count() }}</h3>
        <p class="text-slate-500 text-xs mt-1 font-medium">Case studies completed</p>
    </div>

    <!-- Stat Card -->
    <div class="glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500 border border-purple-100">
                <i class="fa-solid fa-envelope text-xl"></i>
            </div>
            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Inquiries</span>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800">{{ \App\Models\Inquiry::count() }}</h3>
        <p class="text-slate-500 text-xs mt-1 font-medium">Pending contact requests</p>
    </div>

    <!-- Stat Card -->
    <div class="glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-500 border border-rose-100">
                <i class="fa-solid fa-user-graduate text-xl"></i>
            </div>
            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Careers</span>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800">{{ \App\Models\Career::count() }}</h3>
        <p class="text-slate-500 text-xs mt-1 font-medium">Active job openings</p>
    </div>

    <!-- Stat Card -->
    <div class="glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-500 border border-indigo-100">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Visitors</span>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800">{{ \App\Models\Visitor::count() }}</h3>
        <p class="text-slate-500 text-xs mt-1 font-medium">Total unique visitors</p>
    </div>

    <!-- Stat Card -->
    <div class="glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 border border-emerald-100">
                <i class="fa-solid fa-file-lines text-xl"></i>
            </div>
            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Applications</span>
        </div>
        <h3 class="text-2xl font-extrabold text-slate-800">{{ \App\Models\JobApplication::count() }}</h3>
        <p class="text-slate-500 text-xs mt-1 font-medium">Total job applications</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="glass p-8 rounded-3xl">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-bold text-slate-800">Recent Inquiries</h3>
            <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 uppercase tracking-wider">View All</a>
        </div>
        <div class="space-y-4">
            @forelse(\App\Models\Inquiry::latest()->take(5)->get() as $inquiry)
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 group hover:border-amber-200 transition-all cursor-pointer">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full border border-slate-200 flex items-center justify-center mr-4 text-slate-400 group-hover:text-amber-500 transition-colors">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-700 text-sm">{{ $inquiry->name }}</h4>
                            <p class="text-xs text-slate-500 font-medium">{{ $inquiry->email }}</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">{{ $inquiry->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <div class="text-center py-12">
                    <i class="fa-solid fa-inbox text-4xl text-slate-200 mb-3 block"></i>
                    <p class="text-slate-400 italic text-sm">No recent inquiries found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="glass p-8 rounded-3xl">
        <h3 class="text-xl font-bold text-slate-800 mb-8">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.services.create') }}" class="group p-6 bg-amber-50 border border-amber-100 rounded-2xl text-center hover:bg-amber-100 transition-all hover:shadow-lg hover:shadow-amber-500/5">
                <i class="fa-solid fa-plus block mb-3 text-amber-500 text-2xl group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-bold text-slate-700">Add Service</span>
            </a>
            <a href="{{ route('admin.case-studies.create') }}" class="group p-6 bg-blue-50 border border-blue-100 rounded-2xl text-center hover:bg-blue-100 transition-all hover:shadow-lg hover:shadow-blue-500/5">
                <i class="fa-solid fa-plus block mb-3 text-blue-500 text-2xl group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-bold text-slate-700">Add Case Study</span>
            </a>
            <a href="{{ route('admin.posts.create') }}" class="group p-6 bg-purple-50 border border-purple-100 rounded-2xl text-center hover:bg-purple-100 transition-all hover:shadow-lg hover:shadow-purple-500/5">
                <i class="fa-solid fa-plus block mb-3 text-purple-500 text-2xl group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-bold text-slate-700">New Blog Post</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="group p-6 bg-rose-50 border border-rose-100 rounded-2xl text-center hover:bg-rose-100 transition-all hover:shadow-lg hover:shadow-rose-500/5">
                <i class="fa-solid fa-cog block mb-3 text-rose-500 text-2xl group-hover:scale-110 transition-transform group-hover:rotate-45"></i>
                <span class="text-sm font-bold text-slate-700">Site Settings</span>
            </a>
        </div>
    </div>
</div>
@endsection
