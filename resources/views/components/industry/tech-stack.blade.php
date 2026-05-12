@props(['title', 'tech_stack' => []])

@if(count($tech_stack) > 0)
<section style="padding: 80px 0; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 50px;">{{ $title }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($tech_stack as $tool)
                <div style="background: #f8fafc; padding: 24px 20px; border-radius: 14px; border: 1px solid #e2e8f0; text-align: center; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#3b82f6'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)';">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">{{ $tool['title'] ?? '' }}</h3>
                    <p style="font-size: 12px; color: #64748b;">{{ $tool['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
