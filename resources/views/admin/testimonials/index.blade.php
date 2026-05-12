@extends('admin.layouts.admin')

@section('title', 'Manage Testimonials')
@section('page_title', 'Testimonials')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Client Feedback</h3>
        <p class="text-sm text-slate-500">Highlight what your clients are saying about you.</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Add New Testimonial
    </a>
</div>

<div class="glass rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Position</th>
                    <th class="px-6 py-4">Rating</th>
                    <th class="px-6 py-4">Message</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($testimonials as $testimonial)
                <tr class="hover:bg-slate-50/50 transition-all">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" class="w-10 h-10 rounded-full object-cover mr-3 border border-slate-200 shadow-sm" alt="">
                            @else
                                <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center mr-3 border border-slate-200">
                                    <i class="fa-solid fa-user text-xs text-slate-400"></i>
                                </div>
                            @endif
                            <span class="font-semibold text-slate-700">{{ $testimonial->client_name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-500 text-sm font-medium">{{ $testimonial->client_position ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex text-xs" style="color: #FFB800;">
                            @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 italic">"{{ Str::limit($testimonial->content, 60) }}"</td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-amber-600 hover:text-amber-700 transition-all inline-block p-2 hover:bg-amber-50 rounded-lg" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-600 transition-all p-2 hover:bg-rose-50 rounded-lg" onclick="return confirm('Are you sure you want to delete this testimonial?')" title="Delete">
                                <i class="fa-solid fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic bg-slate-50/20">
                        <i class="fa-solid fa-comments text-4xl mb-3 block opacity-20"></i>
                        No testimonials found. Collect some praise!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        {{ $testimonials->links() }}
    </div>
    @endif
</div>
@endsection
