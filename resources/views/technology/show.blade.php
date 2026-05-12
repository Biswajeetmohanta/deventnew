@extends('layouts.app')

@section('title', ($technology->content_data['seo']['meta_title'] ?? $technology->name . ' | Devent Technology'))
@section('meta_description', ($technology->content_data['seo']['meta_description'] ?? $technology->description))

@section('content')
    @php
        $cd = $technology->content_data ?? [];
    @endphp

    <!-- 1. Hero Banner Component -->
    @if(isset($cd['banner']))
        <x-technology.hero-banner 
            :title="$cd['banner']['title'] ?? $technology->name"
            :subtitle="$cd['banner']['subtitle'] ?? ''"
            :highlights="$cd['highlights'] ?? []"
            :image="$technology->logo"
            :breadcrumb="$cd['breadcrumb_title'] ?? $technology->name"
        />
    @else
        <!-- Fallback to classic Hero Section -->
        <section class="bg-slate-950 py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">{{ $technology->name }}</h1>
                <nav class="flex justify-center space-x-2 text-slate-400 text-sm">
                    <a href="{{ url('/') }}" class="hover:text-blue-400">Home</a>
                    <span>/</span>
                    <a href="{{ url('/technology') }}" class="hover:text-blue-400">Technology</a>
                    <span>/</span>
                    <span class="text-blue-500">{{ $technology->name }}</span>
                </nav>
            </div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-10"></div>
        </section>
    @endif

    <!-- 2. Content Section (Existing Approved Layout) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <div class="lg:col-span-2">
                    @if($technology->logo && !isset($cd['banner']))
                        <div class="bg-slate-50 rounded-[40px] shadow-2xl mb-12 flex items-center justify-center p-16" style="height: 384px;">
                            <img src="{{ Storage::url($technology->logo) }}" alt="{{ $technology->name }}" style="max-width: 200px; max-height: 200px; object-fit: contain;">
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <span class="inline-block bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full">{{ $technology->category }}</span>
                    </div>

                    <!-- Intro Section -->
                    @if(isset($cd['intro']))
                        <div class="mb-12">
                            <h2 class="text-3xl font-bold text-slate-900 mb-4">{{ $cd['intro']['title'] }}</h2>
                            <div class="prose prose-lg max-w-none text-slate-600">
                                {!! nl2br(e($cd['intro']['description'])) !!}
                            </div>
                            @if(isset($cd['intro_image']))
                                <img src="{{ Storage::url($cd['intro_image']) }}" class="w-full h-[300px] object-cover rounded-2xl mt-6">
                            @endif
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none text-slate-600">
                        @if(isset($cd['about']))
                            <h2 class="text-3xl font-bold text-slate-900 mb-4">{{ $cd['about']['title'] }}</h2>
                            {!! nl2br(e($cd['about']['description'])) !!}
                        @else
                            {!! $technology->description ?? '<p>We leverage the power of <strong>' . e($technology->name) . '</strong> to build robust, scalable, and high-performance solutions tailored to your business needs.</p>' !!}
                        @endif
                    </div>

                    @if($technology->portfolios->count() > 0)
                        <div class="mt-16">
                            <h2 class="text-2xl font-bold text-slate-900 mb-8">Projects Built With {{ $technology->name }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                @foreach($technology->portfolios as $portfolio)
                                    <div class="bg-slate-50 rounded-2xl overflow-hidden hover:shadow-lg transition-all border border-slate-100">
                                        @if($portfolio->image)
                                            <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full" style="height: 192px; object-fit: cover;">
                                        @endif
                                        <div class="p-6">
                                            <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $portfolio->title }}</h3>
                                            <p class="text-sm text-slate-600 line-clamp-2">{{ $portfolio->description }}</p>
                                            <a href="{{ url('/portfolio/' . $portfolio->slug) }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 mt-4 inline-block">View Case Study &rarr;</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="lg:col-span-1">
                    <div class="bg-slate-50 p-8 rounded-3xl sticky top-32">
                        <h4 class="text-xl font-bold text-slate-950 mb-6">All Technologies</h4>
                        <div class="space-y-4">
                            @foreach($otherTechnologies as $other)
                                <a href="{{ url('/technology/' . $other->id) }}" class="flex items-center p-4 rounded-2xl bg-white border border-slate-100 hover:border-blue-200 hover:shadow-lg transition-all group {{ $other->id == $technology->id ? 'border-blue-400 shadow-md' : '' }}">
                                    <div class="flex-shrink-0 mr-4" style="width: 40px; height: 40px;">
                                        @if($other->logo)
                                            <img src="{{ Storage::url($other->logo) }}" alt="{{ $other->name }}" style="width: 40px; height: 40px; object-fit: contain;">
                                        @else
                                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                                <i class="fa-solid fa-code text-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-semibold text-slate-900">{{ $other->name }}</span>
                                </a>
                            @endforeach
                        </div>
                        
                        <div class="mt-12 bg-blue-600 rounded-3xl p-8 text-white relative overflow-hidden">
                            <h5 class="text-2xl font-bold mb-4 relative z-10">Have a project in mind?</h5>
                            <p class="text-blue-100 mb-6 relative z-10 text-sm">Let's discuss how we can bring your vision to life with the right technology stack.</p>
                            <a href="{{ url('/contact') }}" class="bg-white text-blue-600 px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-50 transition-colors relative z-10 inline-block">
                                Contact Us Now
                            </a>
                            <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white rounded-full opacity-10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Sections -->

    <!-- 5. Services / Solutions -->
    @if(isset($cd['solutions']))
        <x-technology.solutions-grid 
            :title="$cd['solutions_title'] ?? 'Our Solutions'"
            :solutions="$cd['solutions']"
        />
    @endif

    <!-- 6. Features -->
    @if(isset($cd['features']))
        <x-technology.feature-grid 
            :title="$cd['features_title'] ?? 'Key Features & Benefits'"
            :features="$cd['features']"
        />
    @endif

    <!-- 7. Process -->
    @if(isset($cd['process']))
        <x-technology.process-timeline 
            :title="$cd['process_title'] ?? 'Our Process'"
            :steps="$cd['process']"
            :image="$cd['process_image'] ?? ''"
        />
    @endif

    <!-- 8. Why Choose Us -->
    @if(isset($cd['why_choose']))
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">{{ $cd['why_choose']['title'] }}</h2>
                    <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed">{{ $cd['why_choose']['description'] }}</p>
                </div>
            </div>
        </section>
    @endif

    <!-- 9. Industries We Serve -->
    @if(isset($cd['industries_served']))
        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">Industries We Serve</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($cd['industries_served'] as $ind)
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 text-center">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4 mx-auto">
                                <i class="{{ $ind['description'] ?: 'fa-solid fa-layer-group' }} text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">{{ $ind['title'] }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 10. Engagement Models -->
    @if(isset($cd['engagement_models']))
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">Flexible Engagement Models</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($cd['engagement_models'] as $model)
                        <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300">
                            <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $model['title'] }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $model['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 11. Hiring Model -->
    @if(isset($cd['hiring']))
        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">{{ $cd['hiring']['title'] }}</h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed mb-8">{{ $cd['hiring']['description'] }}</p>
                <a href="{{ url('/contact') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-blue-600/25">
                    Hire Developers
                </a>
            </div>
        </section>
    @endif

    <!-- 12. Statistics -->
    @if(isset($cd['statistics']))
        <section class="py-20 bg-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    @foreach($cd['statistics'] as $stat)
                        <div>
                            <div class="text-4xl md:text-5xl font-black mb-2">{{ $stat['title'] }}</div>
                            <div class="text-blue-100 text-sm">{{ $stat['description'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 13. Tech Stack -->
    @if(isset($cd['tech_stack']))
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">Technology Stack & Tools</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($cd['tech_stack'] as $tool)
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-center">
                            <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $tool['title'] }}</h3>
                            <p class="text-slate-600 text-xs">{{ $tool['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 14. FAQs -->
    @if(isset($cd['faqs']))
        <x-technology.faq-accordion 
            :faqs="$cd['faqs']"
        />
    @endif

    <!-- 15. Testimonials -->
    @if(isset($cd['testimonials']))
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">Client Success Stories</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($cd['testimonials'] as $test)
                        <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100">
                            <p class="text-slate-600 text-sm leading-relaxed mb-6">"{{ $test['description'] }}"</p>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900">{{ $test['title'] }}</h4>
                                <p class="text-xs text-slate-500">{{ $test['subtitle'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 16. CTA Section -->
    @if(isset($cd['cta']))
        <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cd['cta']['title'] }}</h2>
                <p class="text-slate-300 mb-8 text-lg">{{ $cd['cta']['subtitle'] }}</p>
                <a href="{{ url('/contact') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-blue-600/25">
                    {{ $cd['cta']['button'] ?? 'Let\'s Connect' }}
                </a>
            </div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600 rounded-full blur-[120px] opacity-10"></div>
        </section>
    @endif

@endsection
