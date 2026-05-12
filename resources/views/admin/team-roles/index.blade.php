@extends('admin.layouts.admin')

@section('title', 'Team Roles')
@section('page_title', 'Build Your Team Roles')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <p class="text-slate-500 font-medium">Manage dedicated developer hiring pages.</p>
    </div>
    <a href="{{ route('admin.team-roles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-black px-8 py-3 rounded-2xl transition-all shadow-xl shadow-blue-500/20 active:scale-95 flex items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        Add New Role
    </a>
</div>

<div class="glass overflow-hidden rounded-3xl">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">Order</th>
                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">Role</th>
                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">Slug</th>
                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">Status</th>
                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($roles as $role)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-5">
                        <span class="font-black text-slate-400">#{{ $role->order }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100">
                                @if($role->icon)
                                    <i class="{{ $role->icon }} text-xl"></i>
                                @else
                                    <i class="fa-solid fa-users text-xl"></i>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 leading-none mb-1">{{ $role->title }}</h4>
                                <span class="text-xs font-bold text-slate-400">Created {{ $role->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <code class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">/build-your-team/{{ $role->slug }}</code>
                    </td>
                    <td class="px-8 py-5">
                        @if($role->is_active)
                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-black bg-emerald-100 text-emerald-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-black bg-slate-100 text-slate-500">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.team-roles.edit', $role) }}" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>
                            <form action="{{ route('admin.team-roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="max-w-xs mx-auto">
                            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-300 mx-auto mb-6 border border-slate-100 border-dashed">
                                <i class="fa-solid fa-users-slash text-3xl"></i>
                            </div>
                            <h3 class="font-black text-slate-900 mb-2">No Roles Found</h3>
                            <p class="text-sm text-slate-400 mb-8 font-medium">Get started by creating your first hiring role for the "Build Your Team" section.</p>
                            <a href="{{ route('admin.team-roles.create') }}" class="text-blue-600 font-black text-sm hover:underline">+ Create Role</a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
