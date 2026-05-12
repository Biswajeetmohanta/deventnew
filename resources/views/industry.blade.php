@extends('layouts.app')

@section('title', 'Industries We Serve | Devent Technology')

<!-- Enable Tailwind CDN for this page to support dynamic color classes from database -->
<script src="https://cdn.tailwindcss.com"></script>

@section('content')
    <!-- Hero Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-100/50 rounded-l-[100px] transform translate-x-1/3 -skew-x-12 opacity-30"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-8 tracking-tighter leading-tight">
                Industries We <span style="color: #0052FF;">Empower</span>
            </h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium">
                At Devent Technology, we provide tailored solutions across various industries to meet unique challenges and opportunities.
            </p>
        </div>
    </section>

    <!-- Industries Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16">
                @forelse($industries as $industry)
                    <a href="{{ url('/industry/' . $industry->slug) }}" class="group p-10 rounded-[40px] bg-white border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 hover:-translate-y-2 block">
                        <div class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center mb-10 group-hover:bg-[#0052FF] transition-all duration-500 shadow-inner">
                            @if($industry->icon)
                                <i class="{{ $industry->icon }} text-3xl {{ !str_contains($industry->icon, 'text-') ? 'text-[#0052FF]' : '' }} group-hover:text-white transition-colors duration-500"></i>
                            @else
                                <i class="fa-solid fa-layer-group text-3xl text-[#0052FF] group-hover:text-white transition-colors duration-500"></i>
                            @endif
                        </div>
                        <h3 class="text-2xl font-black text-slate-950 mb-6 tracking-tight group-hover:text-[#0052FF] transition-colors">
                            {{ $industry->title }}
                        </h3>
                        <p class="text-slate-500 leading-relaxed font-medium text-base mb-8">
                            {{ $industry->description }}
                        </p>
                        <div class="flex items-center text-[#0052FF] font-bold text-sm tracking-wider uppercase opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            Learn more <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </div>
                    </a>
                @empty
                    <!-- Placeholder if no industries added yet -->
                    @php
                        $placeholders = [
                            ['title' => 'Banking & Finance', 'icon' => 'fa-solid fa-building-columns', 'desc' => 'Providing solutions for banking, investment, and financial services.'],
                            ['title' => 'Business', 'icon' => 'fa-solid fa-briefcase', 'desc' => 'Consulting and technology solutions for diverse business needs.'],
                            ['title' => 'Ecommerce', 'icon' => 'fa-solid fa-cart-shopping', 'desc' => 'Building powerful online stores and platforms.'],
                            ['title' => 'Education', 'icon' => 'fa-solid fa-graduation-cap', 'desc' => 'Digital tools for learning, school management, and online courses.'],
                            ['title' => 'Healthcare', 'icon' => 'fa-solid fa-heart-pulse', 'desc' => 'Innovative IT solutions for hospitals, clinics, and medical startups.'],
                            ['title' => 'Real Estate', 'icon' => 'fa-solid fa-house-chimney', 'desc' => 'Transforming property management and listing experiences.'],
                        ];
                    @endphp
                    @foreach($placeholders as $item)
                        <div class="group p-10 rounded-[40px] bg-slate-50/50 border border-slate-100">
                             <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-slate-400 mb-8">
                                <i class="{{ $item['icon'] }} text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ $item['title'] }}</h3>
                            <p class="text-slate-500">{{ $item['desc'] }}</p>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Global CTA -->
    <section class="pb-64 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-950 rounded-[50px] p-12 md:p-24 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-10 tracking-tighter">Have an industry-specific <br><span style="color: #0052FF;">Challenge?</span></h2>
                    <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto font-medium">We specialize in solving complex problems with cutting-edge technology. Let's discuss your next project.</p>
                    <a href="{{ url('/contact') }}" class="premium-cta-btn px-10 py-5">
                        <span class="btn-text">Get a Free Consultation</span>
                        <i class="fa-solid fa-calendar-check ml-3 relative z-10"></i>
                    </a>
                </div>
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-20"></div>
            </div>
        </div>
    </section>
@endsection
