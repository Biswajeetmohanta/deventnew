@props(['title', 'subtitle' => '', 'highlights' => [], 'image' => '', 'breadcrumb' => '', 'statistics' => [], 'badge' => '', 'videoUrl' => '#'])

<section class="industry-hero-section relative overflow-hidden" style="background: linear-gradient(135deg, #060b24 0%, #0a1045 40%, #111a5e 70%, #0d1247 100%); padding: 40px 0 0 0;">
    {{-- Decorative background elements --}}
    <div style="position: absolute; top: -100px; right: -100px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%); border-radius: 50%;"></div>
    
    {{-- Subtle grid pattern --}}
    <div style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 60px 60px; pointer-events: none;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" style="min-height: 480px;">
            {{-- Left Content --}}
            <div>
                {{-- Badge Pill --}}
                @if($badge)
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.25); border-radius: 100px; padding: 8px 20px; margin-bottom: 28px; backdrop-filter: blur(10px);">
                        <span style="color: #c4b5fd; font-size: 13px; font-weight: 600; letter-spacing: 0.02em;">{{ $badge }}</span>
                    </div>
                @endif

                {{-- Main Heading --}}
                <h1 style="font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 800; color: #ffffff; line-height: 1.15; margin-bottom: 20px; letter-spacing: -0.02em;">
                    {!! $title !!}
                </h1>

                {{-- Description --}}
                @if($subtitle)
                    <p style="color: rgba(203, 213, 225, 0.85); font-size: 16px; line-height: 1.75; margin-bottom: 36px; max-width: 520px;">
                        {{ $subtitle }}
                    </p>
                @endif

                {{-- CTA Buttons --}}
                <div style="display: flex; align-items: center; gap: 28px; flex-wrap: wrap;">
                    <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: #fff; font-weight: 700; font-size: 14px; padding: 14px 28px; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
                        Get Started
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="{{ $videoUrl }}" {{ $videoUrl !== '#' ? 'target="_blank"' : '' }} style="display: inline-flex; align-items: center; gap: 12px; text-decoration: none; color: #e2e8f0;">
                        <span style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span style="font-size: 14px; font-weight: 700;">Watch Video</span>
                    </a>
                </div>

                {{-- Breadcrumb --}}
                <nav style="display: flex; gap: 8px; color: rgba(148, 163, 184, 0.7); font-size: 13px; margin-top: 40px;">
                    <a href="{{ url('/') }}" style="color: rgba(148, 163, 184, 0.7); text-decoration: none;">Home</a>
                    <span>/</span>
                    <a href="{{ url('/industry') }}" style="color: rgba(148, 163, 184, 0.7); text-decoration: none;">Industry</a>
                    <span>/</span>
                    <span style="color: #818cf8;">{{ $breadcrumb ?: $title }}</span>
                </nav>
            </div>

            {{-- Right Side --}}
            <div class="hidden lg:block" style="position: relative;">
                @if($image)
                    <div style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.4);">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $title }}" style="width: 100%; height: auto; max-height: 400px; object-fit: contain; background: rgba(255,255,255,0.05);">
                    </div>
                @else
                    <div style="width: 100%; height: 400px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-layer-group text-6xl text-slate-700"></i>
                    </div>
                @endif

                {{-- Floating decorative elements --}}
                <div style="position: absolute; top: -20px; right: -20px; width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4); animation: float 3s ease-in-out infinite;">
                    <svg width="28" height="28" fill="none" stroke="#fff" viewBox="0 0 24 24" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Bar --}}
    @if(count($statistics) > 0)
        <div style="margin-top: 60px; background: rgba(255,255,255,0.03); border-top: 1px solid rgba(255,255,255,0.06); backdrop-filter: blur(10px);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" style="padding: 36px 0;">
                    @foreach($statistics as $index => $stat)
                        <div style="display: flex; align-items: center; gap: 16px;">
                            <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.05); border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="{{ $stat['icon'] ?? 'fa-solid fa-chart-line' }}" style="color: #818cf8; font-size: 18px;"></i>
                            </div>
                            <div>
                                <div style="font-size: clamp(1.2rem, 2vw, 1.75rem); font-weight: 800; color: #fff; line-height: 1.1;">{{ $stat['title'] ?? $stat['value'] ?? '' }}</div>
                                <div style="font-size: 12px; color: rgba(148, 163, 184, 0.7); font-weight: 500;">{{ $stat['description'] ?? $stat['label'] ?? '' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</section>
