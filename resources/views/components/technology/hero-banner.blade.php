@props(['title', 'subtitle' => '', 'highlights' => [], 'image' => '', 'breadcrumb' => ''])

<section class="bg-slate-950 py-20 lg:py-28 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">{{ $title }}</h1>
                @if($subtitle)
                    <p class="text-lg text-slate-300 mb-8 leading-relaxed">{{ $subtitle }}</p>
                @endif

                @if(count($highlights) > 0)
                    <ul class="space-y-3 mb-10">
                        @foreach($highlights as $highlight)
                            <li class="flex items-center text-slate-300">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3 flex-shrink-0"></span>
                                {{ $highlight }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <a href="{{ url('/contact') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-blue-600/20">
                    Book a Consultation
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            <div class="hidden lg:block">
                @if($image)
                    <img src="{{ Storage::url($image) }}" alt="{{ $title }}" class="w-full h-[400px] object-cover rounded-3xl shadow-2xl">
                @else
                    <div class="w-full h-[400px] bg-slate-800 rounded-3xl flex items-center justify-center">
                        <svg class="w-32 h-32 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full blur-[150px] opacity-5"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-600 rounded-full blur-[120px] opacity-5"></div>

    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mt-12">
        <nav class="flex space-x-2 text-slate-500 text-sm">
            <a href="{{ url('/') }}" class="hover:text-blue-400 transition-colors">Home</a>
            <span>/</span>
            <a href="{{ url('/technologies') }}" class="hover:text-blue-400 transition-colors">Technologies</a>
            <span>/</span>
            <span class="text-blue-400">{{ $breadcrumb ?: $title }}</span>
        </nav>
    </div>
</section>
