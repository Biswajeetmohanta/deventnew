@props(['title' => 'Client Success Stories', 'testimonials' => []])

@if(count($testimonials) > 0)
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 50px;">{{ $title }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $test)
                <div style="background: #fff; padding: 32px 28px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.06); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)';">
                    <div style="display: flex; gap: 4px; margin-bottom: 16px;">
                        @for($i=0; $i<5; $i++)
                            <i class="fa-solid fa-star" style="color: #f59e0b; font-size: 12px;"></i>
                        @endfor
                    </div>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 24px; font-style: italic;">"{{ $test['description'] ?? $test['desc'] ?? '' }}"</p>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #3b82f6; font-size: 14px;">
                            {{ substr($test['title'] ?? $test['name'] ?? 'C', 0, 1) }}
                        </div>
                        <div>
                            <h4 style="font-size: 16px; font-weight: 700; color: #0f172a;">{{ $test['title'] ?? $test['name'] ?? '' }}</h4>
                            <p style="font-size: 12px; color: #94a3b8;">{{ $test['subtitle'] ?? 'Client' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
