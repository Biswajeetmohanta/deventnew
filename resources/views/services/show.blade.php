@extends('layouts.app')

@section('title', $service->title . ' | Devent Technology')

@section('content')
    @php
        $cd = $service->content_data ?? [];
    @endphp

    <!-- 1. Hero Banner -->
    <section class="bg-slate-950 py-20 lg:py-28 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">{{ $cd['banner']['title'] ?? $service->title }}</h1>
                    @if(isset($cd['banner']['subtitle']))
                        <p class="text-lg text-slate-300 mb-8 leading-relaxed">{{ $cd['banner']['subtitle'] }}</p>
                    @endif

                    @if(isset($cd['highlights']) && count($cd['highlights']) > 0)
                        <ul class="space-y-3 mb-10">
                            @foreach($cd['highlights'] as $highlight)
                                <li class="flex items-center text-slate-300">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-3 flex-shrink-0"></span>
                                    {{ $highlight }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ url('/contact') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-blue-600/25">
                        Book a Consultation
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                <div class="hidden lg:block">
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-[400px] object-cover rounded-3xl shadow-2xl">
                    @else
                        <div class="w-full h-[400px] bg-slate-800 rounded-3xl flex items-center justify-center">
                            <svg class="w-32 h-32 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-600 rounded-full blur-[120px] opacity-10"></div>

        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mt-12">
            <nav class="flex space-x-2 text-slate-500 text-sm">
                <a href="{{ url('/') }}" class="hover:text-blue-400 transition-colors">Home</a>
                <span>/</span>
                <a href="{{ url('/services') }}" class="hover:text-blue-400 transition-colors">Services</a>
                <span>/</span>
                <span class="text-blue-400">{{ $service->title }}</span>
            </nav>
        </div>
    </section>

    <!-- 2. Description & Features Section -->
    @if(isset($cd['features']) && count($cd['features']) > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $cd['features_title'] ?? $service->title . ' Services' }}</h2>
                @if($service->summary)
                    <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed">{{ $service->summary }}</p>
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cd['features'] as $feature)
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $feature['title'] }}</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 3. Approach Section -->
    @if(isset($cd['approach']))
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $cd['approach']['title'] ?? 'Our Approach' }}</h2>
                    <p class="text-slate-600 leading-relaxed mb-6">{{ $cd['approach']['description'] ?? '' }}</p>
                    @if(isset($cd['approach']['description2']))
                        <p class="text-slate-600 leading-relaxed">{{ $cd['approach']['description2'] }}</p>
                    @endif
                </div>
                <div>
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-[350px] object-cover rounded-3xl shadow-lg">
                    @else
                        <div class="w-full h-[350px] bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 4. Solutions Section -->
    @if(isset($cd['solutions']) && count($cd['solutions']) > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $cd['solutions_title'] ?? 'Comprehensive Solutions' }}</h2>
                @if(isset($cd['solutions_subtitle']))
                    <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed">{{ $cd['solutions_subtitle'] }}</p>
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cd['solutions'] as $solution)
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                        <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $solution['title'] }}</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $solution['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 5. CTA Banner -->
    <section class="py-20 bg-slate-900 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $cd['cta']['title'] ?? 'Want to Consult Our Experts?' }}</h2>
            <p class="text-slate-300 mb-8 text-lg leading-relaxed">{{ $cd['cta']['subtitle'] ?? 'Whether you are in the ideation phase or validating the concept, our expert team can provide you with the best guidance and roadmap for successful outcomes.' }}</p>
            <a href="{{ url('/contact') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-blue-600/25">
                {{ $cd['cta']['button'] ?? 'Connect With Us Today' }}
            </a>
        </div>
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-600 rounded-full blur-[120px] opacity-10"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-purple-600 rounded-full blur-[120px] opacity-10"></div>
    </section>

    <!-- 6. Achievements Section -->
    @if(isset($cd['achievements']) && count($cd['achievements']) > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">Our Achievements</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($cd['achievements'] as $achievement)
                    <div class="text-center p-6 rounded-2xl border border-slate-100 hover:shadow-lg transition-all">
                        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $achievement['title'] }}</div>
                        <div class="flex justify-center mb-2">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <p class="text-slate-600 text-sm">{{ $achievement['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 7. Testimonials Section -->
    @if(isset($cd['testimonials']) && count($cd['testimonials']) > 0)
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Client Testimonials</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Know why our clients continuously praise our consulting services and how we helped them deliver exceptional results.</p>
            </div>
            <div class="space-y-8">
                @foreach($cd['testimonials'] as $testimonial)
                    <div class="bg-white p-8 md:p-12 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-slate-900 mb-1">{{ $testimonial['title'] }}</h4>
                                <p class="text-blue-600 text-sm mb-4 font-medium">{{ $testimonial['role'] ?? 'Client' }}</p>
                                <p class="text-slate-600 leading-relaxed">{{ $testimonial['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 8. Why Choose Us Section -->
    @if(isset($cd['why_choose']))
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $cd['why_choose']['title'] ?? 'Why Choose Us As Your Partner?' }}</h2>
                    <p class="text-slate-600 leading-relaxed mb-8">{{ $cd['why_choose']['description'] ?? '' }}</p>
                    @if(isset($cd['why_choose_points']) && count($cd['why_choose_points']) > 0)
                        <ul class="space-y-3">
                            @foreach($cd['why_choose_points'] as $point)
                                <li class="flex items-center text-slate-700">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-3 flex-shrink-0"></span>
                                    {{ $point }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div>
                    @if(isset($cd['why_choose_image']))
                        <img src="{{ Storage::url($cd['why_choose_image']) }}" alt="{{ $service->title }}" class="w-full h-[350px] object-cover rounded-3xl shadow-lg">
                    @elseif($service->image)
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-[350px] object-cover rounded-3xl shadow-lg">
                    @else
                        <div class="w-full h-[350px] bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 9. CTA Banner 2 -->
    <section class="py-20 bg-slate-900 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $cd['cta2']['title'] ?? "Want to Get Started With Your Software Solution?" }}</h2>
            <p class="text-slate-300 mb-8 text-lg">{{ $cd['cta2']['subtitle'] ?? 'Contact our team of consultants with your idea today!' }}</p>
            <a href="{{ url('/contact') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-blue-600/25">
                {{ $cd['cta2']['button'] ?? "Let's Connect" }}
            </a>
        </div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600 rounded-full blur-[120px] opacity-10"></div>
    </section>

    <!-- 10. Looking for Other Services (Tag Style) -->
    @if($otherServices->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Looking for Other Development Services?</h2>
            <div class="w-16 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto mb-12">Explore our wide range of development services designed to bring your innovative ideas to life, tailored to meet your unique business needs.</p>
            <div class="flex flex-wrap justify-center gap-4">
                @foreach($otherServices as $other)
                    <a href="{{ url('/services/' . $other->slug) }}" class="inline-flex items-center px-6 py-3 bg-white border border-slate-200 rounded-full text-slate-700 font-medium hover:border-blue-400 hover:text-blue-600 hover:shadow-md transition-all duration-300 group">
                        <svg class="w-4 h-4 mr-2 text-blue-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        {{ $other->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 11. Process Section -->
    @if(isset($cd['process']) && count($cd['process']) > 0)
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $cd['process_title'] ?? 'Our Development Process' }}</h2>
                @if(isset($cd['process_subtitle']))
                    <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed">{{ $cd['process_subtitle'] }}</p>
                @endif
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div>
                    @if(isset($cd['process_image']))
                        <img src="{{ Storage::url($cd['process_image']) }}" alt="Process" class="w-full h-[450px] object-cover rounded-3xl shadow-lg sticky top-32">
                    @elseif($service->image)
                        <img src="{{ Storage::url($service->image) }}" alt="Process" class="w-full h-[450px] object-cover rounded-3xl shadow-lg sticky top-32">
                    @else
                        <div class="w-full h-[450px] bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center sticky top-32">
                            <svg class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                    @endif
                </div>
                <div class="space-y-4">
                    @foreach($cd['process'] as $index => $step)
                        <div class="bg-white border border-slate-100 rounded-2xl p-6 hover:shadow-lg hover:border-blue-100 transition-all duration-300 flex gap-4 items-start">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold flex-shrink-0 mt-1">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-2">{{ $step['title'] }}</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">{{ $step['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 12. Frameworks Section -->
    @if(isset($cd['frameworks']) && count($cd['frameworks']) > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">{{ $cd['frameworks_title'] ?? 'Frameworks We Use' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($cd['frameworks'] as $framework)
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $framework['title'] }}</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $framework['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 13. FAQs Section (Numbered Style) -->
    @if(isset($cd['faqs']) && count($cd['faqs']) > 0)
    <section class="py-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">FAQs</h2>
            <div class="space-y-4">
                @foreach($cd['faqs'] as $index => $faq)
                    <details class="group bg-white rounded-2xl border border-slate-100 hover:border-blue-100 transition-all [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex items-center p-6 cursor-pointer">
                            <span class="text-xl font-bold text-blue-600 mr-6 min-w-[40px]">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h4 class="text-lg font-bold text-slate-900 flex-1 pr-4">{{ $faq['title'] }}</h4>
                            <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 group-open:bg-blue-600 transition-all">
                                <svg class="w-4 h-4 text-blue-600 group-open:text-white transition-colors group-open:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </span>
                        </summary>
                        <div class="px-6 pb-6 ml-[64px] text-slate-600 text-sm leading-relaxed">
                            {{ $faq['description'] }}
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 14. Top Blogs Section -->
    @if(isset($latestPosts) && $latestPosts->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Top Blogs</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Stay informed and inspired with our selection of expertly curated blogs covering a wide range of topics and industries.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestPosts as $post)
                    <a href="{{ url('/blog/' . $post->slug) }}" class="bg-white rounded-2xl border border-slate-100 overflow-hidden hover:shadow-xl hover:border-blue-100 transition-all duration-300 group block">
                        @if($post->image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
                                <svg class="w-16 h-16 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <span class="text-xs font-semibold text-amber-500 uppercase mb-1 block">Technology</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $post->title }}</h3>
                            <div class="flex items-center text-xs text-slate-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->created_at->format('d M\'y') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ url('/blog') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-blue-600/25">
                    Read All Blogs
                </a>
            </div>
        </div>
    </section>
    @endif
@endsection
