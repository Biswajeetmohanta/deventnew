@extends('layouts.app')

@section('title', $service->title . ' | Devent Technology')

@section('content')
    @php
        $cd = $service->content_data ?? [];
    @endphp

    {{-- 1. Hero Banner --}}
    <x-service.hero-banner 
        :title="$cd['banner']['title'] ?? $service->title"
        :subtitle="$cd['banner']['subtitle'] ?? ''"
        :highlights="$cd['highlights'] ?? []"
        :image="$service->image ?? ''"
        :badge="$cd['banner']['badge'] ?? 'PREMIUM SERVICE'"
        :videoUrl="$cd['banner']['video_url'] ?? '#'"
        :statistics="$cd['statistics'] ?? []"
        :breadcrumb="$service->title"
    />

    {{-- 2. Features / Benefits --}}
    @if(isset($cd['features']) && count($cd['features']) > 0)
        <x-service.feature-grid 
            :title="$cd['features_title'] ?? $service->title . ' Services'" 
            :features="$cd['features']" 
        />
    @endif

    {{-- 3. Approach Section (Styled Premium) --}}
    @if(isset($cd['approach']))
    <section style="padding: 100px 0; background: #fff; position: relative; overflow: hidden;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative z-10">
                    <div style="display: inline-block; padding: 8px 20px; background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.15); border-radius: 100px; color: #3b82f6; font-size: 13px; font-weight: 700; letter-spacing: 0.05em; margin-bottom: 24px; text-transform: uppercase;">
                        Our Methodology
                    </div>
                    <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #0f172a; margin-bottom: 24px; line-height: 1.2;">
                        {{ $cd['approach']['title'] ?? 'Our Strategic Approach' }}
                    </h2>
                    <div style="color: #64748b; font-size: 16px; line-height: 1.8; margin-bottom: 24px;">
                        {!! nl2br(e($cd['approach']['description'] ?? '')) !!}
                    </div>
                    @if(isset($cd['approach']['description2']))
                        <div style="color: #64748b; font-size: 16px; line-height: 1.8; padding-left: 20px; border-left: 3px solid #3b82f6; background: #f8fafc; padding-top: 15px; padding-bottom: 15px; border-radius: 0 16px 16px 0;">
                            {{ $cd['approach']['description2'] }}
                        </div>
                    @endif
                </div>
                <div class="relative">
                    @php $approachImage = $service->image; @endphp
                    @if($approachImage)
                        <div style="position: relative; border-radius: 30px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);">
                            <img src="{{ asset('storage/' . $approachImage) }}" alt="{{ $service->title }}" style="width: 100%; height: auto;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 0.4), transparent);"></div>
                        </div>
                    @else
                        <div style="width: 100%; height: 500px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 30px; display: flex; align-items: center; justify-content: center; box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.25);">
                            <svg style="width: 100px; height: 100px; color: rgba(255,255,255,0.2);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                    @endif
                    {{-- Decorative --}}
                    <div style="position: absolute; -bottom: 30px; -right: 30px; width: 160px; height: 160px; background: rgba(59, 130, 246, 0.1); border-radius: 50%; blur: 40px; z-index: -1;"></div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- 4. Solutions Grid --}}
    @if(isset($cd['solutions']) && count($cd['solutions']) > 0)
        <x-service.solutions-grid 
            :title="$cd['solutions_title'] ?? 'Our Specialized Solutions'"
            :subtitle="$cd['solutions_subtitle'] ?? ''"
            :label="$cd['solutions_label'] ?? 'OUR SOLUTIONS'"
            :solutions="$cd['solutions']"
        />
    @endif

    {{-- 5. Achievements Section (Styled Premium) --}}
    @if(isset($cd['achievements']) && count($cd['achievements']) > 0)
    <section style="padding: 100px 0; background: #060b24; position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(99, 102, 241, 0.05) 1px, transparent 1px); background-size: 40px 40px; pointer-events: none;"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #fff; margin-bottom: 16px;">Our Track Record of Excellence</h2>
                <div style="width: 60px; height: 4px; background: #3b82f6; margin: 0 auto; border-radius: 2px;"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($cd['achievements'] as $achievement)
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); padding: 40px 30px; border-radius: 24px; text-align: center; backdrop-filter: blur(10px); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.borderColor='rgba(99, 102, 241, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(255,255,255,0.06)';">
                        <div style="font-size: 42px; font-weight: 900; color: #fff; margin-bottom: 10px; background: linear-gradient(135deg, #fff 0%, #94a3b8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $achievement['title'] }}</div>
                        <div class="flex justify-center gap-1 mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <svg width="14" height="14" fill="#fbbf24" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <p style="color: rgba(203, 213, 225, 0.7); font-size: 14px; font-weight: 500; line-height: 1.5;">{{ $achievement['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- 6. Testimonials --}}
    @if(isset($cd['testimonials']) && count($cd['testimonials']) > 0)
        <x-service.testimonial-slider 
            :title="$cd['testimonials_title'] ?? 'What Our Clients Say'" 
            :testimonials="$cd['testimonials']" 
        />
    @endif

    {{-- 7. Why Choose Us (Styled Premium) --}}
    @if(isset($cd['why_choose']))
    <section style="padding: 100px 0; background: #f8fafc; position: relative;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="order-2 lg:order-1">
                    @php $whyImage = $cd['why_choose_image'] ?? $service->image; @endphp
                    @if($whyImage)
                        <div style="position: relative; border-radius: 30px; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.12);">
                            <img src="{{ asset('storage/' . $whyImage) }}" alt="Why Choose Us" style="width: 100%; height: auto;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);"></div>
                        </div>
                    @else
                        <div style="width: 100%; height: 550px; background: #e2e8f0; border-radius: 30px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-handshake" style="font-size: 100px; color: #cbd5e1;"></i>
                        </div>
                    @endif
                </div>
                <div class="order-1 lg:order-2">
                    <div style="display: inline-block; padding: 8px 20px; background: #eff6ff; border: 1px solid #dbeafe; border-radius: 100px; color: #3b82f6; font-size: 13px; font-weight: 700; letter-spacing: 0.05em; margin-bottom: 24px; text-transform: uppercase;">
                        Value Proposition
                    </div>
                    <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #0f172a; margin-bottom: 24px; line-height: 1.2;">
                        {{ $cd['why_choose']['title'] ?? 'Why Partner with Devent?' }}
                    </h2>
                    <p style="color: #64748b; font-size: 16px; line-height: 1.8; margin-bottom: 36px;">
                        {{ $cd['why_choose']['description'] ?? '' }}
                    </p>
                    @if(isset($cd['why_choose_points']) && count($cd['why_choose_points']) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($cd['why_choose_points'] as $point)
                                <div style="display: flex; align-items: center; gap: 12px; background: #fff; padding: 16px; border-radius: 16px; border: 1px solid #e2e8f0; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#3b82f6'; this.style.transform='translateX(5px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateX(0)';">
                                    <div style="width: 24px; height: 24px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <svg width="14" height="14" fill="none" stroke="#16a34a" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span style="font-size: 14px; font-weight: 600; color: #334155;">{{ $point }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- 8. CTA Section 1 --}}
    <section style="padding: 100px 0; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -10%; right: -10%; width: 40%; height: 60%; background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #fff; margin-bottom: 20px;">{{ $cd['cta']['title'] ?? 'Want to Consult Our Experts?' }}</h2>
            <p style="color: rgba(203, 213, 225, 0.8); font-size: 17px; line-height: 1.7; margin-bottom: 40px;">{{ $cd['cta']['subtitle'] ?? 'Whether you are in the ideation phase or validating the concept, our expert team can provide you with the best guidance and roadmap for successful outcomes.' }}</p>
            <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 12px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: #fff; font-weight: 700; font-size: 15px; padding: 18px 40px; border-radius: 16px; text-decoration: none; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 35px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(59, 130, 246, 0.3)';">
                {{ $cd['cta']['button'] ?? 'Connect With Us Today' }}
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </section>

    {{-- 9. Process Section --}}
    @if(isset($cd['process']) && count($cd['process']) > 0)
        <x-service.process-timeline 
            :title="$cd['process_title'] ?? 'Our Development Process'" 
            :steps="$cd['process']" 
            :image="$cd['process_image'] ?? $service->image ?? ''" 
        />
    @endif

    {{-- 10. Frameworks / Tech Stack --}}
    @if(isset($cd['frameworks']) && count($cd['frameworks']) > 0)
        <x-service.tech-stack 
            :title="$cd['frameworks_title'] ?? 'Frameworks & Technologies'" 
            :tech_stack="$cd['frameworks']" 
        />
    @endif

    {{-- 11. FAQs --}}
    @if(isset($cd['faqs']) && count($cd['faqs']) > 0)
        <x-service.faq-accordion 
            :faqs="$cd['faqs']" 
            :title="'Service FAQs'" 
        />
    @endif

    {{-- 12. CTA Banner 2 (Bottom) --}}
    <section style="padding: 120px 0; background: #fff; position: relative;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 40px; padding: 80px 40px; text-align: center; position: relative; overflow: hidden; box-shadow: 0 40px 100px rgba(15, 23, 42, 0.2);">
                <div style="position: absolute; top: -50%; left: -20%; width: 60%; height: 200%; background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);"></div>
                <div style="position: relative; z-index: 1;">
                    <h2 style="font-size: clamp(1.75rem, 4vw, 3rem); font-weight: 800; color: #fff; margin-bottom: 24px; letter-spacing: -0.02em;">{{ $cd['cta2']['title'] ?? "Ready to Build Your Software Solution?" }}</h2>
                    <p style="color: rgba(203, 213, 225, 0.8); font-size: 18px; line-height: 1.7; margin-bottom: 48px; max-width: 700px; mx-auto">{{ $cd['cta2']['subtitle'] ?? 'Contact our team of expert consultants today and let\'s turn your vision into reality.' }}</p>
                    <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 12px; background: #fff; color: #0f172a; font-weight: 800; font-size: 16px; padding: 20px 48px; border-radius: 18px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 15px 40px rgba(0,0,0,0.2);" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 20px 50px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.2)';">
                        {{ $cd['cta2']['button'] ?? "Get Started Now" }}
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 13. Other Services (Tag Style - Standardized) --}}
    @if($otherServices->count() > 0)
    <section style="padding: 80px 0; background: #f8fafc; border-top: 1px solid #e2e8f0;">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 style="font-size: 24px; font-weight: 800; color: #0f172a; mb-4">Explore More Services</h2>
            <p style="color: #64748b; font-size: 15px; mb-12 max-width: 600px; mx-auto">Discover our wide range of digital transformation and development services.</p>
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($otherServices as $other)
                    <a href="{{ url('/services/' . $other->slug) }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 12px 24px; background: #fff; border: 1px solid #e2e8f0; border-radius: 100px; color: #475569; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#3b82f6'; this.style.color='#3b82f6'; this.style.boxShadow='0 10px 20px rgba(59, 130, 246, 0.08)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569'; this.style.boxShadow='none';">
                        <i class="{{ $other->icon ?? 'fa-solid fa-gear' }}" style="font-size: 12px;"></i>
                        {{ $other->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- 14. Top Blogs Section --}}
    @if(isset($latestPosts) && $latestPosts->count() > 0)
    <section style="padding: 70px 0 20px 0; background: #fff;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; margin-bottom: 12px;">Insights & Articles</h2>
                    <p style="color: #64748b; font-size: 16px;">Stay updated with the latest trends in technology and business.</p>
                </div>
                <a href="{{ url('/blog') }}" style="color: #3b82f6; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px; font-size: 15px;" onmouseover="this.style.gap='12px'" onmouseout="this.style.gap='8px'">
                    View All Articles
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($latestPosts as $post)
                    <a href="{{ url('/blog/' . $post->slug) }}" style="text-decoration: none; group" class="group">
                        <div style="position: relative; border-radius: 24px; overflow: hidden; margin-bottom: 24px; aspect-ratio: 16/10; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: contain; background: #f8fafc; transition: transform 0.5s ease;" class="group-hover:scale-110">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-newspaper" style="font-size: 40px; color: rgba(255,255,255,0.1);"></i>
                                </div>
                            @endif
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <span style="padding: 4px 12px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 11px; font-weight: 700; border-radius: 100px; text-transform: uppercase;">{{ $service->title }}</span>
                            <span style="color: #94a3b8; font-size: 12px;">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; line-height: 1.4; transition: color 0.2s ease;" class="group-hover:text-blue-600">{{ $post->title }}</h3>
                    </a>
                @endforeach
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ url('/blog') }}" style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: #fff; font-weight: 700; font-size: 15px; padding: 16px 36px; border-radius: 14px; text-decoration: none; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 35px rgba(59, 130, 246, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(59, 130, 246, 0.2)';">
                    Read All Blogs
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>
    @endif
@endsection

