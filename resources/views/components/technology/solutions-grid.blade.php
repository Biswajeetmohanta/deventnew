@props(['title', 'subtitle' => '', 'solutions' => [], 'description' => '', 'label' => 'WHAT WE DO'])

@if(count($solutions) > 0)
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header: Label + Title left, Description right --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8" style="margin-bottom: 50px;">
            <div>
                <span style="color: #6366f1; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 12px;">{{ $label }}</span>
                <h2 style="font-size: clamp(1.75rem, 3vw, 2.5rem); font-weight: 800; color: #0f172a; line-height: 1.2; letter-spacing: -0.02em;">{{ $title }}</h2>
            </div>
            @if($subtitle)
                <div style="display: flex; align-items: center;">
                    <p style="color: #64748b; font-size: 15px; line-height: 1.7;">{{ $subtitle }}</p>
                </div>
            @endif
        </div>

        {{-- Solutions Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $cardColors = [
                    ['bg' => '#f0f4ff', 'icon_bg' => 'rgba(99, 102, 241, 0.1)', 'icon_color' => '#6366f1', 'border' => 'rgba(99, 102, 241, 0.1)'],
                    ['bg' => '#f0f9ff', 'icon_bg' => 'rgba(59, 130, 246, 0.1)', 'icon_color' => '#3b82f6', 'border' => 'rgba(59, 130, 246, 0.1)'],
                    ['bg' => '#f0fdf4', 'icon_bg' => 'rgba(16, 185, 129, 0.1)', 'icon_color' => '#10b981', 'border' => 'rgba(16, 185, 129, 0.1)'],
                    ['bg' => '#fdf4ff', 'icon_bg' => 'rgba(168, 85, 247, 0.1)', 'icon_color' => '#a855f7', 'border' => 'rgba(168, 85, 247, 0.1)'],
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
                <div class="premium-card group">
                    <div class="premium-card-icon" style="background: {{ $color['icon_bg'] }};">
                        <i class="{{ $solution['icon'] ?? $cardIcons[$index % count($cardIcons)] }}" style="color: {{ $color['icon_color'] }}; font-size: 20px;"></i>
                    </div>
                    <h3 class="premium-card-title">{{ $solution['title'] ?? '' }}</h3>
                    <p class="premium-card-text">{{ $solution['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
