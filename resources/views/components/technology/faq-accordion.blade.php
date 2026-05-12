@props(['faqs' => [], 'title' => 'Frequently Asked Questions'])

@if(count($faqs) > 0)
<section style="padding: 80px 0; background: #fff;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 50px; letter-spacing: -0.02em;">{{ $title }}</h2>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            @foreach($faqs as $index => $faq)
                <details class="group" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; transition: all 0.3s ease; overflow: hidden;" onmouseover="this.style.borderColor='#bfdbfe'" onmouseout="this.style.borderColor='#e2e8f0'">
                    <summary style="display: flex; align-items: center; padding: 20px 24px; cursor: pointer; list-style: none; -webkit-appearance: none;">
                        <span style="font-size: 18px; font-weight: 800; color: #3b82f6; min-width: 44px; flex-shrink: 0;">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; flex: 1; padding-right: 16px; line-height: 1.4;">{{ $faq['title'] ?? $faq['question'] ?? '' }}</h4>
                        <span style="width: 32px; height: 32px; border-radius: 50%; background: #f0f4ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.3s ease;">
                            <svg class="faq-icon" style="width: 16px; height: 16px; color: #3b82f6; transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </span>
                    </summary>
                    <div style="padding: 0 24px 20px 68px; color: #64748b; font-size: 14px; line-height: 1.7;">
                        {{ $faq['description'] ?? $faq['answer'] ?? '' }}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
<style>
    details[open] summary span:last-child { background: #3b82f6 !important; }
    details[open] summary span:last-child svg { color: #fff !important; transform: rotate(45deg); }
    details summary::-webkit-details-marker { display: none; }
</style>
@endif
