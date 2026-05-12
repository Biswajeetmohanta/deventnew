@props(['testimonials' => []])

@if(count($testimonials) > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">What Our Clients Say</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 hover:border-amber-100 hover:shadow-xl transition-all duration-300">
                    <div class="text-amber-500 mb-4">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">"{{ $testimonial['description'] ?? '' }}"</p>
                    <div>
                        <h4 class="text-lg font-bold text-slate-900">{{ $testimonial['title'] ?? '' }}</h4>
                        <p class="text-xs text-slate-500">{{ $testimonial['subtitle'] ?? 'Client' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
