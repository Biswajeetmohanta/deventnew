@props(['title', 'subtitle' => '', 'solutions' => [], 'label' => 'OUR SOLUTIONS'])

@if(count($solutions) > 0)
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8" style="margin-bottom: 50px;">
            <div>
                <span style="color: #6366f1; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 12px;">{{ $label }}</span>
                <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #0f172a; line-height: 1.2; letter-spacing: -0.02em;">{{ $title }}</h2>
            </div>
            @if($subtitle)
                <div style="display: flex; align-items: center;">
                    <p style="color: #64748b; font-size: 15px; line-height: 1.7; max-width: 500px;">{{ $subtitle }}</p>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $cardColors = [
                    ['icon_bg' => 'rgba(99, 102, 241, 0.1)', 'icon_color' => '#6366f1'],
                    ['icon_bg' => 'rgba(59, 130, 246, 0.1)', 'icon_color' => '#3b82f6'],
                    ['icon_bg' => 'rgba(16, 185, 129, 0.1)', 'icon_color' => '#10b981'],
                    ['icon_bg' => 'rgba(168, 85, 247, 0.1)', 'icon_color' => '#a855f7'],
                ];
                $cardIcons = [
                    'fa-solid fa-globe',
                    'fa-solid fa-mobile-screen',
                    'fa-solid fa-database',
                    'fa-solid fa-brain',
                    'fa-solid fa-code',
                    'fa-solid fa-server',
                    'fa-solid fa-shield-halved',
                    'fa-solid fa-chart-line',
                ];
            @endphp
            @foreach($solutions as $index => $solution)
                @php $color = $cardColors[$index % 4]; @endphp
                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 28px 24px; transition: all 0.3s ease; cursor: default; box-shadow: 0 4px 16px rgba(0,0,0,0.06);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 40px rgba(0,0,0,0.12)'; this.style.borderColor='{{ $color['icon_color'] }}';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'; this.style.borderColor='#e2e8f0';">
                    <div style="width: 48px; height: 48px; background: {{ $color['icon_bg'] }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                        <i class="{{ $cardIcons[$index % count($cardIcons)] }}" style="color: {{ $color['icon_color'] }}; font-size: 20px;"></i>
                    </div>
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px; line-height: 1.3;">{{ $solution['title'] }}</h3>
                    <p style="font-size: 13px; color: #64748b; line-height: 1.6;">{{ $solution['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
