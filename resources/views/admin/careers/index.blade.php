@extends('admin.layouts.admin')

@section('title', 'Manage Careers')
@section('page_title', 'Career Openings')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Job Postings</h3>
        <p class="text-sm text-slate-500">Recruit top talent for your growing team.</p>
    </div>
    <a href="{{ route('admin.careers.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Post New Job
    </a>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Job Title</th>
                    <th class="px-6 py-4">Deadline</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($careers as $career)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $career->job_title }}</td>
                    <td class="px-6 py-4 text-slate-500 text-sm font-medium">
                        {{ $career->deadline ? \Carbon\Carbon::parse($career->deadline)->format('M d, Y') : 'No deadline' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($career->is_open)
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold border border-emerald-100 uppercase tracking-tighter">Open</span>
                        @else
                            <span class="bg-rose-50 text-rose-600 px-3 py-1 rounded-full text-xs font-bold border border-rose-100 uppercase tracking-tighter">Closed</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.careers.edit', $career) }}" class="text-amber-600 hover:text-amber-700 transition-all inline-block p-2 hover:bg-amber-50 rounded-lg" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        <form action="{{ route('admin.careers.destroy', $career) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this job posting?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-user-tie text-4xl mb-3 block opacity-20"></i>
                        No job openings found. Grow your team!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($careers->hasPages())
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        {{ $careers->links() }}
    </div>
    @endif
</div>
@endsection
