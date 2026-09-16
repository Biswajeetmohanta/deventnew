@extends('layouts.app')

@section('title', 'Page Not Found (404) | Devent Technology')
@section('meta_description', 'The page you were looking for could not be found. Explore Devent Technology\'s software development services, portfolio, and technology solutions.')

@section('content')
    <section class="min-h-[85vh] flex items-center justify-center py-24 bg-gradient-to-b from-slate-950 via-slate-900 to-blue-950 text-white relative overflow-hidden">
        <!-- Ambient lighting blobs -->
        <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-blue-600/15 rounded-full blur-[140px] pointer-events-none animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-purple-600/15 rounded-full blur-[140px] pointer-events-none"></div>
        
        <!-- Subtle dot grid pattern -->
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.08) 1px, transparent 0); background-size: 32px 32px;"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <!-- 404 Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-widest mb-8">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-ping"></span>
                Error 404 • Page Not Found
            </div>

            <!-- Big 404 Heading -->
            <h1 class="text-7xl sm:text-9xl font-black tracking-tighter mb-6 bg-gradient-to-r from-white via-slate-200 to-blue-400 bg-clip-text text-transparent">
                404
            </h1>

            <h2 class="text-2xl sm:text-4xl font-bold text-white mb-6 tracking-tight">
                Oops! Looks like this page went off the grid.
            </h2>

            <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto mb-12 leading-relaxed">
                The URL you followed may have been updated, moved, or is temporarily unavailable. Let's get you back on track to exploring our solutions.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 mb-16">
                <a href="{{ url('/') }}" class="premium-cta-btn px-8 py-4 text-base font-bold shadow-xl shadow-blue-500/25">
                    <i class="fa-solid fa-house mr-2"></i>
                    Back to Homepage
                </a>
                <a href="{{ url('/services') }}" class="px-8 py-4 rounded-2xl font-bold text-white bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 transition-all flex items-center">
                    <i class="fa-solid fa-cubes mr-2"></i>
                    Browse Services
                </a>
                <a href="{{ url('/portfolio') }}" class="px-8 py-4 rounded-2xl font-bold text-white bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 transition-all flex items-center">
                    <i class="fa-solid fa-briefcase mr-2"></i>
                    View Portfolio
                </a>
                <a href="{{ url('/contact') }}" class="px-8 py-4 rounded-2xl font-bold text-blue-400 hover:text-white bg-blue-500/10 hover:bg-blue-600 border border-blue-500/30 transition-all flex items-center">
                    <i class="fa-solid fa-headset mr-2"></i>
                    Contact Support
                </a>
            </div>

            <!-- Popular Quick Links -->
            <div class="pt-10 border-t border-slate-800/80">
                <p class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-6">Popular Solutions</p>
                <div class="flex flex-wrap justify-center gap-3 text-sm">
                    <a href="{{ url('/services/custom-software-development') }}" class="px-4 py-2 rounded-xl bg-slate-900/60 border border-slate-800 text-slate-300 hover:text-blue-400 hover:border-blue-500/50 transition-all">
                        Custom Software
                    </a>
                    <a href="{{ url('/services/mobile-app-development') }}" class="px-4 py-2 rounded-xl bg-slate-900/60 border border-slate-800 text-slate-300 hover:text-blue-400 hover:border-blue-500/50 transition-all">
                        Mobile App Development
                    </a>
                    <a href="{{ url('/services/software-development-consulting') }}" class="px-4 py-2 rounded-xl bg-slate-900/60 border border-slate-800 text-slate-300 hover:text-blue-400 hover:border-blue-500/50 transition-all">
                        IT Consulting
                    </a>
                    <a href="{{ url('/services/retail-e-commerce-software-development') }}" class="px-4 py-2 rounded-xl bg-slate-900/60 border border-slate-800 text-slate-300 hover:text-blue-400 hover:border-blue-500/50 transition-all">
                        E-Commerce Solutions
                    </a>
                    <a href="{{ url('/technology') }}" class="px-4 py-2 rounded-xl bg-slate-900/60 border border-slate-800 text-slate-300 hover:text-blue-400 hover:border-blue-500/50 transition-all">
                        Technologies
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
