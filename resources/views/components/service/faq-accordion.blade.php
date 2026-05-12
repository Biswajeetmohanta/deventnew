@props(['title' => 'Frequently Asked Questions', 'faqs' => []])

@if(count($faqs) > 0)
<section style="padding: 80px 0; background: #fff;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a;">{{ $title }}</h2>
        </div>

        <div style="display: flex; flex-direction: column; gap: 16px;">
            @foreach($faqs as $index => $faq)
                <details class="group" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 10px 30px rgba(59, 130, 246, 0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                    <summary style="display: flex; align-items: center; justify-content: space-between; padding: 24px; cursor: pointer; list-style: none;">
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <span style="font-size: 14px; font-weight: 700; color: #3b82f6; opacity: 0.5;">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a;">{{ $faq['title'] ?? $faq['question'] ?? '' }}</h3>
                        </div>
                        <div style="width: 32px; height: 32px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;" class="group-open:rotate-180 group-open:bg-blue-600">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3" class="group-open:text-white"><path d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </summary>
                    <div style="padding: 0 24px 24px 60px;">
                        <p style="font-size: 14px; color: #64748b; line-height: 1.7;">{{ $faq['description'] ?? $faq['answer'] ?? '' }}</p>
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    details summary::-webkit-details-marker {
        display: none;
    }
</style>
