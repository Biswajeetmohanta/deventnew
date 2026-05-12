@extends('layouts.app')

@section('title', ($industry->content_data['seo']['meta_title'] ?? $industry->title . ' Solutions | Devent Technology'))
@section('meta_description', ($industry->content_data['seo']['meta_description'] ?? $industry->description))

@section('content')
    @php
        $cd = $industry->content_data ?? [];
    @endphp

    <!-- 1. Hero Banner Component -->
    @if(isset($cd['banner']))
        <x-industry.hero-banner 
            :title="$cd['banner']['title'] ?? $industry->title"
            :subtitle="$cd['banner']['subtitle'] ?? ''"
            :highlights="$cd['highlights'] ?? []"
            :image="$industry->image"
            :breadcrumb="$industry->title"
        />
    @else
        <!-- Fallback to classic Hero Section if no dynamic banner set -->
        <section class="py-32 bg-slate-50 relative overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-100/50 rounded-l-[100px] transform translate-x-1/3 -skew-x-12 opacity-30"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl opacity-50"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="w-24 h-24 bg-[#0052FF] rounded-3xl flex items-center justify-center text-white shadow-2xl shadow-blue-200">
                        @if($industry->icon)
                            <i class="{{ $industry->icon }} text-4xl"></i>
                        @else
                            <i class="fa-solid fa-layer-group text-4xl"></i>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-6 tracking-tighter leading-tight">
                            {{ $industry->title }}
                        </h1>
                        <p class="text-xl text-slate-600 max-w-2xl leading-relaxed font-medium">
                            Custom technology solutions designed specifically for the unique demands and complexities of the {{ $industry->title }} sector.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 2. Content Section (Existing Approved Layout) -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-black text-slate-950 mb-8 tracking-tight">
                        {{ \App\Models\Setting::where('key', 'industry_strategy_title')->first()?->value ?? 'Expertise & Strategy' }}
                    </h2>
                    <div class="prose prose-lg text-slate-600 font-medium leading-relaxed max-w-none">
                        {!! nl2br(e($industry->description)) !!}
                        <br><br>
                        {{ \App\Models\Setting::where('key', 'industry_strategy_text')->first()?->value ?? ("Our approach to " . $industry->title . " combines deep domain knowledge with cutting-edge technical execution. We don't just build software; we build strategic assets that solve core business problems, improve operational efficiency, and drive sustainable growth.") }}
                    </div>

                    <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100">
                            <div class="text-[#0052FF] mb-4 text-2xl"><i class="fa-solid fa-shield-halved"></i></div>
                            <h4 class="text-xl font-bold text-slate-900 mb-3">
                                {{ \App\Models\Setting::where('key', 'industry_card1_title')->first()?->value ?? 'Compliance & Security' }}
                            </h4>
                            <p class="text-slate-600 font-medium">
                                {{ \App\Models\Setting::where('key', 'industry_card1_text')->first()?->value ?? 'We ensure all solutions meet industry-specific regulations and the highest security standards.' }}
                            </p>
                        </div>
                        <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100">
                            <div class="text-[#0052FF] mb-4 text-2xl"><i class="fa-solid fa-chart-line"></i></div>
                            <h4 class="text-xl font-bold text-slate-900 mb-3">
                                {{ \App\Models\Setting::where('key', 'industry_card2_title')->first()?->value ?? 'Scalable Growth' }}
                            </h4>
                            <p class="text-slate-600 font-medium">
                                {{ \App\Models\Setting::where('key', 'industry_card2_text')->first()?->value ?? 'Systems designed to evolve alongside your business, handling increased loads without friction.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-32 space-y-8">
                        <!-- Contact Card -->
                        <div class="bg-slate-950 rounded-[40px] p-10 text-white relative overflow-hidden">
                            <div class="relative z-10">
                                <h3 class="text-2xl font-black mb-6 tracking-tight">Ready to transform your business?</h3>
                                <p class="text-slate-400 mb-8 font-medium">Consult with our experts about your specific needs.</p>
                                <a href="{{ url('/contact') }}" class="block w-full text-center bg-[#0052FF] text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-900/20">
                                    Get Started
                                </a>
                            </div>
                            <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-blue-600 rounded-full blur-[80px] opacity-20"></div>
                        </div>

                        <!-- Other Industries -->
                        <div class="p-10 rounded-[40px] border border-slate-100 bg-white shadow-xl shadow-slate-100">
                            <h3 class="text-xl font-black text-slate-950 mb-8 tracking-tight">Other Industries</h3>
                            <div class="space-y-4">
                                @foreach(\App\Models\Industry::where('id', '!=', $industry->id)->take(5)->get() as $other)
                                    <a href="{{ url('/industry/' . $other->slug) }}" class="flex items-center group">
                                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-[#0052FF] transition-all mr-4">
                                            <i class="{{ $other->icon ?? 'fa-solid fa-layer-group' }} text-sm"></i>
                                        </div>
                                        <span class="font-bold text-slate-600 group-hover:text-slate-950 transition-colors">{{ $other->title }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Sections (Added below the approved layout) -->

    <!-- 3. Features / Benefits -->
    @if(isset($cd['features']))
        <x-industry.feature-grid 
            :title="$cd['features_title'] ?? 'Key Features & Benefits'"
            :features="$cd['features']"
        />
    @endif

    <!-- 4. Solutions / Services -->
    @if(isset($cd['solutions']))
        <x-industry.solutions-grid 
            :title="$cd['solutions_title'] ?? 'Our Solutions'"
            :subtitle="$cd['solutions_subtitle'] ?? ''"
            :solutions="$cd['solutions']"
        />
    @endif

    <!-- 5. Process -->
    @if(isset($cd['process']))
        <x-industry.process-timeline 
            :title="$cd['process_title'] ?? 'Our Process'"
            :subtitle="$cd['process_subtitle'] ?? ''"
            :steps="$cd['process']"
            :image="$cd['process_image'] ?? ''"
        />
    @endif

    <!-- 6. Tech Stack -->
    @if(isset($cd['frameworks']))
        <x-industry.tech-stack 
            :title="$cd['frameworks_title'] ?? 'Technology Stack'"
            :frameworks="$cd['frameworks']"
        />
    @endif

    <!-- 7. Testimonials -->
    @if(isset($cd['testimonials']))
        <x-industry.testimonial-slider 
            :testimonials="$cd['testimonials']"
        />
    @endif

    <!-- 8. FAQs -->
    @if(isset($cd['faqs']))
        <x-industry.faq-accordion 
            :faqs="$cd['faqs']"
        />
    @endif

@endsection
