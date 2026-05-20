@extends('layouts.app')

@section('title', ($technology->content_data['seo']['meta_title'] ?? $technology->name . ' | Devent Technology'))
@section('meta_description', ($technology->content_data['seo']['meta_description'] ?? $technology->description))

@section('content')
    @php
        $cd = $technology->content_data ?? [];
    @endphp

    {{-- 1. Hero Banner with Stats --}}
    @if(isset($cd['banner']))
        <x-technology.hero-banner 
            :title="$cd['banner']['title'] ?? $technology->name"
            :subtitle="$cd['banner']['subtitle'] ?? ''"
            :statistics="$cd['statistics'] ?? []"
            :image="$technology->logo"
            :breadcrumb="$cd['breadcrumb_title'] ?? $technology->name"
            :techName="$technology->name"
            :badge="$cd['banner']['badge'] ?? ''"
            :videoUrl="$cd['banner']['video_url'] ?? ''"
        />
    @else
        {{-- Fallback Hero --}}
        <section style="background: linear-gradient(135deg, #060b24 0%, #0a1045 40%, #111a5e 70%, #0d1247 100%); padding: 40px 0 60px 0; position: relative; overflow: hidden;">
            <div style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 60px 60px; pointer-events: none;"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.25); border-radius: 100px; padding: 8px 20px; margin-bottom: 28px;">
                    <span style="font-size: 16px;">⚡</span>
                    <span style="color: #c4b5fd; font-size: 13px; font-weight: 600;">{{ $technology->name }} Development Excellence</span>
                </div>
                <h1 style="font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 800; color: #fff; margin-bottom: 20px;">{{ $technology->name }}</h1>
                <nav style="display: flex; gap: 8px; color: rgba(148, 163, 184, 0.7); font-size: 14px;">
                    <a href="{{ url('/') }}" style="color: rgba(148, 163, 184, 0.7); text-decoration: none;">Home</a>
                    <span>/</span>
                    <a href="{{ url('/technology') }}" style="color: rgba(148, 163, 184, 0.7); text-decoration: none;">Technology</a>
                    <span>/</span>
                    <span style="color: #818cf8;">{{ $technology->name }}</span>
                </nav>
            </div>
        </section>
    @endif

    {{-- 2. Solutions / What We Do --}}
    @if(isset($cd['solutions']))
        <x-technology.solutions-grid 
            :title="$cd['solutions_title'] ?? ($technology->name . ' Solutions That Drive Success')"
            :subtitle="$cd['solutions_subtitle'] ?? ('We transform ideas into powerful digital solutions using ' . $technology->name . '\'s versatility and cutting-edge technologies.')"
            :solutions="$cd['solutions']"
            :label="$cd['solutions_label'] ?? 'WHAT WE DO'"
        />
    @endif

    {{-- 3. Content Section with Sidebar --}}
    <section style="padding: 80px 0; background: #fff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    {{-- Category Badge --}}
                    <div style="margin-bottom: 16px;">
                        <span style="display: inline-block; background: #eff6ff; color: #3b82f6; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; padding: 6px 16px; border-radius: 6px;">{{ $technology->category }}</span>
                    </div>

                    {{-- Intro Section --}}
                    @if(isset($cd['intro']))
                        <div style="margin-bottom: 40px; display: flex; gap: 20px; align-items: flex-start;">
                            <div style="flex: 1;">
                                <h2 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 12px;">{{ $cd['intro']['title'] }}</h2>
                                <div style="color: #64748b; font-size: 15px; line-height: 1.7;">
                                    {!! nl2br(e($cd['intro']['description'])) !!}
                                </div>
                            </div>
                            <div style="width: 56px; height: 56px; background: #f1f5f9; border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa-solid fa-gear" style="color: #94a3b8; font-size: 22px;"></i>
                            </div>
                        </div>
                        @if(isset($cd['intro_image']))
                            <img src="{{ Storage::url($cd['intro_image']) }}" alt="{{ $cd['intro']['title'] }}" style="width: 100%; height: auto; max-height: 300px; object-fit: contain; background: #f8fafc; border-radius: 16px; margin-bottom: 40px;">
                        @endif
                    @endif

                    {{-- About Section --}}
                    @if(isset($cd['about']))
                        <div style="margin-bottom: 40px; display: flex; gap: 20px; align-items: flex-start;">
                            <div style="flex: 1;">
                                <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 12px;">{{ $cd['about']['title'] }}</h2>
                                <div style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 20px;">
                                    {!! nl2br(e($cd['about']['description'])) !!}
                                </div>
                                
                                @if(isset($cd['about']['detailed_overview']) && !empty($cd['about']['detailed_overview']))
                                    <div style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 24px; padding-left: 16px; border-left: 3px solid #3b82f6;">
                                        {!! nl2br(e($cd['about']['detailed_overview'])) !!}
                                    </div>
                                @endif

                                @if(isset($cd['highlights']) && count($cd['highlights']) > 0)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6">
                                        @foreach($cd['highlights'] as $highlight)
                                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: #334155; font-weight: 500;">
                                                <div style="width: 20px; height: 20px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                    <svg width="12" height="12" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                </div>
                                                {{ $highlight }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="22" height="22" fill="none" stroke="#94a3b8" viewBox="0 0 24 24" stroke-width="2"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6"/></svg>
                            </div>
                        </div>
                    @else
                        <div style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 40px;">
                            {!! $technology->description ?? '<p>We leverage the power of <strong>' . e($technology->name) . '</strong> to build robust, scalable, and high-performance solutions tailored to your business needs.</p>' !!}
                        </div>
                    @endif

                    {{-- Case Studies / Projects --}}
                    @if($technology->caseStudies->count() > 0)
                        <div style="margin-top: 40px;">
                            <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 24px;">Case Studies Built With {{ $technology->name }}</h2>
                            @foreach($technology->caseStudies as $caseStudy)
                                <div style="display: flex; gap: 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; margin-bottom: 16px;" class="flex-col sm:flex-row">
                                    @if($caseStudy->image)
                                        <div style="flex-shrink: 0;">
                                            <img src="{{ Storage::url($caseStudy->image) }}" alt="{{ $caseStudy->title }}" style="width: 240px; height: 180px; object-fit: cover;">
                                        </div>
                                    @endif
                                    <div style="padding: 24px; display: flex; flex-direction: column; justify-content: center;">
                                        <h3 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">{{ $caseStudy->title }}</h3>
                                        <p style="font-size: 13px; color: #64748b; line-height: 1.7; margin-bottom: 12px;">{{ Str::limit($caseStudy->description, 150) }}</p>
                                        <a href="{{ url('/case-studies/' . $caseStudy->slug) }}" style="font-size: 13px; font-weight: 700; color: #3b82f6; text-decoration: none;">View Case Study →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    <div style="position: sticky; top: 100px; display: flex; flex-direction: column; gap: 30px;">
                        {{-- Quick Contact Card --}}
                        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 20px; padding: 30px; color: #fff; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);">
                            <div style="position: relative; z-index: 1;">
                                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Need a custom quote?</h3>
                                <p style="font-size: 13px; color: #94a3b8; line-height: 1.6; margin-bottom: 24px;">Our experts are ready to help you with your {{ $technology->name }} project.</p>
                                <a href="{{ url('/contact') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #fff; color: #0f172a; font-weight: 700; font-size: 14px; padding: 14px; border-radius: 12px; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.background='#f1f5f9'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#fff'; this.style.transform='translateY(0)';">
                                    Get a Free Quote
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                            <div style="position: absolute; right: -20px; bottom: -20px; opacity: 0.1;">
                                <svg width="120" height="120" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg>
                            </div>
                        </div>

                        <div style="background: #f8fafc; padding: 28px; border-radius: 20px; border: 1px solid #e2e8f0;">
                            <h4 style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 20px;">All Technologies</h4>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            @foreach($otherTechnologies as $other)
                                <a href="{{ url('/technology/' . $other->slug) }}" style="display: flex; align-items: center; padding: 12px 16px; border-radius: 12px; background: #fff; border: 1px solid {{ $other->id == $technology->id ? '#3b82f6' : '#e2e8f0' }}; text-decoration: none; transition: all 0.2s ease; {{ $other->id == $technology->id ? 'box-shadow: 0 4px 12px rgba(59, 130, 246, 0.12);' : '' }}" onmouseover="this.style.borderColor='#93c5fd'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.08)';" onmouseout="this.style.borderColor='{{ $other->id == $technology->id ? '#3b82f6' : '#e2e8f0' }}'; this.style.boxShadow='{{ $other->id == $technology->id ? '0 4px 12px rgba(59, 130, 246, 0.12)' : 'none' }}';">
                                    <div style="width: 36px; height: 36px; flex-shrink: 0; margin-right: 12px; display: flex; align-items: center; justify-content: center;">
                                        @if($other->logo)
                                            <img src="{{ Storage::url($other->logo) }}" alt="{{ $other->name }}" style="width: 36px; height: 36px; object-fit: contain;">
                                        @else
                                            <div style="width: 36px; height: 36px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fa-solid fa-code" style="color: #94a3b8; font-size: 14px;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <span style="font-size: 14px; font-weight: 600; color: {{ $other->id == $technology->id ? '#3b82f6' : '#334155' }}; flex: 1;">{{ $other->name }}</span>
                                    <svg width="16" height="16" fill="none" stroke="{{ $other->id == $technology->id ? '#3b82f6' : '#94a3b8' }}" viewBox="0 0 24 24" stroke-width="2" style="flex-shrink: 0;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Features / Services We Offer --}}
    @if(isset($cd['features']))
        <x-technology.feature-grid 
            :title="$cd['features_title'] ?? ($technology->name . ' Development Services We Offer')"
            :features="$cd['features']"
        />
    @endif

    {{-- 5. Process --}}
    @if(isset($cd['process']))
        <x-technology.process-timeline 
            :title="$cd['process_title'] ?? ('Our ' . $technology->name . ' Development Process')"
            :steps="$cd['process']"
            :image="$cd['process_image'] ?? ''"
        />
    @endif

    {{-- 5b. Key Advantages --}}
    @if(isset($cd['advantages']) && count($cd['advantages']) > 0)
        <section style="padding: 80px 0; background: #fff;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; margin-bottom: 50px;">Why Businesses Choose {{ $technology->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach($cd['advantages'] as $adv)
                        <div style="text-align: center;">
                            <div style="width: 64px; height: 64px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fa-solid fa-check" style="color: #3b82f6; font-size: 24px;"></i>
                            </div>
                            <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">{{ $adv['title'] }}</h4>
                            <p style="font-size: 13px; color: #64748b; line-height: 1.6;">{{ $adv['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 6. Why Choose Us — Gradient Stats Banner --}}
    @if(isset($cd['why_choose']))
        <section style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%); padding: 50px 0; position: relative; overflow: hidden;">
            <div style="position: absolute; inset: 0; background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 30px 30px; pointer-events: none;"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    {{-- Left: Title + Description --}}
                    <div>
                        <h3 style="font-size: clamp(1.25rem, 2vw, 1.75rem); font-weight: 800; color: #fff; margin-bottom: 10px; line-height: 1.25;">{{ $cd['why_choose']['title'] }}</h3>
                        <p style="font-size: 13px; color: rgba(219, 234, 254, 0.8); line-height: 1.6;">{{ $cd['why_choose']['description'] }}</p>
                    </div>
                    {{-- Right: Stats --}}
                    @if(isset($cd['statistics']) && count($cd['statistics']) >= 2)
                        <div style="text-align: center;">
                            <div style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: #fff;">{{ $cd['statistics'][0]['title'] ?? '100+' }}</div>
                            <div style="font-size: 13px; color: rgba(219, 234, 254, 0.7); font-weight: 500;">{{ $cd['statistics'][0]['description'] ?? 'Projects Delivered' }}</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: #fff;">{{ $cd['statistics'][1]['title'] ?? '10+' }}</div>
                            <div style="font-size: 13px; color: rgba(219, 234, 254, 0.7); font-weight: 500;">{{ $cd['statistics'][1]['description'] ?? 'Years Experience' }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- 7. Industries We Serve --}}
    @if(isset($cd['industries_served']))
        <section style="padding: 80px 0; background: #f8fafc;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 50px;">{{ $cd['industries_title'] ?? 'Industries We Serve' }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($cd['industries_served'] as $ind)
                        <div style="background: #fff; padding: 28px 20px; border-radius: 16px; border: 1px solid #e2e8f0; text-align: center; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#bfdbfe'; this.style.boxShadow='0 10px 30px rgba(59,130,246,0.08)'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                            <div style="width: 48px; height: 48px; background: #eff6ff; border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px;">
                                <i class="{{ $ind['description'] ?: 'fa-solid fa-layer-group' }}" style="color: #3b82f6; font-size: 20px;"></i>
                            </div>
                            <h3 style="font-size: 15px; font-weight: 700; color: #0f172a;">{{ $ind['title'] }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 8. Engagement Models --}}
    @if(isset($cd['engagement_models']))
        <section style="padding: 80px 0; background: #fff;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 50px;">{{ $cd['engagement_title'] ?? 'Flexible Engagement Models' }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($cd['engagement_models'] as $model)
                        <div style="background: #f8fafc; padding: 32px 28px; border-radius: 16px; border: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#bfdbfe'; this.style.boxShadow='0 10px 30px rgba(59,130,246,0.08)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                            <h3 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">{{ $model['title'] }}</h3>
                            <p style="font-size: 13px; color: #64748b; line-height: 1.7;">{{ $model['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 9. Hiring Model --}}
    @if(isset($cd['hiring']))
        <section style="padding: 80px 0; background: #f8fafc;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; margin-bottom: 12px;">{{ $cd['hiring']['title'] }}</h2>
                <p style="color: #64748b; font-size: 15px; max-width: 700px; margin: 0 auto 28px; line-height: 1.7;">{{ $cd['hiring']['description'] }}</p>
                <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #3b82f6; color: #fff; font-weight: 700; font-size: 14px; padding: 14px 32px; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(59, 130, 246, 0.25);" onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)';">
                    Hire Developers
                </a>
            </div>
        </section>
    @endif

    {{-- 10. Tech Stack --}}
    @if(isset($cd['tech_stack']))
        <section style="padding: 80px 0; background: #fff;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 50px;">{{ $cd['tech_stack_title'] ?? 'Technology Stack & Tools' }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($cd['tech_stack'] as $tool)
                        <div style="background: #f8fafc; padding: 24px 20px; border-radius: 14px; border: 1px solid #e2e8f0; text-align: center;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">{{ $tool['title'] }}</h3>
                            <p style="font-size: 12px; color: #64748b;">{{ $tool['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 11. FAQs --}}
    @if(isset($cd['faqs']))
        <x-technology.faq-accordion :faqs="$cd['faqs']" :title="$cd['faqs_title'] ?? 'Frequently Asked Questions'" />
    @endif

    {{-- 12. Testimonials --}}
    @if(isset($cd['testimonials']))
        <section style="padding: 80px 0; background: #f8fafc;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 50px;">{{ $cd['testimonials_title'] ?? 'Client Success Stories' }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($cd['testimonials'] as $test)
                        <div style="background: #fff; padding: 32px 28px; border-radius: 16px; border: 1px solid #e2e8f0;">
                            <p style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 20px;">"{{ $test['description'] }}"</p>
                            <div>
                                <h4 style="font-size: 16px; font-weight: 700; color: #0f172a;">{{ $test['title'] }}</h4>
                                <p style="font-size: 12px; color: #94a3b8;">{{ $test['subtitle'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 12b. Expert Consultation --}}
    @if(isset($cd['expert_consultation']))
        <section style="padding: 100px 0; background: #fff; border-top: 1px solid #f1f5f9;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div style="background: #f8fafc; border-radius: 30px; padding: 60px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 40px;" class="flex-col md:flex-row text-center md:text-left">
                    <div style="flex: 1;">
                        <div style="width: 56px; height: 56px; background: #3b82f6; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;" class="mx-auto md:mx-0">
                            <i class="fa-solid fa-comments" style="color: #fff; font-size: 24px;"></i>
                        </div>
                        <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #0f172a; margin-bottom: 16px; line-height: 1.2;">{{ $cd['expert_consultation']['title'] }}</h2>
                        <p style="font-size: 16px; color: #64748b; line-height: 1.7; max-width: 600px;">{{ $cd['expert_consultation']['description'] }}</p>
                    </div>
                    <div style="flex-shrink: 0;">
                        <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 10px; background: #0f172a; color: #fff; font-weight: 700; font-size: 15px; padding: 18px 40px; border-radius: 16px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);" onmouseover="this.style.background='#1e293b'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#0f172a'; this.style.transform='translateY(0)';">
                            {{ $cd['expert_consultation']['button'] ?? 'Schedule a Free Consultation' }}
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- 13. CTA Section --}}
    @if(isset($cd['cta']))
        <section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 80px 0; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; right: 0; width: 300px; height: 300px; background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #fff; margin-bottom: 14px;">{{ $cd['cta']['title'] }}</h2>
                <p style="color: rgba(148, 163, 184, 0.8); margin-bottom: 32px; font-size: 16px;">{{ $cd['cta']['subtitle'] }}</p>
                <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #3b82f6; color: #fff; font-weight: 700; font-size: 14px; padding: 16px 36px; border-radius: 14px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);" onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)';">
                    {{ $cd['cta']['button'] ?? "Let's Connect" }}
                </a>
            </div>
        </section>
    @endif

@endsection
