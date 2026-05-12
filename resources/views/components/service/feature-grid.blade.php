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
                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px 28px; transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(0,0,0,0.06);" onmouseover="this.style.borderColor='#bfdbfe'; this.style.boxShadow='0 16px 40px rgba(59, 130, 246, 0.12)'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'; this.style.transform='translateY(0)';">
                    <div style="width: 52px; height: 52px; background: #f0f4ff; border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <i class="{{ $featureIcons[$index % count($featureIcons)] }}" style="color: #6366f1; font-size: 22px;"></i>
                    </div>
                    <h3 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">{{ $feature['title'] ?? '' }}</h3>
                    <p style="font-size: 13px; color: #64748b; line-height: 1.7;">{{ $feature['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
