@extends('layouts.app')

@section('title', 'Our Services | Devent Technology')

@section('content')
    <!-- Services Hero -->
    <section class="bg-slate-50 py-24 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-bold text-slate-950 mb-6 tracking-tight">Our <span class="text-blue-600">Services</span></h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">We provide a wide range of software development and digital transformation services tailored to your business needs.</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($services as $service)
                    <div class="premium-card group">
                        <div class="premium-card-icon">
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="premium-card-title">{{ $service->title }}</h3>
                        <p class="premium-card-text mb-8">{{ $service->summary }}</p>
                        <a href="{{ url('/services/' . $service->slug) }}" class="inline-flex items-center text-blue-600 font-bold group-hover:translate-x-2 transition-all text-sm">
                            Explore Service <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
