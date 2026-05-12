@extends('admin.layouts.admin')

@section('title', 'User Inquiries')
@section('page_title', 'Contact Messages')

@section('content')
<div class="mb-8">
    <h3 class="text-xl font-bold text-slate-800">User Inquiries</h3>
    <p class="text-sm text-slate-500">Monitor and respond to messages from your website visitors.</p>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($inquiries as $inquiry)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $inquiry->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $inquiry->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $inquiry->email }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ Str::limit($inquiry->subject ?? 'General Inquiry', 30) }}</td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-amber-600 hover:text-amber-700 transition-all inline-block p-2 hover:bg-amber-50 rounded-lg" title="View Details">
                            <i class="fa-solid fa-eye text-lg"></i>
                        </a>
                        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this inquiry?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-inbox text-4xl mb-3 block opacity-20"></i>
                        No inquiries yet. Your inbox is clean!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($inquiries->hasPages())
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        {{ $inquiries->links() }}
    </div>
    @endif
</div>
@endsection
