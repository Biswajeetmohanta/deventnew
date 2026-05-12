@props(['title', 'features' => []])

@if(count($features) > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $title }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($features as $feature)
                <div class="bg-white p-8 rounded-2xl border border-slate-100 hover:border-blue-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
