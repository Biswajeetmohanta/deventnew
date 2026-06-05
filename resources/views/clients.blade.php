@extends('layouts.app')

@section('title', 'Our Clients | Devent Technology')

@section('content')
    <!-- Hero Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-100/50 rounded-l-[100px] transform translate-x-1/3 -skew-x-12 opacity-30"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-8 tracking-tighter">
                Trusted by <span style="color: #0052FF;">Industry Leaders</span>
            </h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium">
                We partner with forward-thinking companies to build, scale, and maintain high-performance digital solutions.
            </p>
        </div>
    </section>

    <!-- Clients Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 lg:gap-12">
                @forelse($clients as $client)
                    <div class="premium-card group flex flex-col items-center justify-between p-8 rounded-[30px] border border-slate-100 bg-white transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="w-full flex items-center justify-center h-28 mb-6 bg-slate-50 rounded-2xl p-4 transition-colors group-hover:bg-slate-100/50">
                            @if($client->logo)
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="max-h-full max-w-full object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300">
                            @else
                                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 text-2xl font-bold">
                                    {{ substr($client->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="text-center w-full">
                            <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition-colors">{{ $client->name }}</h3>
                            @if($client->description)
                                <p class="text-sm text-slate-500 line-clamp-3 mb-4">{{ $client->description }}</p>
                            @endif
                            @if($client->website_url)
                                <a href="{{ $client->website_url }}" target="_blank" class="inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors mt-auto gap-1">
                                    Visit Website <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 text-slate-400">
                        <i class="fa-solid fa-building text-5xl mb-4 opacity-30"></i>
                        <p class="text-lg font-medium">No clients registered at the moment. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Client Success CTA -->
    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[50px] p-12 md:p-24 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-10 tracking-tighter">Partner with Us Today</h2>
                    <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto font-medium">Let's work together to build your next breakthrough digital product.</p>
                    <a href="{{ url('/contact') }}" class="premium-cta-btn px-10 py-5">
                        <span class="btn-text">Get in Touch</span>
                        <i class="fa-solid fa-arrow-right ml-3 relative z-10"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
