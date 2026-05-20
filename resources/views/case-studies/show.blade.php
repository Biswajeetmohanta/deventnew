@extends('layouts.app')

@section('title', $caseStudy->title . ' | Case Study | Devent Technology')

@section('content')
    @php
        $cd = $caseStudy->content_data ?? [];
    @endphp

    <!-- 1. Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-slate-950 py-24 text-white">
        <!-- Interactive animated background grid/glows -->
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950"></div>
        <div class="absolute inset-0 z-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 32px 32px;"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-600 rounded-full blur-[150px] opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                <!-- Left text content -->
                <div class="lg:col-span-7">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 mb-6 uppercase tracking-wider">
                        <i class="fa-solid fa-laptop-code"></i> {{ $cd['banner']['badge'] ?? 'CASE STUDY' }}
                    </span>
                    
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-black mb-6 tracking-tight leading-[1.1] text-white">
                        {{ $cd['banner']['title'] ?? $caseStudy->title }}
                    </h1>
                    
                    <p class="text-slate-300 text-lg mb-8 leading-relaxed font-medium">
                        {{ $cd['banner']['subtitle'] ?? $caseStudy->description }}
                    </p>

                    <!-- Tech Stack Pills -->
                    @if($caseStudy->technologies->isNotEmpty())
                        <div class="mb-8">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-3">Technologies Featured:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($caseStudy->technologies as $tech)
                                    <span class="bg-white/5 hover:bg-white/10 text-slate-200 px-3 py-1 rounded-xl text-xs font-bold border border-white/10 transition-all flex items-center gap-1.5">
                                        @if($tech->logo)
                                            <img src="{{ Storage::url($tech->logo) }}" alt="{{ $tech->name }}" class="h-4 w-4 object-contain">
                                        @endif
                                        {{ $tech->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Highlights bullets list -->
                    @if(isset($cd['highlights']) && count($cd['highlights']) > 0)
                        <div class="space-y-3 mb-8">
                            @foreach($cd['highlights'] as $highlight)
                                <div class="flex items-center gap-3">
                                    <div class="w-5 h-5 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xs flex-shrink-0">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-200">{{ $highlight }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Action buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="#overview" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-2xl transition-all shadow-lg shadow-blue-600/20 flex items-center group">
                            <span>Explore Case Study</span>
                            <svg class="ml-2 w-5 h-5 transition-transform group-hover:translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-6l-7 7-7-7"></path></svg>
                        </a>
                        @if($caseStudy->link)
                            <a href="{{ $caseStudy->link }}" target="_blank" class="bg-white/10 hover:bg-white/15 text-white font-bold py-4 px-8 rounded-2xl border border-white/10 transition-all flex items-center">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-2"></i> Visit Live Platform
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right visual media (explainer video or mockup) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-[2.5rem] overflow-hidden border border-white/10 bg-slate-900/60 backdrop-blur-md p-3 shadow-2xl shadow-blue-900/10">
                        @if(isset($cd['banner']['video_url']) && !empty($cd['banner']['video_url']))
                            @php
                                $videoUrl = $cd['banner']['video_url'];
                                $embedUrl = '';
                                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match)) {
                                    $embedUrl = "https://www.youtube.com/embed/" . $match[1];
                                } elseif (preg_match('%vimeo\.com/([0-9]+)%i', $videoUrl, $match)) {
                                    $embedUrl = "https://player.vimeo.com/video/" . $match[1];
                                }
                            @endphp

                            @if($embedUrl)
                                <div class="aspect-video w-full rounded-[2rem] overflow-hidden">
                                    <iframe src="{{ $embedUrl }}" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            @else
                                <div class="aspect-video w-full rounded-[2rem] overflow-hidden">
                                    <video src="{{ $videoUrl }}" controls class="w-full h-full object-cover"></video>
                                </div>
                            @endif
                        @else
                            <!-- Fallback Mockup Image -->
                            <div class="aspect-video w-full rounded-[2rem] overflow-hidden relative group">
                                @if($caseStudy->image)
                                    <img src="{{ Storage::url($caseStudy->image) }}" alt="{{ $caseStudy->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-slate-800 flex items-center justify-center text-slate-600">
                                        <i class="fa-solid fa-laptop-code text-6xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-slate-950/20 group-hover:bg-slate-950/10 transition-colors"></div>
                            </div>
                        @endif
                    </div>
                    <!-- Decorative design floaters -->
                    <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-blue-500 rounded-3xl -z-10 opacity-10 animate-bounce"></div>
                    <div class="absolute -top-6 -right-6 w-14 h-14 bg-purple-500 rounded-full -z-10 opacity-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Overview Panel -->
    <section id="overview" class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <!-- Main descriptive text -->
                <div class="lg:col-span-8">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-3">{{ $cd['overview']['title'] ?? 'Project Overview' }}</span>
                    <h2 class="text-3xl font-extrabold text-slate-950 mb-6 tracking-tight">Understanding the Case</h2>
                    <div class="text-slate-600 text-base leading-relaxed space-y-4 font-medium">
                        {!! nl2br(e($cd['overview']['description'] ?? $caseStudy->description)) !!}
                    </div>
                </div>

                <!-- Client / Meta sidebar summary block -->
                <div class="lg:col-span-4 bg-slate-50 border border-slate-100 rounded-[2rem] p-8 shadow-sm h-fit">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6 pb-4 border-b border-slate-200/60">Project Parameters</h3>
                    
                    <div class="space-y-6">
                        @if($caseStudy->client)
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Partner Client</span>
                                <span class="text-slate-800 font-bold text-sm">{{ $caseStudy->client }}</span>
                            </div>
                        @endif

                        @if($caseStudy->industry)
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Industry Sector</span>
                                <span class="bg-blue-50 text-blue-600 border border-blue-100 px-3 py-0.5 rounded-full text-xs font-bold inline-block">{{ $caseStudy->industry->title }}</span>
                            </div>
                        @endif

                        @if($caseStudy->link)
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Project Link</span>
                                <a href="{{ $caseStudy->link }}" target="_blank" class="text-blue-600 hover:text-blue-700 font-bold text-sm underline flex items-center gap-1">
                                    {{ parse_url($caseStudy->link, PHP_URL_HOST) }} <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                            </div>
                        @endif

                        @if($caseStudy->technologies->isNotEmpty())
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-2">Integrated Tech Stack</span>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($caseStudy->technologies as $tech)
                                        <span class="bg-white border border-slate-200/60 text-slate-700 px-2 py-0.5 rounded text-[10px] font-bold">
                                            {{ $tech->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 & 4. Challenge vs. Solution Section -->
    <section class="py-24 bg-slate-50 border-y border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
            
            <!-- 3. The Challenge block -->
            @if(isset($cd['challenge']['description']) && !empty($cd['challenge']['description']))
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-rose-500/10 text-rose-600 border border-rose-500/20 mb-6 uppercase tracking-wider">
                            <i class="fa-solid fa-triangle-exclamation"></i> Business Challenge
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 mb-6 tracking-tight">
                            {{ $cd['challenge']['title'] ?? 'The Challenge' }}
                        </h2>
                        <div class="text-slate-600 text-base leading-relaxed space-y-4 font-medium">
                            {!! nl2br(e($cd['challenge']['description'])) !!}
                        </div>
                    </div>
                    
                    <div class="relative">
                        @if(isset($cd['challenge_image']))
                            <div class="rounded-[2.5rem] overflow-hidden shadow-xl border border-slate-200/60 aspect-video">
                                <img src="{{ asset('storage/' . $cd['challenge_image']) }}" alt="Challenge illustration" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-rose-50 to-rose-100 border border-rose-200/50 rounded-[2.5rem] flex items-center justify-center text-rose-500">
                                <i class="fa-solid fa-triangle-exclamation text-7xl opacity-40"></i>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- 4. The Solution block -->
            @if(isset($cd['solution']['description']) && !empty($cd['solution']['description']))
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="lg:order-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 mb-6 uppercase tracking-wider">
                            <i class="fa-solid fa-lightbulb"></i> Devent Solution
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 mb-6 tracking-tight">
                            {{ $cd['solution']['title'] ?? 'The Solution' }}
                        </h2>
                        <div class="text-slate-600 text-base leading-relaxed space-y-4 font-medium">
                            {!! nl2br(e($cd['solution']['description'])) !!}
                        </div>
                    </div>
                    
                    <div class="lg:order-1 relative">
                        @if(isset($cd['solution_image']))
                            <div class="rounded-[2.5rem] overflow-hidden shadow-xl border border-slate-200/60 aspect-video">
                                <img src="{{ asset('storage/' . $cd['solution_image']) }}" alt="Solution illustration" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-emerald-50 to-emerald-100 border border-emerald-200/50 rounded-[2.5rem] flex items-center justify-center text-emerald-500">
                                <i class="fa-solid fa-laptop-code text-7xl opacity-40"></i>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- 5. Features Grid block -->
    @if(isset($cd['features']) && count($cd['features']) > 0)
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-3">Engineered Modules</span>
                    <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight">
                        {{ $cd['features_title'] ?? 'Key Features & Capabilities' }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($cd['features'] as $feature)
                        <div class="premium-card group hover:shadow-2xl hover:shadow-blue-500/5 transition-all duration-300">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-gears text-lg"></i>
                            </div>
                            <h3 class="premium-card-title mb-3">{{ $feature['title'] }}</h3>
                            <p class="premium-card-text font-medium text-slate-500">{{ $feature['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 6. Strategic Approach block -->
    @if(isset($cd['approach']['description']) && !empty($cd['approach']['description']))
        <section class="py-24 bg-[#f8fafc] border-t border-slate-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-3">Strategic Methodology</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 mb-6 tracking-tight">
                            {{ $cd['approach']['title'] ?? 'Our Methodology & Approach' }}
                        </h2>
                        <div class="text-slate-600 text-base leading-relaxed space-y-4 font-medium mb-6">
                            {!! nl2br(e($cd['approach']['description'])) !!}
                        </div>
                        @if(isset($cd['approach']['description2']) && !empty($cd['approach']['description2']))
                            <div class="border-l-4 border-blue-600 bg-white p-5 rounded-r-2xl shadow-sm text-sm font-semibold text-slate-700">
                                {{ $cd['approach']['description2'] }}
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-center">
                        <div class="w-full h-80 bg-gradient-to-br from-indigo-950 to-slate-900 rounded-[2.5rem] p-8 flex flex-col justify-center text-white border border-white/5 relative overflow-hidden shadow-xl">
                            <div class="absolute -bottom-16 -right-16 w-48 h-48 bg-blue-600/10 rounded-full blur-[80px]"></div>
                            <i class="fa-solid fa-compass text-6xl text-blue-500/40 mb-6"></i>
                            <h4 class="text-xl font-bold mb-2">Agile & Sprint Focused</h4>
                            <p class="text-slate-400 text-sm leading-relaxed font-semibold">
                                We divide complexity into manageable, compliant sprints ensuring clear alignment and steady delivery.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 7. Timeline Timeline Steps block -->
    @if(isset($cd['process']) && count($cd['process']) > 0)
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                    <div class="lg:col-span-5">
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-3">Chronological Sprints</span>
                        <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 mb-4 tracking-tight">
                            {{ $cd['process_title'] ?? 'Delivery Process' }}
                        </h2>
                        <p class="text-slate-500 font-medium text-base mb-8">
                            {{ $cd['process_subtitle'] ?? 'How we structured the execution cycle of this project.' }}
                        </p>

                        @if(isset($cd['process_image']))
                            <div class="rounded-[2rem] overflow-hidden shadow-lg border border-slate-200/60 aspect-video">
                                <img src="{{ asset('storage/' . $cd['process_image']) }}" alt="Process diagram" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-full h-48 bg-slate-50 rounded-[2rem] border border-slate-200/50 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-route text-6xl opacity-35"></i>
                            </div>
                        @endif
                    </div>

                    <div class="lg:col-span-7 space-y-6">
                        @foreach($cd['process'] as $step)
                            <div class="flex items-start gap-4 p-6 bg-slate-50 hover:bg-slate-100/50 border border-slate-200/40 rounded-2xl transition-all">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center flex-shrink-0 text-sm font-black">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-lg mb-1">{{ $step['title'] }}</h4>
                                    <p class="text-slate-500 text-sm font-medium">{{ $step['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 8. Achievements / Statistics block -->
    @if(isset($cd['achievements']) && count($cd['achievements']) > 0)
        <section class="py-20 bg-slate-950 text-white relative overflow-hidden">
            <div class="absolute inset-0 z-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-blue-950 opacity-95"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-xs font-bold text-blue-400 uppercase tracking-widest block mb-3">Key Metrics</span>
                    <h2 class="text-3xl font-extrabold tracking-tight">Project Results & Outcomes</h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($cd['achievements'] as $stat)
                        <div class="bg-white/5 border border-white/10 p-8 rounded-3xl text-center backdrop-blur-md">
                            <span class="text-4xl sm:text-5xl font-black block mb-2 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">{{ $stat['title'] }}</span>
                            <span class="text-slate-300 text-sm font-semibold">{{ $stat['description'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 9. Case Testimonials block -->
    @if(isset($cd['testimonials']) && count($cd['testimonials']) > 0)
        <section class="py-24 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-3">Partner Feedback</span>
                    <h2 class="text-3xl font-extrabold text-slate-950 tracking-tight">What the Client Says</h2>
                </div>

                <div class="space-y-8">
                    @foreach($cd['testimonials'] as $testimonial)
                        <div class="bg-slate-50 border border-slate-100 rounded-3xl p-10 relative">
                            <i class="fa-solid fa-quote-left text-slate-200 text-7xl absolute top-6 left-6 z-0"></i>
                            <div class="relative z-10">
                                <p class="text-slate-600 text-lg leading-relaxed mb-6 font-medium italic">
                                    "{{ $testimonial['description'] }}"
                                </p>
                                <div>
                                    <h4 class="font-bold text-slate-900">{{ $testimonial['title'] }}</h4>
                                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">{{ $testimonial['role'] ?? 'Partner' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 10. FAQs block -->
    @if(isset($cd['faqs']) && count($cd['faqs']) > 0)
        <section class="py-24 bg-slate-50 border-t border-slate-200/50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-3">Accordion FAQ</span>
                    <h2 class="text-3xl font-extrabold text-slate-950 tracking-tight">Frequently Asked Questions</h2>
                </div>

                <div class="space-y-4" id="faq-accordion">
                    @foreach($cd['faqs'] as $index => $faq)
                        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden transition-all duration-300">
                            <button class="w-full text-left px-6 py-4 font-bold text-slate-800 flex justify-between items-center focus:outline-none" 
                                    onclick="toggleFaq('faq-item-{{ $index }}')">
                                <span>{{ $faq['title'] }}</span>
                                <i class="fa-solid fa-plus text-slate-400 text-xs transition-transform duration-300" id="icon-faq-item-{{ $index }}"></i>
                            </button>
                            <div class="hidden px-6 pb-6 text-slate-500 text-sm leading-relaxed" id="faq-item-{{ $index }}">
                                {!! nl2br(e($faq['description'])) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <script>
            function toggleFaq(id) {
                const element = document.getElementById(id);
                const icon = document.getElementById('icon-' + id);
                if (element.classList.contains('hidden')) {
                    element.classList.remove('hidden');
                    icon.classList.add('rotate-45');
                } else {
                    element.classList.add('hidden');
                    icon.classList.remove('rotate-45');
                }
            }
        </script>
    @endif

    <!-- 11. CTA Banners block -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-indigo-950 to-slate-900 rounded-[2.5rem] p-12 md:p-20 text-center relative overflow-hidden shadow-2xl text-white">
                <div class="absolute -top-32 -left-32 w-80 h-80 bg-blue-600/10 rounded-full blur-[100px]"></div>
                <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-purple-600/10 rounded-full blur-[100px]"></div>
                
                <div class="relative z-10 max-w-3xl mx-auto">
                    <h2 class="text-3xl sm:text-5xl font-extrabold mb-6 tracking-tight">
                        {{ $cd['cta']['title'] ?? 'Need a similar application?' }}
                    </h2>
                    <p class="text-slate-300 text-base sm:text-lg mb-10 leading-relaxed font-semibold">
                        {{ $cd['cta']['subtitle'] ?? 'Consult with Devent Technology\'s product managers to design, audit, and build a high-performance compliant platform.' }}
                    </p>
                    <a href="{{ url('/contact') }}" class="inline-flex items-center gap-1.5 bg-white text-slate-900 hover:scale-105 active:scale-95 font-bold px-8 py-4 rounded-xl transition-all shadow-xl">
                        {{ $cd['cta']['button'] ?? 'Connect With Us Today' }} <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 12. Other Case Studies Slider/Grid (Bottom suggestion) -->
    @if($otherCaseStudies->count() > 0)
        <section class="py-24 bg-slate-50 border-t border-slate-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-16">
                    <div>
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-3">Portfolio Highlights</span>
                        <h2 class="text-3xl font-extrabold text-slate-950 tracking-tight">Explore Other Case Studies</h2>
                    </div>
                    <a href="{{ route('case-studies.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1.5 transition-all group">
                        Browse All Projects <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($otherCaseStudies as $other)
                        <div class="premium-card group overflow-hidden bg-white hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full" style="padding: 0 !important;">
                            <div>
                                <div class="h-48 overflow-hidden relative">
                                    @if($other->image)
                                        <img src="{{ Storage::url($other->image) }}" alt="{{ $other->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                            <i class="fa-solid fa-laptop-code text-3xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <span class="text-[9px] font-bold uppercase tracking-wider text-blue-600 mb-2 block">{{ $other->client }}</span>
                                    <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $other->title }}</h3>
                                    <p class="text-slate-500 text-xs leading-relaxed">{{ \Illuminate\Support\Str::limit($other->description, 100) }}</p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 mt-auto border-t border-slate-100/60">
                                <a href="{{ url('/case-studies/' . $other->slug) }}" class="text-xs font-bold flex items-center text-blue-600 hover:text-blue-700">
                                    Read Case Study <svg class="ml-1.5 w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
