@props(['faqs' => []])

@if(count($faqs) > 0)
<section class="py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">Frequently Asked Questions</h2>
        <div class="space-y-4">
            @foreach($faqs as $index => $faq)
                <details class="group bg-white rounded-2xl border border-slate-100 hover:border-amber-100 transition-all [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center p-6 cursor-pointer">
                        <span class="text-xl font-bold text-amber-500 mr-6 min-w-[40px]">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h4 class="text-lg font-bold text-slate-900 flex-1 pr-4">{{ $faq['title'] }}</h4>
                        <span class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0 group-open:bg-amber-600 transition-all">
                            <svg class="w-4 h-4 text-amber-600 group-open:text-white transition-colors group-open:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 ml-[64px] text-slate-600 text-sm leading-relaxed">
                        {{ $faq['description'] }}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif
