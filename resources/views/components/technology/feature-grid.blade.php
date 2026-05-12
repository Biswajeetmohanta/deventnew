@props(['title', 'features' => []])

@if(count($features) > 0)
<section style="padding: 80px 0; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div style="margin-bottom: 50px;">
            <div style="width: 40px; height: 3px; background: #3b82f6; border-radius: 2px; margin-bottom: 20px;"></div>
            <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; line-height: 1.2; letter-spacing: -0.02em;">{{ $title }}</h2>
        </div>

        {{-- Features Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $featureIcons = [
                    'fa-solid fa-window-restore',
                    'fa-solid fa-plug',
                    'fa-solid fa-cart-shopping',
                    'fa-solid fa-palette',
                    'fa-solid fa-gauge-high',
                    'fa-solid fa-cloud',
                    'fa-solid fa-lock',
                    'fa-solid fa-rocket',
                    'fa-solid fa-gears',
                ];
            @endphp
            @foreach($features as $index => $feature)
                <div class="premium-card group">
                    <div class="premium-card-icon" style="background: #f0f4ff;">
                        <i class="{{ $feature['icon'] ?? $featureIcons[$index % count($featureIcons)] }}" style="color: #6366f1; font-size: 22px;"></i>
                    </div>
                    <h3 class="premium-card-title">{{ $feature['title'] ?? '' }}</h3>
                    <p class="premium-card-text">{{ $feature['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
