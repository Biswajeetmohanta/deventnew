@extends('layouts.app')

@php
    $cd = $role->content_data;
    $seo = $cd['seo'] ?? [];
@endphp

@section('title', $seo['meta_title'] ?? $role->title . ' | Devent Technology')
@section('meta_description', $seo['meta_description'] ?? '')

@section('content')
    {{-- 1. Unique Premium Hero for Hiring --}}
    <section class="relative overflow-hidden" style="background: #020617; padding: 140px 0 100px 0;">
        {{-- Animated background --}}
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; pointer-events: none;">
            <div style="position: absolute; top: -10%; left: -10%; width: 40%; height: 60%; background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%); border-radius: 50%; filter: blur(80px);"></div>
            <div style="position: absolute; bottom: -10%; right: -10%; width: 40%; height: 60%; background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%); border-radius: 50%; filter: blur(80px);"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            {{-- Vetted Badge --}}
            <div style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); padding: 8px 24px; border-radius: 100px; margin-bottom: 32px; backdrop-filter: blur(10px);">
                <span style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; box-shadow: 0 0 15px #22c55e;"></span>
                <span style="color: #cbd5e1; font-size: 13px; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase;">{{ $cd['banner']['badge'] ?? 'TOP 1% VETTED TALENT' }}</span>
            </div>

            <h1 style="font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 900; color: #fff; line-height: 1.1; margin-bottom: 28px; letter-spacing: -0.02em;">
                {!! $cd['banner']['title'] ?? $role->title !!}
            </h1>
            
            <p style="color: #94a3b8; font-size: 20px; line-height: 1.6; max-width: 800px; margin: 0 auto 50px;">
                {{ $cd['banner']['subtitle'] ?? '' }}
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 12px; background: #3b82f6; color: #fff; font-weight: 800; font-size: 16px; padding: 20px 48px; border-radius: 18px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-5px)'; this.style.backgroundColor='#2563eb';" onmouseout="this.style.transform='translateY(0)'; this.style.backgroundColor='#3b82f6';">
                    {{ $cd['banner']['button_text'] ?? 'Hire Developers Now' }}
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <div style="display: flex; align-items: center; gap: 12px; color: #94a3b8; font-weight: 700; font-size: 15px;">
                    <div style="display: flex; -webkit-mask-image: linear-gradient(to right, black 80%, transparent);">
                        @for($i = 0; $i < 5; $i++)
                            <div style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid #020617; background: #1e293b; margin-left: -12px; first:margin-left-0;">
                                <img src="https://i.pravatar.cc/100?img={{ 30 + $i }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            </div>
                        @endfor
                    </div>
                    <span>{{ $cd['banner']['stats_text'] ?? 'Joined by 500+ Companies' }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. Modern Intro Section --}}
    @if(isset($cd['about']))
    <section style="padding: 120px 0; background: #fff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
                <div style="position: relative;">
                    <div style="position: relative; z-index: 2; border-radius: 40px; overflow: hidden; box-shadow: 0 50px 100px rgba(0,0,0,0.1);">
                        @if(isset($cd['about_image']))
                            <img src="{{ asset('storage/' . $cd['about_image']) }}" style="width: 100%; height: 600px; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 600px; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-user-tie text-9xl text-slate-300"></i>
                            </div>
                        @endif
                    </div>
                    {{-- Decorative overlap --}}
                    <div style="position: absolute; bottom: -40px; right: -40px; width: 200px; height: 200px; background: #3b82f6; border-radius: 40px; z-index: 1; opacity: 0.1;"></div>
                </div>
                <div>
                    <span style="color: #3b82f6; font-weight: 900; font-size: 14px; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 20px; display: block;">{{ $cd['about']['label'] ?? 'Overview' }}</span>
                    <h2 style="font-size: 48px; font-weight: 900; color: #0f172a; line-height: 1.1; margin-bottom: 32px;">{{ $cd['about']['title'] ?? '' }}</h2>
                    <div style="font-size: 18px; line-height: 1.8; color: #475569; margin-bottom: 40px;">
                        {!! nl2br(e($cd['about']['description'] ?? '')) !!}
                    </div>
                    <div style="display: grid; grid-cols: 1fr 1fr; gap: 24px;">
                        @foreach($cd['why_choose_points'] ?? [] as $point)
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 24px; height: 24px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-check text-blue-600 text-xs"></i>
                            </div>
                            <span style="font-weight: 700; color: #1e293b; font-size: 15px;">{{ $point }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- 3. Why Choose Us / Stats --}}
    @if(isset($cd['why_choose']))
    <section style="padding: 100px 0; background: #0f172a; color: #fff; position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; background: radial-gradient(circle at 70% 30%, rgba(59, 130, 246, 0.1), transparent 70%);"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 style="font-size: clamp(2rem, 3vw, 2.5rem); font-weight: 800; color: #fff; margin-bottom: 24px;">{{ $cd['why_choose']['title'] ?? '' }}</h2>
                    <p style="color: rgba(203, 213, 225, 0.8); font-size: 17px; line-height: 1.7;">{{ $cd['why_choose']['description'] ?? '' }}</p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 30px; padding: 40px;">
                    <div class="grid grid-cols-2 gap-8 text-center">
                        <div>
                            <div style="font-size: 40px; font-weight: 800; color: #3b82f6; margin-bottom: 8px;">{{ $cd['why_choose']['stat1_value'] ?? '10+' }}</div>
                            <div style="font-size: 13px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;">{{ $cd['why_choose']['stat1_label'] ?? 'Years Experience' }}</div>
                        </div>
                        <div>
                            <div style="font-size: 40px; font-weight: 800; color: #3b82f6; margin-bottom: 8px;">{{ $cd['why_choose']['stat2_value'] ?? '500+' }}</div>
                            <div style="font-size: 13px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;">{{ $cd['why_choose']['stat2_label'] ?? 'Success Stories' }}</div>
                        </div>
                        <div>
                            <div style="font-size: 40px; font-weight: 800; color: #3b82f6; margin-bottom: 8px;">{{ $cd['why_choose']['stat3_value'] ?? '150+' }}</div>
                            <div style="font-size: 13px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;">{{ $cd['why_choose']['stat3_label'] ?? 'Expert Vetted Devs' }}</div>
                        </div>
                        <div>
                            <div style="font-size: 40px; font-weight: 800; color: #3b82f6; margin-bottom: 8px;">{{ $cd['why_choose']['stat4_value'] ?? '99%' }}</div>
                            <div style="font-size: 13px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;">{{ $cd['why_choose']['stat4_label'] ?? 'Client Retention' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- 3. Hiring Models - Different Pricing Style --}}
    @if(isset($cd['hiring_models']) && count($cd['hiring_models']) > 0)
    <section style="padding: 120px 0; background: #f8fafc;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 style="font-size: 40px; font-weight: 900; color: #0f172a; margin-bottom: 60px;">{{ $cd['hiring_models_title'] ?? 'Our Hiring Models' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($cd['hiring_models'] as $model)
                <div class="premium-card group">
                    <div class="premium-card-icon">
                        <i class="{{ $model['icon'] ?? 'fa-solid fa-user-check' }}" style="font-size: 24px; color: #3b82f6;"></i>
                    </div>
                    <h3 class="premium-card-title">{{ $model['title'] }}</h3>
                    <p class="premium-card-text mb-8">{{ $model['description'] }}</p>
                    <a href="{{ url('/contact') }}" style="font-weight: 800; color: #3b82f6; text-decoration: none; display: flex; align-items: center; gap: 8px; font-size: 15px;">
                        Learn More
                        <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-2"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- 4. Skills Matrix - Dense Grid --}}
    @if(isset($cd['skills']) && count($cd['skills']) > 0)
    <section style="padding: 120px 0; background: #fff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="text-align: center; margin-bottom: 80px;">
                <span style="color: #3b82f6; font-weight: 900; font-size: 14px; letter-spacing: 0.2em; text-transform: uppercase;">Technical Depth</span>
                <h2 style="font-size: 40px; font-weight: 900; color: #0f172a; margin-top: 20px;">{{ $cd['skills_title'] ?? 'Developer Expertise' }}</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($cd['skills'] as $skill)
                <div class="premium-card group">
                    <h4 class="premium-card-title">{{ $skill['title'] }}</h4>
                    <p class="premium-card-text">{{ $skill['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- 5. FAQ with unique style --}}
    @if(isset($cd['faqs']) && count($cd['faqs']) > 0)
    <section style="padding: 120px 0; background: #f8fafc;">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 style="font-size: 36px; font-weight: 900; color: #0f172a; text-center; margin-bottom: 60px;">{{ $cd['faqs_title'] ?? 'Common Questions' }}</h2>
            <div class="space-y-4">
                @foreach($cd['faqs'] as $index => $faq)
                <details class="group bg-white rounded-2xl border border-slate-100 shadow-sm" style="overflow: hidden;">
                    <summary class="flex justify-between items-center p-6 cursor-pointer list-none">
                        <span style="font-size: 17px; font-weight: 800; color: #0f172a;">{{ $faq['title'] ?? $faq['question'] ?? '' }}</span>
                        <span class="transition-transform group-open:rotate-180" style="width: 32px; height: 32px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </summary>
                        <div class="p-6 pt-0 text-slate-500 line-height-1.7 text-16 border-t border-slate-50">
                            {{ $faq['description'] ?? $faq['answer'] ?? '' }}
                        </div>
                </details>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section style="padding: 100px 0; background: #fff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 48px; padding: 80px 40px; text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; inset: 0; background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
                <div class="relative z-10">
                    <h2 style="font-size: 48px; font-weight: 900; color: #fff; margin-bottom: 24px;">{{ $cd['cta']['title'] ?? "Ready to scale your team?" }}</h2>
                    <p style="color: rgba(255,255,255,0.9); font-size: 18px; margin-bottom: 48px; max-width: 600px; margin-inline: auto;">{{ $cd['cta']['subtitle'] ?? 'Talk to our talent experts today and find the perfect match for your project.' }}</p>
                    <a href="{{ url('/contact') }}" style="background: #fff; color: #3b82f6; font-weight: 900; font-size: 16px; padding: 20px 48px; border-radius: 20px; text-decoration: none; display: inline-flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        {{ $cd['cta']['button'] ?? 'Book a Consultation' }}
                        <i class="fa-solid fa-calendar-check"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
