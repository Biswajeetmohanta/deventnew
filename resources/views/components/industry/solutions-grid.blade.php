@props(['title', 'subtitle' => '', 'solutions' => []])

@if(count($solutions) > 0)
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($solutions as $solution)
                <div class="bg-white p-8 rounded-2xl border border-slate-100 hover:border-amber-100 hover:shadow-xl transition-all duration-300 group flex gap-6">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $solution['title'] }}</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $solution['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
