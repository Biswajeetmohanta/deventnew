@extends('layouts.app')

@section('title', ($industry->content_data['seo']['meta_title'] ?? $industry->title . ' Solutions | Devent Technology'))
@section('meta_description', ($industry->content_data['seo']['meta_description'] ?? $industry->description))

@section('content')
    @php
        $cd = $industry->content_data ?? [];
    @endphp

    {{-- 1. Hero Banner --}}
    @if(isset($cd['banner']))
        <x-industry.hero-banner 
            :title="$cd['banner']['title'] ?? $industry->title"
            :subtitle="$cd['banner']['subtitle'] ?? ''"
            :badge="$cd['banner']['badge'] ?? ''"
            :videoUrl="$cd['banner']['video_url'] ?? '#'"
            :image="$industry->image ?? ''"
            :statistics="$cd['statistics'] ?? []"
            :breadcrumb="$industry->title"
        />
    @else
        <section class="py-32 bg-slate-50 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="w-24 h-24 bg-[#0052FF] rounded-3xl flex items-center justify-center text-white shadow-2xl shadow-blue-200">
                        <i class="{{ $industry->icon ?? 'fa-solid fa-layer-group' }} text-4xl"></i>
                    </div>
                    <div>
                        <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-6 tracking-tighter leading-tight">{{ $industry->title }}</h1>
                        <p class="text-xl text-slate-600 max-w-2xl leading-relaxed font-medium">Custom technology solutions for the {{ $industry->title }} sector.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- 2. Solutions Grid --}}
    @if(isset($cd['solutions']))
        <x-industry.solutions-grid 
            :title="$cd['solutions_title'] ?? 'Our Solutions'"
            :subtitle="$cd['solutions_subtitle'] ?? ''"
            :label="$cd['solutions_label'] ?? 'OUR SOLUTIONS'"
            :solutions="$cd['solutions']"
        />
    @endif

    {{-- 3. Content Section with Sidebar --}}
    <section style="padding: 80px 0; background: #fff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <div class="lg:col-span-2">
                    @if(isset($cd['intro']))
                        <div style="margin-bottom: 40px;">
                            <h2 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 12px;">{{ $cd['intro']['title'] }}</h2>
                            <div style="color: #64748b; font-size: 15px; line-height: 1.7;">{!! nl2br(e($cd['intro']['description'])) !!}</div>
                        </div>
                    @endif

                    @if(isset($cd['about']))
                        <div style="margin-bottom: 40px;">
                            <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 12px;">{{ $cd['about']['title'] ?? '' }}</h2>
                            <div style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 20px;">{!! nl2br(e($cd['about']['description'] ?? '')) !!}</div>
                            @if(isset($cd['about']['detailed_overview']) && !empty($cd['about']['detailed_overview']))
                                <div style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 24px; padding-left: 16px; border-left: 3px solid #3b82f6;">
                                    {!! nl2br(e($cd['about']['detailed_overview'])) !!}
                                </div>
                            @endif
                        </div>
                    @else
                        <div style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 40px;">
                            {!! nl2br(e($industry->description)) !!}
                        </div>
                    @endif

                    @if(isset($cd['highlights']) && count($cd['highlights']) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6 mb-10">
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

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    <div style="position: sticky; top: 100px; display: flex; flex-direction: column; gap: 30px;">
                        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 20px; padding: 30px; color: #fff; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);">
                            <div style="position: relative; z-index: 1;">
                                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Ready to transform your business?</h3>
                                <p style="font-size: 13px; color: #94a3b8; line-height: 1.6; margin-bottom: 24px;">Consult with our experts about your {{ $industry->title }} solutions.</p>
                                <a href="{{ url('/contact') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #fff; color: #0f172a; font-weight: 700; font-size: 14px; padding: 14px; border-radius: 12px; text-decoration: none;">Get Started</a>
                            </div>
                        </div>

                        <div style="background: #f8fafc; padding: 28px; border-radius: 20px; border: 1px solid #e2e8f0;">
                            <h4 style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 20px;">All Industries</h4>
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($otherIndustries ?? [] as $other)
                                    <a href="{{ url('/industry/' . $other->slug) }}" style="display: flex; align-items: center; padding: 12px 16px; border-radius: 12px; background: #fff; border: 1px solid {{ $other->id == $industry->id ? '#3b82f6' : '#e2e8f0' }}; text-decoration: none; transition: all 0.2s ease; {{ $other->id == $industry->id ? 'box-shadow: 0 4px 12px rgba(59, 130, 246, 0.12);' : '' }}">
                                        <div style="width: 36px; height: 36px; flex-shrink: 0; margin-right: 12px; background: {{ $other->id == $industry->id ? '#eff6ff' : '#f1f5f9' }}; border-radius: 100px; display: flex; align-items: center; justify-content: center;">
                                            <i class="{{ $other->icon ?? 'fa-solid fa-layer-group' }}" style="color: {{ $other->id == $industry->id ? '#3b82f6' : '#94a3b8' }}; font-size: 14px;"></i>
                                        </div>
                                        <span style="font-size: 14px; font-weight: 600; color: {{ $other->id == $industry->id ? '#3b82f6' : '#334155' }}; flex: 1;">{{ $other->title }}</span>
                                        <svg width="16" height="16" fill="none" stroke="{{ $other->id == $industry->id ? '#3b82f6' : '#94a3b8' }}" viewBox="0 0 24 24" stroke-width="2" style="flex-shrink: 0;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Features --}}
    @if(isset($cd['features']))
        <x-industry.feature-grid 
            :title="$cd['features_title'] ?? 'Key Features & Benefits'" 
            :features="$cd['features']" 
        />
    @endif

    {{-- 5. Process --}}
    @if(isset($cd['process']))
        <x-industry.process-timeline 
            :title="$cd['process_title'] ?? 'Our Process'" 
            :steps="$cd['process']" 
            :image="$cd['process_image'] ?? ''" 
        />
    @endif

    {{-- 6. Key Advantages --}}
    @if(isset($cd['advantages']) && count($cd['advantages']) > 0)
        <section style="padding: 80px 0; background: #fff;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; margin-bottom: 50px;">Why Choose Us for {{ $industry->title }}</h2>
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

    {{-- 7. Why Choose Us Banner --}}
    @if(isset($cd['why_choose']))
        <section style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%); padding: 50px 0; position: relative; overflow: hidden;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div>
                        <h3 style="font-size: clamp(1.25rem, 2vw, 1.75rem); font-weight: 800; color: #fff; margin-bottom: 10px;">{{ $cd['why_choose']['title'] }}</h3>
                        <p style="font-size: 13px; color: rgba(219, 234, 254, 0.8); line-height: 1.6;">{{ $cd['why_choose']['description'] }}</p>
                    </div>
                    @if(isset($cd['statistics']) && count($cd['statistics']) >= 2)
                        <div style="text-align: center;">
                            <div style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: #fff;">{{ $cd['statistics'][0]['title'] ?? '' }}</div>
                            <div style="font-size: 13px; color: rgba(219, 234, 254, 0.7);">{{ $cd['statistics'][0]['description'] ?? '' }}</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: #fff;">{{ $cd['statistics'][1]['title'] ?? '' }}</div>
                            <div style="font-size: 13px; color: rgba(219, 234, 254, 0.7);">{{ $cd['statistics'][1]['description'] ?? '' }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- 8. Tech Stack --}}
    @if(isset($cd['tech_stack']))
        <x-industry.tech-stack 
            :title="$cd['tech_stack_title'] ?? 'Technology Stack'" 
            :tech_stack="$cd['tech_stack']" 
        />
    @endif

    {{-- 9. FAQs --}}
    @if(isset($cd['faqs']))
        <x-industry.faq-accordion 
            :faqs="$cd['faqs']" 
            :title="$cd['faqs_title'] ?? 'Frequently Asked Questions'" 
        />
    @endif

    {{-- 10. Testimonials --}}
    @if(isset($cd['testimonials']))
        <x-industry.testimonial-slider 
            :title="$cd['testimonials_title'] ?? 'Client Success Stories'" 
            :testimonials="$cd['testimonials']" 
        />
    @endif

    {{-- 11. Expert Consultation --}}
    @if(isset($cd['expert_consultation']))
        <section style="padding: 100px 0; background: #fff; border-top: 1px solid #f1f5f9;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div style="background: #f8fafc; border-radius: 30px; padding: 60px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 40px;" class="flex-col md:flex-row text-center md:text-left">
                    <div style="flex: 1;">
                        <div style="width: 56px; height: 56px; background: #3b82f6; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;" class="mx-auto md:mx-0">
                            <i class="fa-solid fa-comments" style="color: #fff; font-size: 24px;"></i>
                        </div>
                        <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #0f172a; margin-bottom: 16px;">{{ $cd['expert_consultation']['title'] }}</h2>
                        <p style="font-size: 16px; color: #64748b; line-height: 1.7; max-width: 600px;">{{ $cd['expert_consultation']['description'] }}</p>
                    </div>
                    <div style="flex-shrink: 0;">
                        <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 10px; background: #0f172a; color: #fff; font-weight: 700; font-size: 15px; padding: 18px 40px; border-radius: 16px; text-decoration: none; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);">
                            {{ $cd['expert_consultation']['button'] ?? 'Schedule a Free Consultation' }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- 12. CTA --}}
    @if(isset($cd['cta']))
        <section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 80px 0; position: relative; overflow: hidden;">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #fff; margin-bottom: 14px;">{{ $cd['cta']['title'] }}</h2>
                <p style="color: rgba(148, 163, 184, 0.8); margin-bottom: 32px; font-size: 16px;">{{ $cd['cta']['subtitle'] ?? '' }}</p>
                <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #3b82f6; color: #fff; font-weight: 700; font-size: 14px; padding: 16px 36px; border-radius: 14px; text-decoration: none; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);">
                    {{ $cd['cta']['button'] ?? "Let's Connect" }}
                </a>
            </div>
        </section>
    @endif

@endsection
