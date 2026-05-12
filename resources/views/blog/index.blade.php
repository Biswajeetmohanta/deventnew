@extends('layouts.app')

@section('title', 'Our Blog & Insights | Devent Technology')

@section('content')
    <!-- Hero Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-100/50 rounded-l-[100px] transform translate-x-1/3 -skew-x-12 opacity-30"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-8 tracking-tighter leading-tight">
                Our <span style="color: #0052FF;">Blog</span> & Insights
            </h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium">
                Stay updated with the latest trends in technology, software development, and digital innovation from our expert team.
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($posts as $post)
                    <div class="group bg-white rounded-[40px] overflow-hidden border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden">
                            @if($post->image)
                                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <i class="fa-solid fa-newspaper text-5xl text-slate-200"></i>
                                </div>
                            @endif
                            <div class="absolute top-6 left-6">
                                <span class="bg-[#0052FF] text-white text-[10px] font-black uppercase tracking-widest px-5 py-2.5 rounded-full shadow-lg">Technology</span>
                            </div>
                        </div>
                        <div class="p-10">
                            <div class="flex items-center gap-4 text-slate-400 text-xs font-bold uppercase tracking-widest mb-6">
                                <span class="flex items-center gap-2"><i class="fa-regular fa-calendar text-[#0052FF]"></i> {{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-black text-slate-950 mb-6 tracking-tight group-hover:text-[#0052FF] transition-colors line-clamp-2">
                                <a href="{{ url('/blog/'.$post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-slate-500 leading-relaxed font-medium text-base mb-8 line-clamp-3">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ url('/blog/'.$post->slug) }}" class="flex items-center text-[#0052FF] font-bold text-sm tracking-wider uppercase group/link">
                                Read More <i class="fa-solid fa-arrow-right ml-2 text-xs group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-slate-50 rounded-[40px] border border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-slate-200 mx-auto mb-8 shadow-inner">
                            <i class="fa-solid fa-newspaper text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-black text-slate-950 mb-4">No insights yet</h3>
                        <p class="text-slate-500 font-medium">We're working on some great content. Check back soon!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

    <!-- Global CTA -->
    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-950 rounded-[50px] p-12 md:p-24 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-10 tracking-tighter">Stay updated with <br><span style="color: #0052FF;">Future Tech</span></h2>
                    <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto font-medium">Subscribe to our newsletter and get the latest tech insights directly in your inbox.</p>
                    <a href="{{ url('/contact') }}" class="bg-[#0052FF] text-white px-12 py-5 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-2xl shadow-blue-900/40 inline-flex items-center uppercase tracking-widest text-sm">
                        Subscribe Now <i class="fa-solid fa-paper-plane ml-3"></i>
                    </a>
                </div>
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-20"></div>
            </div>
        </div>
    </section>
@endsection
