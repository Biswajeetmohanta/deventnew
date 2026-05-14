@extends('admin.layouts.admin')

@section('title', 'Add Auto Reply')
@section('page_title', 'Create Auto Reply')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.chat-auto-replies.index') }}" class="text-slate-600 hover:text-slate-900 font-bold text-sm flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <div class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
        <div class="flex items-center mb-10">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mr-4">
                <i class="fa-solid fa-plus text-blue-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-black text-slate-900">Add New Auto Reply</h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Define a new keyword and reply</p>
            </div>
        </div>

        <form action="{{ route('admin.chat-auto-replies.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="keyword" class="block text-sm font-bold text-slate-700 mb-2">Keyword</label>
                <input type="text" name="keyword" id="keyword" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. price, support, hello" required>
                <p class="mt-1 text-xs text-slate-400">The message will trigger this reply if it contains this keyword.</p>
            </div>

            <div>
                <label for="reply" class="block text-sm font-bold text-slate-700 mb-2">Reply Message</label>
                <textarea name="reply" id="reply" rows="5" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter the automatic response message..." required></textarea>
            </div>

            <div>
                <label for="is_active" class="block text-sm font-bold text-slate-700 mb-2">Status</label>
                <select name="is_active" id="is_active" class="rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-black px-8 py-3 rounded-xl transition-all shadow-lg active:scale-95 flex items-center">
                    <i class="fa-solid fa-save mr-2"></i>
                    Save Reply
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
