@props(['title', 'subtitle' => '', 'highlights' => [], 'image' => '', 'breadcrumb' => '', 'techName' => '', 'description' => '', 'statistics' => [], 'badge' => '', 'videoUrl' => '#'])

<section class="tech-hero-section relative overflow-hidden" style="background: linear-gradient(135deg, #060b24 0%, #0a1045 40%, #111a5e 70%, #0d1247 100%); padding: 40px 0 0 0;">
    {{-- Decorative background elements --}}
    <div style="position: absolute; top: -100px; right: -100px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; top: 50%; left: 50%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(139, 92, 246, 0.04) 0%, transparent 60%); border-radius: 50%; transform: translate(-50%, -50%);"></div>
    
    {{-- Subtle grid pattern --}}
    <div style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 60px 60px; pointer-events: none;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" style="min-height: 480px;">
            {{-- Left Content --}}
            <div>
                {{-- Badge Pill --}}
                @if($badge)
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.25); border-radius: 100px; padding: 8px 20px; margin-bottom: 28px; backdrop-filter: blur(10px);">
                        <span style="font-size: 16px;">{{ substr($badge, 0, 2) }}</span>
                        <span style="color: #c4b5fd; font-size: 13px; font-weight: 600; letter-spacing: 0.02em;">{{ strlen($badge) > 2 ? substr($badge, 2) : $badge }}</span>
                    </div>
                @elseif($techName)
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.25); border-radius: 100px; padding: 8px 20px; margin-bottom: 28px; backdrop-filter: blur(10px);">
                        <span style="font-size: 16px;">⚡</span>
                        <span style="color: #c4b5fd; font-size: 13px; font-weight: 600; letter-spacing: 0.02em;">{{ $techName }} Development Excellence</span>
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
                    <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: #fff; font-weight: 700; font-size: 14px; padding: 14px 28px; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 35px rgba(99, 102, 241, 0.45)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(99, 102, 241, 0.35)';">
                        Book a Consultation
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="{{ $videoUrl }}" {{ $videoUrl !== '#' ? 'target="_blank"' : '' }} style="display: inline-flex; align-items: center; gap: 12px; text-decoration: none; color: #e2e8f0;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#e2e8f0'">
                        <span style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span style="font-size: 14px;">
                            <span style="font-weight: 700; display: block;">Watch Our Video</span>
                            <span style="font-size: 12px; color: rgba(148, 163, 184, 0.8);">See how we work</span>
                        </span>
                    </a>
                </div>
            </div>

            {{-- Right Side — Code Snippet / Image --}}
            <div class="hidden lg:block" style="position: relative;">
                @if($image)
                    <div style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.4);">
                        {{-- Code editor header --}}
                        <div style="background: #1a1f3a; padding: 12px 16px; display: flex; align-items: center; gap: 8px;">
                            <span style="width: 12px; height: 12px; border-radius: 50%; background: #ff5f56;"></span>
                            <span style="width: 12px; height: 12px; border-radius: 50%; background: #ffbd2e;"></span>
                            <span style="width: 12px; height: 12px; border-radius: 50%; background: #27ca40;"></span>
                        </div>
                        <div style="background: #0f1429; padding: 30px;">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $techName ?: $title }}" style="max-width: 100%; max-height: 320px; object-fit: contain; margin: 0 auto; display: block;">
                        </div>
                    </div>
                @else
                    {{-- Default code editor mockup --}}
                    <div style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.4);">
                        <div style="background: #1a1f3a; padding: 12px 16px; display: flex; align-items: center; gap: 8px;">
                            <span style="width: 12px; height: 12px; border-radius: 50%; background: #ff5f56;"></span>
                            <span style="width: 12px; height: 12px; border-radius: 50%; background: #ffbd2e;"></span>
                            <span style="width: 12px; height: 12px; border-radius: 50%; background: #27ca40;"></span>
                        </div>
                        <div style="background: #0f1429; padding: 30px; font-family: 'Fira Code', 'Courier New', monospace; font-size: 14px; line-height: 1.8;">
                            <div><span style="color: #c792ea;">import</span> <span style="color: #82aaff;">{{ strtolower($techName ?: 'module') }}</span></div>
                            <br>
                            <div><span style="color: #c792ea;">def</span> <span style="color: #82aaff;">success</span><span style="color: #89ddff;">()</span><span style="color: #89ddff;">:</span></div>
                            <div style="padding-left: 20px;"><span style="color: #f78c6c;">market</span> <span style="color: #89ddff;">=</span> <span style="color: #c3e88d;">"grow"</span></div>
                            <div style="padding-left: 20px;"><span style="color: #f78c6c;">business</span> <span style="color: #89ddff;">=</span> <span style="color: #c3e88d;">"success"</span></div>
                            <div style="padding-left: 20px;"><span style="color: #c792ea;">return</span> <span style="color: #f78c6c;">market</span> <span style="color: #89ddff;">+</span> <span style="color: #f78c6c;">business</span></div>
                            <br>
                            <div><span style="color: #82aaff;">print</span><span style="color: #89ddff;">(</span><span style="color: #82aaff;">success</span><span style="color: #89ddff;">())</span></div>
                            <br>
                            <div><span style="color: #546e7a;"># We build your success</span></div>
                        </div>
                    </div>
                @endif

                {{-- Floating decorative elements --}}
                <div style="position: absolute; top: -20px; right: -20px; width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4); animation: float 3s ease-in-out infinite;">
                    <svg width="28" height="28" fill="none" stroke="#fff" viewBox="0 0 24 24" stroke-width="2"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6"/></svg>
                </div>
                <div style="position: absolute; bottom: 40px; right: -30px; width: 50px; height: 50px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 14px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4); animation: float 3s ease-in-out infinite 1s;">
                    <svg width="22" height="22" fill="none" stroke="#fff" viewBox="0 0 24 24" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Bar --}}
    @if(count($statistics) > 0)
        <div style="margin-top: 60px; background: rgba(255,255,255,0.03); border-top: 1px solid rgba(255,255,255,0.06); backdrop-filter: blur(10px);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" style="padding: 36px 0;">
                    @php
                        $statColors = [
                            ['bg' => 'rgba(99, 102, 241, 0.12)', 'text' => '#818cf8', 'icon' => 'fa-solid fa-briefcase'],
                            ['bg' => 'rgba(59, 130, 246, 0.12)', 'text' => '#60a5fa', 'icon' => 'fa-solid fa-users'],
                            ['bg' => 'rgba(16, 185, 129, 0.12)', 'text' => '#34d399', 'icon' => 'fa-solid fa-thumbs-up'],
                            ['bg' => 'rgba(168, 85, 247, 0.12)', 'text' => '#c084fc', 'icon' => 'fa-solid fa-globe'],
                        ];
                    @endphp
                    @foreach($statistics as $index => $stat)
                        @php $color = $statColors[$index % 4]; @endphp
                        <div style="display: flex; align-items: center; gap: 16px; padding: 8px 0;">
                            <div style="width: 48px; height: 48px; background: {{ $color['bg'] }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="{{ $color['icon'] }}" style="color: {{ $color['text'] }}; font-size: 18px;"></i>
                            </div>
                            <div>
                                <div style="font-size: clamp(1.2rem, 2vw, 1.75rem); font-weight: 800; color: #fff; line-height: 1.1;">{{ $stat['title'] ?? $stat['value'] ?? '' }}</div>
                                <div style="font-size: 12px; color: rgba(148, 163, 184, 0.7); font-weight: 500; line-height: 1.4;">{{ $stat['description'] ?? $stat['label'] ?? '' }}</div>
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
