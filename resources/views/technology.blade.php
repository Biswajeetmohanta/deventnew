@extends('layouts.app')

@section('title', 'Technologies We Use | Devent Technology')

@section('content')
    <!-- Hero Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-0 w-1/2 h-full bg-blue-50 rounded-r-[100px] transform -translate-x-1/4 skew-x-12 opacity-50"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-8 tracking-tighter leading-tight">
                {!! $settings['tech_hero_title'] ?? 'Our <span style="color: #0052FF;">Tech Stack</span>' !!}
            </h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium">
                {{ $settings['tech_hero_subtitle'] ?? 'We leverage the latest and most powerful technologies to build scalable, secure, and high-performance solutions for our clients.' }}
            </p>
        </div>
    </section>

    <!-- Technologies Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @forelse($technologies as $category => $items)
                <div class="mb-20 last:mb-0">
                    <div class="flex items-center mb-12">
                        <h2 class="text-2xl font-black text-slate-950 tracking-tight mr-6">{{ $category }}</h2>
                        <div class="h-px bg-slate-100 flex-1"></div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                        @foreach($items as $tech)
                            <a href="{{ url('/technology/' . $tech->slug) }}" class="premium-card group text-center block">
                                <div class="premium-card-icon mx-auto transition-all duration-500 transform group-hover:scale-110">
                                    @if($tech->logo)
                                        <img src="{{ Storage::url($tech->logo) }}" alt="{{ $tech->name }}" class="h-10 w-auto object-contain">
                                    @else
                                        <i class="fa-solid fa-code text-3xl text-slate-300"></i>
                                    @endif
                                </div>
                                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">{{ $tech->name }}</h3>
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <!-- Placeholder tech icons if empty -->
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                    @foreach(['Laravel', 'React', 'Node.js', 'Python', 'AWS', 'MySQL', 'Tailwind', 'Docker', 'Redis', 'Vue.js', 'PostgreSQL', 'Flutter'] as $item)
                        <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 text-center opacity-40">
                             <div class="h-12 flex items-center justify-center mb-4">
                                <i class="fa-solid fa-microchip text-3xl text-slate-300"></i>
                             </div>
                             <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $item }}</span>
                        </div>
                    @endforeach
                </div>
            @endforelse
        </div>
    </section>

    <!-- Tech CTA -->
    <section class="pb-48 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-blue-600 rounded-[50px] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl shadow-blue-200">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-10 tracking-tighter">
                        {{ $settings['tech_cta_title'] ?? 'Need a custom tech solution?' }}
                    </h2>
                    <p class="text-blue-100 text-lg mb-12 max-w-2xl mx-auto font-medium">
                        {{ $settings['tech_cta_subtitle'] ?? 'Our expert developers are ready to help you choose the right stack for your next big project.' }}
                    </p>
                    <a href="{{ url('/contact') }}" class="premium-cta-btn premium-cta-btn-white px-10 py-5">
                        <span class="btn-text">Let's Talk Tech</span>
                        <i class="fa-solid fa-bolt ml-3 relative z-10"></i>
                    </a>
                </div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-700 rounded-full blur-[150px] opacity-20"></div>
            </div>
        </div>
    </section>
@endsection
