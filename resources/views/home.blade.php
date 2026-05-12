@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[95vh] flex items-center overflow-hidden hero-section" id="heroSection">
        <!-- Animated Gradient Background -->
        <div class="absolute inset-0 z-0 hero-bg-gradient"></div>
        
        <!-- Floating Particles -->
        <div class="absolute inset-0 z-[1] overflow-hidden pointer-events-none">
            <div class="hero-particle hero-particle-1"></div>
            <div class="hero-particle hero-particle-2"></div>
            <div class="hero-particle hero-particle-3"></div>
            <div class="hero-particle hero-particle-4"></div>
            <div class="hero-particle hero-particle-5"></div>
        </div>

        <!-- Subtle grid pattern overlay -->
        <div class="absolute inset-0 z-[2]" style="background-image: radial-gradient(circle at 1px 1px, rgba(0,82,255,0.04) 1px, transparent 0); background-size: 32px 32px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="hero-content-left">
                    <!-- Tagline Badge with pulse -->
                    <div class="hero-badge-wrapper mb-8">
                        <span class="hero-tagline-badge">
                            <span class="hero-badge-dot"></span>
                            {{ $settings['hero_tagline'] ?? 'Innovative Tech Solutions' }}
                        </span>
                    </div>

                    <h1 class="text-5xl md:text-[4.5rem] font-black text-slate-950 mb-8 tracking-tighter leading-[1.05]">
                        We Build
                        <span class="hero-gradient-text"> Digital Future</span>
                        <br>With Excellence.
                    </h1>

                    <p class="text-lg text-slate-500 mb-10 leading-relaxed max-w-xl font-medium">
                        {{ $settings['hero_subtitle'] ?? 'Empowering global businesses with customized software solutions, high-performance web apps, and innovative digital strategies.' }}
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 mb-10">
                        <a href="{{ url('/contact') }}" class="hero-cta-primary group">
                            <span>Start Your Project</span>
                            <svg class="ml-2 w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_phone'] ?? '919274688925') }}?text={{ urlencode('Hi Devent Technology! I\'m interested in your services. Can we discuss my project?') }}" target="_blank" class="hero-cta-whatsapp group">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>Chat on WhatsApp</span>
                        </a>
                        <button onclick="openCalendlyModal()" class="hero-cta-secondary group">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Schedule Meeting</span>
                        </button>
                    </div>

                    <!-- Trust Badges -->
                    <div class="hero-trust-badges">
                        <div class="flex items-center gap-3 text-sm text-slate-400 font-semibold">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 border-2 border-white flex items-center justify-center text-blue-600 text-xs font-bold">5★</div>
                                <div class="w-8 h-8 rounded-full bg-green-100 border-2 border-white flex items-center justify-center text-green-600 text-xs font-bold"><i class="fa-solid fa-check"></i></div>
                                <div class="w-8 h-8 rounded-full bg-purple-100 border-2 border-white flex items-center justify-center text-purple-600 text-xs font-bold"><i class="fa-solid fa-shield-halved"></i></div>
                            </div>
                            <span>Trusted by <strong class="text-slate-700">{{ $settings['hero_stats_count'] ?? '100+' }}</strong> businesses worldwide</span>
                        </div>
                    </div>
                </div>

                <div class="relative hero-content-right">
                    <!-- Main Image with premium frame -->
                    <div class="hero-image-wrapper">
                        <div class="hero-image-glow"></div>
                        <div class="relative z-10 rounded-[2rem] overflow-hidden shadow-2xl bg-slate-200 aspect-video border-2 border-white/50">
                            @if(isset($settings['hero_image']))
                                <img src="{{ Storage::url($settings['hero_image']) }}" alt="Devent Technology - Building Digital Future" class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1522071823991-b9671f903f60?q=80&w=2070" alt="Devent Technology Team" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>

                    <!-- Decorative elements -->
                    <div class="absolute -bottom-8 -right-8 w-40 h-40 bg-gradient-to-br from-blue-600 to-purple-600 rounded-[2rem] -z-10 opacity-15 animate-pulse"></div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl -z-10 opacity-10 hero-float-reverse"></div>
                    
                    <!-- Stats Floating Card -->
                    <div class="hero-stats-card hidden md:flex">
                        <div class="flex items-center space-x-4">
                            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);">
                                <svg style="width: 24px; height: 24px; color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-slate-950">{{ $settings['hero_stats_count'] ?? '100+' }}</div>
                                <div class="text-[10px] text-slate-400 uppercase tracking-[0.15em] font-bold">{{ $settings['hero_stats_text'] ?? 'Projects Delivered' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Rating Badge -->
                    <div class="hero-rating-badge hidden md:flex">
                        <div class="flex items-center gap-2">
                            <div class="flex text-amber-400 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-700">5.0</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-semibold">Client Rating</span>
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
                    <div class="premium-card group">
                        <div class="premium-card-icon group-hover:bg-blue-600 transition-all duration-500">
                             <svg class="w-7 h-7 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        </div>
                        <h4 class="premium-card-title">{{ $service->title }}</h4>
                        <p class="premium-card-text mb-6">
                            {{ $service->summary }}
                        </p>
                        <a href="{{ url('/services/' . $service->slug) }}" class="inline-flex items-center text-blue-600 font-bold group-hover:translate-x-2 transition-transform text-sm">
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
                    <div class="premium-card group !p-0 overflow-hidden">
                        <div class="h-64 overflow-hidden">
                            @if($portfolio->image)
                                <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-image text-4xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-8">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-blue-600 mb-3 block">{{ $portfolio->client }}</span>
                            <h4 class="premium-card-title">{{ $portfolio->title }}</h4>
                            <p class="premium-card-text mb-6">{{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}</p>
                            <a href="{{ url('/portfolio/' . $portfolio->slug) }}" class="text-sm font-bold flex items-center text-blue-600 hover:text-blue-700">
                                View Project <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h16"></path></svg>
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
                    <div class="premium-card group flex items-start">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mr-6 flex-shrink-0 bg-slate-100 border border-slate-200/50">
                            @if($industry->image)
                                <img src="{{ Storage::url($industry->image) }}" alt="{{ $industry->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <i class="{{ $industry->icon ?? 'fa-solid fa-building' }} text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="premium-card-title !mb-2">{{ $industry->title }}</h4>
                            <p class="premium-card-text">
                                {{ \Illuminate\Support\Str::limit($industry->description ?? 'We provide tailored solutions for this industry.', 120) }}
                            </p>
                            <a href="{{ url('/industry/' . $industry->slug) }}" class="inline-flex items-center text-blue-600 font-bold text-xs mt-4 hover:text-blue-700">
                                Explore Solutions <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
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
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ url('/contact') }}" class="premium-cta-btn px-10 py-5">
                            <span class="btn-text">Get a Free Consultation</span>
                            <i class="fa-solid fa-arrow-right ml-3 relative z-10"></i>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_phone'] ?? '919274688925') }}?text={{ urlencode('Hi Devent Technology! I\'m interested in your services. Can we discuss my project?') }}" target="_blank" class="cta-whatsapp-btn px-10 py-5 rounded-2xl font-bold flex items-center">
                            <i class="fa-brands fa-whatsapp text-xl mr-3"></i>
                            Chat on WhatsApp
                        </a>
                        <button onclick="openCalendlyModal()" class="btn-gradient px-10 py-5 rounded-2xl font-bold text-white flex items-center">
                            Schedule Meeting
                            <i class="fa-solid fa-calendar-check ml-3"></i>
                        </button>
                    </div>
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