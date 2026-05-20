@extends('admin.layouts.admin')

@section('title', 'Manage Case Studies')
@section('page_title', 'Case Studies')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Case Study List</h3>
        <p class="text-sm text-slate-500">Showcase your dynamically structured case studies and client projects.</p>
    </div>
    <a href="{{ route('admin.case-studies.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Add New Case Study
    </a>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Industry</th>
                    <th class="px-6 py-4">Order</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($caseStudies as $caseStudy)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4">
                        @if($caseStudy->image)
                            <img src="{{ asset('storage/' . $caseStudy->image) }}" class="w-12 h-12 rounded-xl object-cover shadow-sm border border-slate-200" alt="{{ $caseStudy->title }}">
                        @else
                            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center border border-slate-200">
                                <i class="fa-solid fa-laptop-code text-slate-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-700">
                        {{ $caseStudy->title }}
                        @if(isset($caseStudy->content_data) && !empty($caseStudy->content_data))
                            <span class="block text-[10px] text-blue-600 font-bold uppercase tracking-wider mt-1"><i class="fa-solid fa-circle-check mr-1"></i>Dynamic content</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-medium">{{ $caseStudy->client ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-slate-500 font-medium">
                        @if($caseStudy->industry)
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold border border-blue-100">{{ $caseStudy->industry->title }}</span>
                        @else
                            <span class="text-slate-400">N/A</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-medium">{{ $caseStudy->order }}</td>
                    <td class="px-6 py-4">
                        @if($caseStudy->is_active)
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold border border-emerald-100 uppercase tracking-tighter">Active</span>
                        @else
                            <span class="bg-rose-50 text-rose-600 px-3 py-1 rounded-full text-xs font-bold border border-rose-100 uppercase tracking-tighter">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.case-studies.edit', $caseStudy) }}" class="text-amber-600 hover:text-amber-700 transition-all inline-block p-2 hover:bg-amber-50 rounded-lg" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        <form action="{{ route('admin.case-studies.destroy', $caseStudy) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this case study?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-folder-open text-4xl mb-3 block opacity-20"></i>
                        No case studies found. Build your dynamic portfolio!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($caseStudies->hasPages())
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        {{ $caseStudies->links() }}
    </div>
    @endif
</div>
@endsection
