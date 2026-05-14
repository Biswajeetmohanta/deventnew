@extends('admin.layouts.admin')

@section('title', 'Chat Auto Replies')
@section('page_title', 'Manage Auto Replies')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-black text-slate-900">Keyword Auto Replies</h3>
        <a href="{{ route('admin.chat-auto-replies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Add New Reply
        </a>
    </div>

    <div class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-tl-xl">Keyword</th>
                        <th scope="col" class="px-6 py-3">Reply</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3 rounded-tr-xl text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($replies as $reply)
                        <tr class="bg-white border-b hover:bg-slate-50">
                            <td class="px-6 py-4 font-bold text-slate-900">{{ $reply->keyword }}</td>
                            <td class="px-6 py-4">{{ Str::limit($reply->reply, 100) }}</td>
                            <td class="px-6 py-4">
                                @if($reply->is_active)
                                    <span class="px-2 py-1 text-xs font-bold text-emerald-700 bg-emerald-100 rounded-full">Active</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-bold text-slate-700 bg-slate-100 rounded-full">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.chat-auto-replies.edit', $reply->id) }}" class="text-blue-600 hover:text-blue-900 font-bold">Edit</a>
                                <form action="{{ route('admin.chat-auto-replies.destroy', $reply->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-slate-500">No auto-replies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
