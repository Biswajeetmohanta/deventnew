@extends('admin.layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="glass rounded-2xl p-6 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Edit Project</h1>
            <p class="text-sm text-slate-400 font-medium">Update core details, progress, or status details for this project.</p>
        </div>
        <a href="{{ route('admin.projects.show', $project->id) }}" class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold rounded-xl transition-colors">
            Back
        </a>
    </div>
</div>

<div class="glass rounded-2xl p-6 max-w-xl">
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-xs font-bold">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" class="flex flex-col gap-5">
        @csrf
        @method('PUT')
        
        <div>
            <label>Select Portal Client Account</label>
            <select name="user_id" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $project->user_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }} ({{ $client->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Project Name</label>
            <input type="text" name="name" value="{{ old('name', $project->name) }}" required>
        </div>

        <div>
            <label>Project Description</label>
            <textarea name="description" rows="4">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label>Progress Percentage (0 - 100)</label>
                <input type="number" name="progress_percent" value="{{ old('progress_percent', $project->progress_percent) }}" min="0" max="100" required>
            </div>

            <div>
                <label>Status</label>
                <select name="status" required>
                    <option value="planning" {{ $project->status == 'planning' ? 'selected' : '' }}>Planning</option>
                    <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="review" {{ $project->status == 'review' ? 'selected' : '' }}>Review</option>
                    <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
        </div>

        <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-sm">
            Save Project Changes
        </button>
    </form>
</div>
@endsection
