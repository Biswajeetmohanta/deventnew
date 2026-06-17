@extends('admin.layouts.admin')

@section('title', 'Manage Portfolio')
@section('page_title', 'Portfolio')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Our Portfolio</h3>
        <p class="text-sm text-slate-500">Manage portfolio projects, logos, and display ordering.</p>
    </div>
    <a href="{{ route('admin.clients.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Add New Project
    </a>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Project Info</th>
                    <th class="px-6 py-4">Website</th>
                    <th class="px-6 py-4">Sort Order</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($clients as $client)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($client->logo)
                                <img src="{{ asset('storage/' . $client->logo) }}" class="w-12 h-12 object-contain mr-4 border border-slate-150 p-1 bg-white rounded-lg shadow-sm" alt="{{ $client->name }}">
                            @else
                                <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center mr-4 border border-slate-200">
                                    <i class="fa-solid fa-building text-slate-400"></i>
                                </div>
                            @endif
                            <div>
                                <span class="font-bold text-slate-700 block">{{ $client->name }}</span>
                                <span class="text-xs text-slate-400 block">{{ Str::limit($client->description, 50) }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500 text-sm font-medium">
                        @if($client->website_url)
                            <a href="{{ $client->website_url }}" target="_blank" class="text-amber-600 hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i> Visit Website
                            </a>
                        @else
                            <span class="text-slate-400">N/A</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-600 text-sm">{{ $client->sort_order }}</td>
                    <td class="px-6 py-4">
                        @if($client->status)
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
                        <a href="{{ route('admin.clients.edit', $client) }}" class="text-amber-600 hover:text-amber-700 transition-all inline-block p-2 hover:bg-amber-50 rounded-lg" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this portfolio project?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-folder-open text-4xl mb-3 block opacity-20"></i>
                        No portfolio projects found. Showcase your work!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($clients->hasPages())
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        {{ $clients->links() }}
    </div>
    @endif
</div>
@endsection
