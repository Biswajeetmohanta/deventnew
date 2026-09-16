@extends('portal.layouts.app')

@section('title', 'Client Dashboard | Devent Technology')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Welcome, {{ auth()->user()->name }}</h1>
    <p class="text-slate-500 font-medium mt-1">Here is a quick overview of your projects and invoices.</p>
</div>

<!-- Stats grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stat card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-12 h-12 bg-blue-50 text-[#0052FF] rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-folder-open"></i>
        </div>
        <div>
            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider">Active Projects</span>
            <span class="text-2xl font-black text-slate-800">{{ $activeProjectsCount }}</span>
        </div>
    </div>

    <!-- Stat card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-file-invoice-dollar"></i>
        </div>
        <div>
            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider">Total Invoiced</span>
            <span class="text-2xl font-black text-slate-800">${{ number_format($totalInvoiced, 2) }}</span>
        </div>
    </div>

    <!-- Stat card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider">Total Paid</span>
            <span class="text-2xl font-black text-slate-800">${{ number_format($totalPaid, 2) }}</span>
        </div>
    </div>

    <!-- Stat card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center text-xl">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div>
            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider">Balance Due</span>
            <span class="text-2xl font-black text-red-500">${{ number_format($balanceDue, 2) }}</span>
        </div>
    </div>
</div>

<!-- Project section -->
<div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
    <h2 class="text-xl font-black text-slate-800 mb-6">Your Projects</h2>
    
    @if($projects->isEmpty())
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-700">No projects found</h3>
            <p class="text-sm text-slate-400 font-medium">When we start a new project with you, it will show up here.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($projects as $project)
                <div class="border border-slate-100 rounded-2xl p-6 hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-black text-slate-800 text-lg leading-tight">{{ $project->name }}</h3>
                            <span class="text-xs font-bold uppercase px-3 py-1 rounded-full 
                                @if($project->status === 'completed') bg-green-50 text-green-600
                                @elseif($project->status === 'in_progress') bg-blue-50 text-blue-600
                                @elseif($project->status === 'review') bg-yellow-50 text-yellow-600
                                @else bg-slate-100 text-slate-500 @endif">
                                {{ str_replace('_', ' ', $project->status) }}
                            </span>
                        </div>
                        
                        <p class="text-sm text-slate-500 font-medium mb-6 line-clamp-2">
                            {{ $project->description ?? 'No project details provided yet.' }}
                        </p>
                    </div>
                    
                    <div>
                        <!-- Project progress bar -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center text-xs font-bold text-slate-400 mb-2">
                                <span>Project Progress</span>
                                <span>{{ $project->progress_percent }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-[#0052FF] h-full transition-all duration-300" style="width: {{ $project->progress_percent }}%;"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center text-xs font-bold text-slate-400 border-t border-slate-100 pt-4 mt-4">
                            <span>Milestones: {{ $project->completed_milestones_count }} / {{ $project->milestones_count }}</span>
                            <a href="{{ url('/portal/projects/' . $project->id) }}" class="text-[#0052FF] hover:text-blue-600 transition-colors flex items-center gap-1">
                                View Details <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
