@props(['title', 'frameworks' => []])

@if(count($frameworks) > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 text-center mb-16">{{ $title }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($frameworks as $framework)
                <div class="bg-white p-6 rounded-2xl border border-slate-100 hover:border-amber-100 hover:shadow-xl transition-all duration-300 group text-center">
                    <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mb-4 mx-auto group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $framework['title'] }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">{{ $framework['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
