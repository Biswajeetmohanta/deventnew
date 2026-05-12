@props(['title', 'subtitle' => '', 'steps' => [], 'image' => ''])

@if(count($steps) > 0)
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-lg text-slate-600 max-w-3xl mx-auto leading-relaxed">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div>
                @if($image)
                    <img src="{{ Storage::url($image) }}" alt="Process" class="w-full h-[450px] object-cover rounded-3xl shadow-lg sticky top-32">
                @else
                    <div class="w-full h-[450px] bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center sticky top-32">
                        <svg class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                @endif
            </div>
            <div class="space-y-4">
                @foreach($steps as $index => $step)
                    <div class="bg-white border border-slate-100 rounded-2xl p-6 hover:shadow-lg hover:border-blue-100 transition-all duration-300 flex gap-4 items-start">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold flex-shrink-0 mt-1">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-900 mb-2">{{ $step['title'] }}</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
