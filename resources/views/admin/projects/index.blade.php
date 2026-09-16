@extends('admin.layouts.admin')

@section('title', 'Client Projects')

@section('content')
<div class="glass rounded-2xl p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Client Projects</h1>
            <p class="text-sm text-slate-400 font-medium">Create and track progress, milestones, and invoices for clients.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-sm">
            <i class="fa-solid fa-plus mr-1"></i> Add Project
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl mb-6 font-bold text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($projects as $project)
        <div class="glass rounded-2xl p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center justify-between gap-3 mb-3">
                    <span class="text-xs font-black uppercase px-2.5 py-0.5 rounded-full 
                        @if($project->status === 'completed') bg-green-50 text-green-600
                        @elseif($project->status === 'in_progress') bg-blue-50 text-blue-600
                        @elseif($project->status === 'review') bg-yellow-50 text-yellow-600
                        @else bg-slate-100 text-slate-500 @endif">
                        {{ str_replace('_', ' ', $project->status) }}
                    </span>
                    <span class="text-xs text-slate-400 font-bold uppercase">Client: {{ $project->user->name }}</span>
                </div>

                <h3 class="font-black text-slate-800 text-lg mb-2 truncate">{{ $project->name }}</h3>
                <p class="text-sm text-slate-400 font-medium mb-6 line-clamp-2">{{ $project->description ?? 'No description provided.' }}</p>
            </div>

            <div>
                <!-- Progress bar -->
                <div class="mb-6">
                    <div class="flex justify-between items-center text-xs font-bold text-slate-400 mb-1.5">
                        <span>Progress</span>
                        <span>{{ $project->progress_percent }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-[#0052FF] h-full transition-all duration-300" style="width: {{ $project->progress_percent }}%;"></div>
                    </div>
                </div>

                <div class="flex justify-between items-center border-t border-slate-100 pt-4">
                    <a href="{{ route('admin.projects.show', $project->id) }}" class="text-sm font-bold text-[#0052FF] hover:underline">
                        Manage <i class="fa-solid fa-arrow-right text-xs ml-0.5"></i>
                    </a>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full glass rounded-2xl p-12 text-center text-slate-400 font-medium">
            No projects found. Click "Add Project" to get started.
        </div>
    @endif
</div>
@endsection
