@extends('layouts.app')

@section('title', $post->title . ' | Devent Technology')

@section('content')
    <!-- Header Section -->
    <section class="pt-32 pb-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-0 w-1/3 h-full bg-blue-100/50 rounded-r-[100px] transform -translate-x-1/3 skew-x-12 opacity-30"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="flex items-center justify-center gap-4 text-[#0052FF] text-xs font-black uppercase tracking-[0.3em] mb-8">
                <span>{{ $post->created_at->format('M d, Y') }}</span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                <span>Technology</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-slate-950 mb-10 tracking-tighter leading-tight">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-[#0052FF] flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-200">
                    D
                </div>
                <div class="text-left">
                    <p class="text-slate-950 font-black text-base">Devent Admin</p>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Tech Expert</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-20">
                <!-- Main Content -->
                <div class="lg:w-2/3">
                    @if($post->image)
                        <div class="rounded-[50px] overflow-hidden mb-16 shadow-2xl shadow-slate-200/50 border border-slate-100">
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-auto">
                        </div>
                    @endif

                    <div class="prose prose-xl prose-slate max-w-none prose-headings:text-slate-950 prose-headings:font-black prose-headings:tracking-tighter prose-p:text-slate-600 prose-p:leading-relaxed prose-strong:text-slate-950 prose-blockquote:border-[#0052FF] prose-blockquote:bg-blue-50 prose-blockquote:rounded-[30px] prose-blockquote:py-4 prose-blockquote:px-8">
                        {!! $post->content !!}
                    </div>

                    <!-- Share Section -->
                    <div class="mt-20 pt-12 border-t border-slate-100 flex flex-wrap items-center justify-between gap-8">
                        <div class="flex items-center gap-6">
                            <h4 class="text-sm font-black uppercase tracking-[0.2em] text-slate-950">Share Insight</h4>
                            <div class="flex gap-3">
                                <a href="#" class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-[#0052FF] hover:text-white transition-all duration-300 shadow-sm"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-[#0052FF] hover:text-white transition-all duration-300 shadow-sm"><i class="fa-brands fa-x-twitter"></i></a>
                                <a href="#" class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-[#0052FF] hover:text-white transition-all duration-300 shadow-sm"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <div class="sticky top-32 space-y-12">
                        <!-- Recent Posts -->
                        <div class="bg-slate-50 rounded-[40px] p-10 border border-slate-100">
                            <h4 class="text-xl font-black text-slate-950 mb-10 pb-4 border-b-4 border-[#0052FF] inline-block tracking-tight">Recent Updates</h4>
                            <div class="space-y-10">
                                @foreach($recent_posts as $recent)
                                    <div class="group">
                                        <p class="text-[#0052FF] text-[10px] font-black uppercase tracking-widest mb-3">{{ $recent->created_at->format('M d, Y') }}</p>
                                        <h5 class="text-lg font-bold text-slate-950 group-hover:text-[#0052FF] transition-colors leading-tight tracking-tight">
                                            <a href="{{ url('/blog/'.$recent->slug) }}">{{ $recent->title }}</a>
                                        </h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CTA Sidebar -->
                        <div class="bg-[#0052FF] rounded-[40px] p-12 text-white relative overflow-hidden shadow-2xl shadow-blue-200">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500 rounded-full opacity-50 blur-2xl"></div>
                            <div class="relative z-10">
                                <h4 class="text-3xl font-black mb-6 tracking-tight leading-tight">Ready to start your project?</h4>
                                <p class="text-blue-100 text-base mb-10 leading-relaxed font-medium">Let's build something exceptional together. Our team is ready to help.</p>
                                <a href="{{ url('/contact') }}" class="bg-white text-[#0052FF] px-10 py-4 rounded-2xl text-sm font-black hover:bg-slate-50 transition-all inline-block uppercase tracking-widest shadow-xl">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
