@extends('admin.layouts.admin')

@section('title', 'Manage Industries')
@section('page_title', 'Industries')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Industry List</h3>
        <p class="text-sm text-slate-500">Manage the sectors and industries you serve.</p>
    </div>
    <a href="{{ route('admin.industries.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Add New Industry
    </a>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Icon</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Description</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($industries as $industry)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center border border-blue-100 text-blue-600">
                            @if($industry->icon)
                                <i class="{{ $industry->icon }} text-xl"></i>
                            @else
                                <i class="fa-solid fa-industry text-xl text-slate-400"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $industry->title }}</td>
                    <td class="px-6 py-4 text-slate-500 text-sm truncate max-w-xs">{{ $industry->description }}</td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.industries.edit', $industry) }}" class="text-amber-600 hover:text-amber-700 transition-all inline-block p-2 hover:bg-amber-50 rounded-lg" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        <form action="{{ route('admin.industries.destroy', $industry) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this industry?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-folder-open text-4xl mb-3 block opacity-20"></i>
                        No industries found. Start by adding one!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
