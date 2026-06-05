@extends('admin.layouts.admin')

@section('title', 'Manage Certificates')
@section('page_title', 'Certificates')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Certificates & Accreditations</h3>
        <p class="text-sm text-slate-500">Manage company achievements, credentials, ISO/accreditation certificates.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Add New Certificate
    </a>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Issuer</th>
                    <th class="px-6 py-4">Issue Date</th>
                    <th class="px-6 py-4">File / Preview</th>
                    <th class="px-6 py-4">Sort Order</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($certificates as $certificate)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4">
                        <span class="font-bold text-slate-700 block">{{ $certificate->title }}</span>
                        <span class="text-xs text-slate-400 block">{{ Str::limit($certificate->description, 50) }}</span>
                    </td>
                    <td class="px-6 py-4 text-slate-500 text-sm font-semibold">{{ $certificate->issuer ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-slate-500 text-sm">{{ $certificate->issue_date ? $certificate->issue_date->format('Y-m-d') : 'N/A' }}</td>
                    <td class="px-6 py-4">
                        @if($certificate->image_or_pdf)
                            @php
                                $isPdf = strtolower(pathinfo($certificate->image_or_pdf, PATHINFO_EXTENSION)) === 'pdf';
                            @endphp
                            <a href="{{ asset('storage/' . $certificate->image_or_pdf) }}" target="_blank" class="flex items-center text-amber-600 hover:underline gap-1.5 text-sm font-medium">
                                @if($isPdf)
                                    <i class="fa-solid fa-file-pdf text-rose-500 text-lg"></i> Open PDF
                                @else
                                    <img src="{{ asset('storage/' . $certificate->image_or_pdf) }}" class="w-10 h-10 object-cover border border-slate-200 rounded-md" alt="">
                                    View Image
                                @endif
                            </a>
                        @else
                            <span class="text-slate-400">No file</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-600 text-sm">{{ $certificate->sort_order }}</td>
                    <td class="px-6 py-4">
                        @if($certificate->status)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.certificates.edit', $certificate) }}" class="text-amber-600 hover:text-amber-700 transition-all inline-block p-2 hover:bg-amber-50 rounded-lg" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this certificate?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-award text-4xl mb-3 block opacity-20"></i>
                        No certificates found. Build credibility with accreditation documents!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($certificates->hasPages())
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        {{ $certificates->links() }}
    </div>
    @endif
</div>
@endsection
