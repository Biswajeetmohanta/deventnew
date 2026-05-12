@extends('layouts.app')

@section('title', 'Client Testimonials | Devent Technology')

@section('content')
    <!-- Hero Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-100/50 rounded-l-[100px] transform translate-x-1/3 -skew-x-12 opacity-30"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-8 tracking-tighter">
                What Our <span style="color: #0052FF;">Clients Say</span>
            </h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium">
                Don't just take our word for it. Here's how we've helped businesses around the world achieve their digital goals.
            </p>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-16">
                @forelse($testimonials as $testimonial)
                    <div class="premium-card group flex flex-col h-full">
                        <div class="flex mb-8" style="color: #FFB800;">
                            @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for($i = ($testimonial->rating ?? 5); $i < 5; $i++)
                                <i class="fa-regular fa-star text-slate-200"></i>
                            @endfor
                        </div>
                        <blockquote class="text-lg text-slate-600 leading-relaxed font-medium mb-10 flex-grow italic">
                            "{{ $testimonial->content }}"
                        </blockquote>
                        <div class="flex items-center space-x-5 border-t border-slate-50 pt-8 mt-auto">
                            @if($testimonial->image)
                                <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->client_name }}" class="w-16 h-16 rounded-2xl object-cover ring-4 ring-blue-50">
                            @else
                                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 text-xl font-black">
                                    {{ substr($testimonial->client_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="premium-card-title !mb-0">{{ $testimonial->client_name }}</h4>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.15em] leading-tight mt-2">{{ $testimonial->client_position ?? 'Business Owner' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Placeholder testimonials -->
                    @foreach([1, 2, 3] as $item)
                        <div class="p-10 rounded-[40px] border border-slate-100 bg-slate-50 opacity-50">
                            <div class="h-4 w-24 bg-slate-200 rounded mb-6"></div>
                            <div class="h-4 w-full bg-slate-200 rounded mb-2"></div>
                            <div class="h-4 w-full bg-slate-200 rounded mb-2"></div>
                            <div class="h-4 w-2/3 bg-slate-200 rounded mb-10"></div>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-200 rounded-full"></div>
                                <div class="space-y-2">
                                    <div class="h-3 w-20 bg-slate-200 rounded"></div>
                                    <div class="h-2 w-16 bg-slate-200 rounded"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonial CTA -->
    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[50px] p-12 md:p-24 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-10 tracking-tighter">Ready to be our next <br><span style="color: #0052FF;">Success Story?</span></h2>
                    <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto font-medium">Join hundreds of satisfied clients who have transformed their businesses with our expert tech solutions.</p>
                    <a href="{{ url('/contact') }}" class="premium-cta-btn px-10 py-5">
                        <span class="btn-text">Start Your Journey</span>
                        <i class="fa-solid fa-rocket ml-3 relative z-10"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
