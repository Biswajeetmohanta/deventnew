@extends('admin.layouts.admin')

@section('title', 'Portal Clients')

@section('content')
<div class="glass rounded-2xl p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Client Accounts</h1>
            <p class="text-sm text-slate-400 font-medium">Manage client login accounts for the client workspace portal.</p>
        </div>
        <a href="{{ route('admin.portal-clients.create') }}" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-sm">
            <i class="fa-solid fa-plus mr-1"></i> Add Client
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl mb-6 font-bold text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-100">
                <th class="px-6 py-4 text-xs font-black uppercase text-slate-400">Name</th>
                <th class="px-6 py-4 text-xs font-black uppercase text-slate-400">Email</th>
                <th class="px-6 py-4 text-xs font-black uppercase text-slate-400">Created At</th>
                <th class="px-6 py-4 text-xs font-black uppercase text-slate-400 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($clients as $client)
                <tr class="hover:bg-slate-50/50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-600 uppercase">
                                {{ substr($client->name, 0, 2) }}
                            </div>
                            <span class="font-bold text-slate-800">{{ $client->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-500">{{ $client->email }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-400">{{ $client->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.portal-clients.edit', $client->id) }}" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 transition-colors">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.portal-clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-12 text-slate-400 font-medium">No clients found. Click "Add Client" to get started.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
