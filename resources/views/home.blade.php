@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-slate-50">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-50 rounded-l-[100px] transform translate-x-1/4 -skew-x-12 opacity-50"></div>
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-30"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider mb-6">
                        {{ $settings['hero_tagline'] ?? 'Innovative Tech Solutions' }}
                    </span>
                    <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-8 tracking-tighter leading-[1.1]">
                        We Build <span style="color: #0052FF;">Digital Future</span> With Excellence.
                    </h1>
                    <p class="text-lg text-slate-600 mb-10 leading-relaxed max-w-xl">
                        {{ $settings['hero_subtitle'] ?? 'Empowering global businesses with customized software solutions, high-performance web apps, and innovative digital strategies.' }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ url('/contact') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 flex items-center">
                            Start Your Project
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="{{ url('/portfolio') }}" class="bg-white text-slate-900 border border-slate-200 px-8 py-4 rounded-xl font-bold hover:bg-slate-50 transition-all flex items-center">
                            View Portfolio
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl bg-slate-200 aspect-video">
                        @if(isset($settings['hero_image']))
                            <img src="{{ Storage::url($settings['hero_image']) }}" alt="Team working" class="w-full h-full object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1522071823991-b9671f903f60?q=80&w=2070" alt="Team working" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-blue-600 rounded-3xl -z-10 animate-pulse opacity-20"></div>
                    
                    <!-- Stats Floating Card -->
                    <div class="absolute top-10 -left-10 bg-white p-6 rounded-2xl shadow-xl z-20 hidden md:block border border-slate-100">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-slate-950">{{ $settings['hero_stats_count'] ?? '100+' }}</div>
                                <div class="text-xs text-slate-500 uppercase tracking-wider font-bold">{{ $settings['hero_stats_text'] ?? 'Projects Delivered' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Counters Section -->
    <section class="py-12 bg-white border-b border-slate-100 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center text-center">
                @for($i = 1; $i <= 4; $i++)
                    @if(isset($settings['counter_' . $i . '_value']) && $settings['counter_' . $i . '_value'] != '')
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4 text-blue-600">
                                <i class="{{ $settings['counter_' . $i . '_icon'] ?? 'fa-solid fa-chart-line' }} text-xl"></i>
                            </div>
                            <span class="text-4xl font-black text-slate-950 mb-2 counter-value" 
                                  data-target="{{ preg_replace('/[^0-9]/', '', $settings['counter_' . $i . '_value']) }}" 
                                  data-suffix="{{ preg_replace('/[0-9]/', '', $settings['counter_' . $i . '_value']) }}">
                                0
                            </span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                {{ $settings['counter_' . $i . '_label'] }}
                            </span>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-blue-600 font-bold uppercase tracking-widest text-sm mb-4">What We Offer</h2>
                <h3 class="text-3xl md:text-5xl font-bold text-slate-950">Expertise That Drives Results</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="group p-10 rounded-3xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 cursor-pointer">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                             <!-- Icon dynamic here -->
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold mb-4 text-slate-950">{{ $service->title }}</h4>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            {{ $service->summary }}
                        </p>
                        <a href="{{ url('/services/' . $service->slug) }}" class="inline-flex items-center text-blue-600 font-bold group-hover:translate-x-2 transition-transform">
                            Learn More <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h16"></path></svg>
                        </a>
                    </div>
                @empty
                    <!-- Placeholder services if empty -->
                    @foreach(['Web Development', 'Mobile Apps', 'Cloud Solutions'] as $item)
                        <div class="group p-10 rounded-3xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500">
                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="text-2xl font-bold mb-4 text-slate-950">{{ $item }}</h4>
                            <p class="text-slate-600 leading-relaxed">High-performance solutions tailored to your business needs and scalability.</p>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    @if($portfolios->isNotEmpty())
    <!-- Portfolio Section -->
    <section class="py-24 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-blue-600 font-bold uppercase tracking-widest text-sm mb-4">Our Work</h2>
                <h3 class="text-3xl md:text-5xl font-bold text-slate-950">Recent Case Studies</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($portfolios->take(3) as $portfolio)
                    <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 bg-white">
                        <div class="h-64 overflow-hidden">
                            @if($portfolio->image)
                                <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-image text-4xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-2 block">{{ $portfolio->client }}</span>
                            <h4 class="text-xl font-bold mb-2 text-slate-900">{{ $portfolio->title }}</h4>
                            <p class="text-slate-600 text-sm mb-4">{{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}</p>
                            <a href="{{ url('/portfolio/' . $portfolio->slug) }}" class="text-sm font-semibold flex items-center text-blue-600 hover:text-blue-700">
                                View Project <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h16"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Industries Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-blue-600 font-bold uppercase tracking-widest text-sm mb-4">Industries We Serve</h2>
                <h3 class="text-3xl md:text-5xl font-bold text-slate-950 mb-4">Built Around the Way Your Business Works</h3>
                <p class="text-slate-600 text-lg max-w-3xl mx-auto">
                    Inspired by enterprise IT service pages, these blocks connect Devent's services with real business categories.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                @foreach($industries ?? [] as $industry)
                    <div class="flex items-start p-6 bg-slate-50 rounded-2xl hover:bg-white hover:shadow-xl hover:shadow-blue-50 transition-all duration-300">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mr-6 flex-shrink-0 bg-slate-200">
                            @if($industry->image)
                                <img src="{{ Storage::url($industry->image) }}" alt="{{ $industry->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <i class="{{ $industry->icon ?? 'fa-solid fa-building' }} text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">{{ $industry->title }}</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                {{ \Illuminate\Support\Str::limit($industry->description ?? 'We provide tailored solutions for this industry.', 120) }}
                            </p>
                            <a href="{{ url('/industry/' . $industry->slug) }}" class="inline-flex items-center text-blue-600 font-bold text-sm mt-3 hover:text-blue-700">
                                Explore Solutions <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Technologies Section -->
    <section class="py-20 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16">
                <h3 class="text-xl font-bold text-slate-400 uppercase tracking-[0.2em]">Technologies We Use</h3>
            </div>
            <div class="flex flex-wrap justify-center gap-12 transition-all duration-700">
                <!-- Tech Icons -->
                @forelse($technologies as $tech)
                     <div class="flex flex-col items-center">
                        <img src="{{ Storage::url($tech->logo) }}" alt="{{ $tech->name }}" class="h-12 mb-2" onerror="this.style.display='none'">
                        <span class="text-xs font-bold text-slate-700">{{ $tech->name }}</span>
                     </div>
                @empty
                    <div class="text-4xl font-black text-slate-300">LARAVEL</div>
                    <div class="text-4xl font-black text-slate-300">REACT</div>
                    <div class="text-4xl font-black text-slate-300">NODE.JS</div>
                    <div class="text-4xl font-black text-slate-300">PYTHON</div>
                    <div class="text-4xl font-black text-slate-300">MYSQL</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="dark-section rounded-[40px] p-12 md:p-24 relative overflow-hidden">
                <div class="relative z-10 text-center max-w-3xl mx-auto">
                    <h2 class="text-4xl md:text-6xl font-bold mb-8">Ready to transform your business?</h2>
                    <p class="text-slate-400 text-lg mb-12">Join hands with Devent Technology and experience the power of innovation. Let's create something extraordinary together.</p>
                    <a href="{{ url('/contact') }}" class="premium-cta-btn px-10 py-5">
                        <span class="btn-text">Get a Free Consultation</span>
                        <i class="fa-solid fa-arrow-right ml-3 relative z-10"></i>
                    </a>
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-blue-600 rounded-full blur-[120px] opacity-20"></div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter-value');
        
        const countUp = (counter) => {
            const target = +counter.getAttribute('data-target');
            const suffix = counter.getAttribute('data-suffix') || '';
            let count = 0;
            const duration = 2000; // duration in ms
            const startTime = performance.now();
            
            const update = (currentTime) => {
                const elapsedTime = currentTime - startTime;
                const progress = Math.min(elapsedTime / duration, 1);
                
                // Ease out cubic
                const easeOut = 1 - Math.pow(1 - progress, 3);
                
                count = easeOut * target;
                counter.innerText = Math.ceil(count) + suffix;
                
                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    counter.innerText = target + suffix;
                }
            };
            requestAnimationFrame(update);
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    countUp(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    });
    </script>
@endsection