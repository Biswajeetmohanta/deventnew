@extends('layouts.app')

@section('title', 'About Us | Devent Technology')

@section('content')
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="rounded-[60px] overflow-hidden shadow-2xl aspect-[4/3] bg-slate-100">
                        @if(isset($settings['about_image']))
                            <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="About Devent" class="w-full h-full object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070" alt="About Devent" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="absolute -bottom-10 -left-10 bg-[#0052FF] p-10 rounded-[40px] text-white shadow-2xl hidden md:block border-[10px] border-white">
                        <div class="text-4xl font-black mb-2">{{ $settings['about_exp_years'] ?? '10+' }}</div>
                        <div class="text-[10px] uppercase tracking-[0.2em] font-black opacity-90 leading-tight">
                            {!! str_replace(' ', '<br>', $settings['about_exp_text'] ?? 'YEARS OF EXPERIENCE') !!}
                        </div>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-[#0052FF] font-black uppercase tracking-[0.3em] text-[10px] mb-6">{{ $settings['about_badge'] ?? 'WHO WE ARE' }}</h2>
                    <h1 class="text-5xl md:text-6xl font-black text-slate-950 mb-8 tracking-tighter leading-[1.1]">
                        Your partner in <span style="color: #0052FF;">Digital Transformation</span>.
                    </h1>
                    <p class="text-xl text-slate-500 mb-10 leading-relaxed font-medium">
                        {{ $settings['about_description'] ?? 'Devent Technology is a premier software development agency dedicated to delivering high-impact digital solutions. We combine technical expertise with creative vision to help businesses scale and thrive in the modern era.' }}
                    </p>
                    <div class="grid grid-cols-2 gap-8 mb-12">
                        <div class="border-l-4 border-slate-100 pl-6">
                            <h4 class="text-4xl font-black text-slate-950 mb-2">{{ $settings['about_stat1_count'] ?? '50+' }}</h4>
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-[0.2em]">{{ $settings['about_stat1_text'] ?? 'EXPERT DEVELOPERS' }}</p>
                        </div>
                        <div class="border-l-4 border-slate-100 pl-6">
                            <h4 class="text-4xl font-black text-slate-950 mb-2">{{ $settings['about_stat2_count'] ?? '200+' }}</h4>
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-[0.2em]">{{ $settings['about_stat2_text'] ?? 'HAPPY CLIENTS' }}</p>
                        </div>
                    </div>
                    <a href="{{ url('/contact') }}" class="inline-flex items-center text-[#0052FF] font-black text-sm uppercase tracking-widest group">
                        Let's Work Together 
                        <span class="ml-4 w-12 h-12 rounded-full bg-[#0052FF] text-white flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Process Section -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-[#0052FF] font-black uppercase tracking-[0.3em] text-[10px] mb-6">Our Process</h2>
                <h3 class="text-3xl md:text-5xl font-black text-slate-950 tracking-tighter">Works in 3 Easy Steps</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16 relative mt-16">
                <!-- Step 1 -->
                <div class="text-center group">
                    <div class="relative mb-8 inline-block">
                        <div class="w-32 h-32 rounded-full border-2 border-dashed border-slate-200 group-hover:border-[#0052FF] transition-colors flex items-center justify-center bg-white">
                            <div class="w-24 h-24 rounded-full bg-slate-50 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets/images/process/step1.png') }}" alt="Plan and Research" class="w-full h-full object-contain p-2">
                            </div>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-[#0052FF] text-white rounded-full flex items-center justify-center text-xs font-black">01</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-950 mb-4">Plan and Research</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        We start by understanding your needs and conducting thorough research to ensure we develop a tailored strategy.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center group">
                    <div class="relative mb-8 inline-block">
                        <div class="w-32 h-32 rounded-full border-2 border-dashed border-slate-200 group-hover:border-[#0052FF] transition-colors flex items-center justify-center bg-white">
                            <div class="w-24 h-24 rounded-full bg-slate-50 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets/images/process/step2.png') }}" alt="Design & Prototyping" class="w-full h-full object-contain p-2">
                            </div>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-[#0052FF] text-white rounded-full flex items-center justify-center text-xs font-black">02</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-950 mb-4">Design & Prototyping</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        We create detailed designs and prototypes to visualize the end product before moving forward.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center group">
                    <div class="relative mb-8 inline-block">
                        <div class="w-32 h-32 rounded-full border-2 border-dashed border-slate-200 group-hover:border-[#0052FF] transition-colors flex items-center justify-center bg-white">
                            <div class="w-24 h-24 rounded-full bg-slate-50 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets/images/process/step3.png') }}" alt="Final Solution" class="w-full h-full object-contain p-2">
                            </div>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-[#0052FF] text-white rounded-full flex items-center justify-center text-xs font-black">03</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-950 mb-4">Final Solution</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        We deliver the final solution, ensuring it's thoroughly tested and meets all your expectations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h3 class="text-3xl md:text-5xl font-bold text-slate-950">Our Core Values</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach([
                    ['Innovation', 'We constantly push boundaries to find the best solutions.'],
                    ['Quality', 'We never compromise on the excellence of our deliverables.'],
                    ['Integrity', 'We build trust through transparency and honest communication.']
                ] as $value)
                    <div class="premium-card group">
                        <div class="premium-card-icon group-hover:bg-blue-600 transition-all duration-500">
                            <svg class="w-7 h-7 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h4 class="premium-card-title">{{ $value[0] }}</h4>
                        <p class="premium-card-text">{{ $value[1] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
