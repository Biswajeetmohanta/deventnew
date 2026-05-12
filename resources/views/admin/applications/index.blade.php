@extends('admin.layouts.admin')

@section('title', 'Job Applications')
@section('page_title', 'Job Applications')

@section('content')
<div class="mb-8">
    <h3 class="text-xl font-bold text-slate-800">Job Applications</h3>
    <p class="text-sm text-slate-500">View and manage applications submitted for your job openings.</p>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Applicant</th>
                    <th class="px-6 py-4">Position</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($applications as $application)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $application->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-700">{{ $application->name }}</div>
                        <div class="text-xs text-slate-500">{{ $application->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $application->career->job_title }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full 
                            {{ $application->status === 'pending' ? 'bg-amber-100 text-amber-700' : 
                               ($application->status === 'shortlisted' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700') }}">
                            {{ $application->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.applications.show', $application) }}" class="text-blue-600 hover:text-blue-700 transition-all inline-block p-2 hover:bg-blue-50 rounded-lg" title="View Details">
                            <i class="fa-solid fa-eye text-lg"></i>
                        </a>
                        <form action="{{ route('admin.applications.destroy', $application) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this application?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-file-lines text-4xl mb-3 block opacity-20"></i>
                        No applications yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($applications->hasPages())
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        {{ $applications->links() }}
    </div>
    @endif
</div>
@endsection
