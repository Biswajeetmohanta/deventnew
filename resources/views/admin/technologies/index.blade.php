@extends('admin.layouts.admin')

@section('title', 'Manage Technologies')
@section('page_title', 'Technologies')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Technology Stack</h3>
        <p class="text-sm text-slate-500">Manage the technologies and tools you use.</p>
    </div>
    <a href="{{ route('admin.technologies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-blue-500/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Add New Technology
    </a>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Logo</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($technologies as $tech)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-slate-100 p-2">
                            @if($tech->logo)
                                <img src="{{ Storage::url($tech->logo) }}" alt="{{ $tech->name }}" class="h-full w-full object-contain">
                            @else
                                <i class="fa-solid fa-microchip text-xl text-slate-300"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $tech->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold uppercase tracking-wider">
                            {{ $tech->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($tech->is_active ?? true)
                            <span class="inline-flex items-center text-emerald-600 text-xs font-bold uppercase">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span> Active
                            </span>
                        @else
                            <span class="inline-flex items-center text-slate-400 text-xs font-bold uppercase">
                                <span class="w-2 h-2 bg-slate-300 rounded-full mr-2"></span> Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.technologies.edit', $tech) }}" class="text-blue-600 hover:text-blue-700 transition-all inline-block p-2 hover:bg-blue-50 rounded-lg" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        <form action="{{ route('admin.technologies.destroy', $tech) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this technology?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-microchip text-4xl mb-3 block opacity-20"></i>
                        No technologies found. Start by adding one!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
