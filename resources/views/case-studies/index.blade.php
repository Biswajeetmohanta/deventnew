@extends('layouts.app')

@section('title', 'Case Studies | Devent Technology')

@section('content')
    <!-- Case Studies Hero Section -->
    <section class="relative min-h-[40vh] flex items-center overflow-hidden py-20 bg-slate-950">
        <!-- Background Gradient / Elements -->
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-blue-950 via-slate-950 to-purple-950 opacity-90"></div>
        <div class="absolute inset-0 z-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 24px 24px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20 mb-6 uppercase tracking-wider">
                <i class="fa-solid fa-laptop-code"></i> Success Stories
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-white mb-6 tracking-tight leading-none">
                Our <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400">Case Studies</span>
            </h1>
            <p class="text-base sm:text-lg text-slate-400 max-w-2xl mx-auto font-medium">
                Explore how Devent Technology builds custom software, web platforms, and compliant digital infrastructures that power leading organizations globally.
            </p>
        </div>
    </section>

    <!-- Case Studies Filters & Grid -->
    <section class="py-16 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dynamic Filters -->
            <div class="mb-12 flex flex-col gap-6">
                <!-- Industry Filters -->
                <div>
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3"><i class="fa-solid fa-building mr-1"></i> Filter by Industry</h4>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('case-studies.index', array_merge(request()->query(), ['industry' => null])) }}" 
                           class="px-4 py-2 rounded-xl text-xs font-bold border transition-all duration-300 {{ !request('industry') ? 'text-white shadow-lg shadow-blue-600/15' : 'bg-white border-slate-200 text-slate-600 hover:border-slate-300' }}"
                           {!! !request('industry') ? 'style="background-color: #2563eb !important; border-color: #2563eb !important; color: white !important;"' : '' !!}>
                            All Industries
                        </a>
                        @foreach($industries as $ind)
                            <a href="{{ route('case-studies.index', array_merge(request()->query(), ['industry' => $ind->slug])) }}" 
                               class="px-4 py-2 rounded-xl text-xs font-bold border transition-all duration-300 {{ (request()->filled('industry') && request('industry') === $ind->slug) ? 'text-white shadow-lg shadow-blue-600/15' : 'bg-white border-slate-200 text-slate-600 hover:border-slate-300' }}"
                               {!! (request()->filled('industry') && request('industry') === $ind->slug) ? 'style="background-color: #2563eb !important; border-color: #2563eb !important; color: white !important;"' : '' !!}>
                                {{ $ind->title }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Technology Filters -->
                <div>
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3"><i class="fa-solid fa-code mr-1"></i> Filter by Tech Stack</h4>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('case-studies.index', array_merge(request()->query(), ['technology' => null])) }}" 
                           class="px-4 py-2 rounded-xl text-xs font-bold border transition-all duration-300 {{ !request('technology') ? 'text-white shadow-lg shadow-purple-600/15' : 'bg-white border-slate-200 text-slate-600 hover:border-slate-300' }}"
                           {!! !request('technology') ? 'style="background-color: #8b5cf6 !important; border-color: #8b5cf6 !important; color: white !important;"' : '' !!}>
                            All Tech
                        </a>
                        @foreach($technologies as $tech)
                            <a href="{{ route('case-studies.index', array_merge(request()->query(), ['technology' => $tech->slug])) }}" 
                               class="px-4 py-2 rounded-xl text-xs font-bold border transition-all duration-300 {{ (request()->filled('technology') && request('technology') === $tech->slug) ? 'text-white shadow-lg shadow-purple-600/15' : 'bg-white border-slate-200 text-slate-600 hover:border-slate-300' }}"
                               {!! (request()->filled('technology') && request('technology') === $tech->slug) ? 'style="background-color: #8b5cf6 !important; border-color: #8b5cf6 !important; color: white !important;"' : '' !!}>
                                {{ $tech->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Case Studies Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($caseStudies as $caseStudy)
                    <div class="premium-card group overflow-hidden bg-white hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full" style="padding: 0 !important;">
                        <div>
                            <!-- Card Image -->
                            <div class="h-56 overflow-hidden relative">
                                @if($caseStudy->image)
                                    <img src="{{ Storage::url($caseStudy->image) }}" alt="{{ $caseStudy->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-laptop-code text-4xl"></i>
                                    </div>
                                @endif
                                
                                @if($caseStudy->industry)
                                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-slate-800 px-3 py-1 rounded-lg text-[10px] font-extrabold uppercase tracking-wider shadow border border-slate-200/20">
                                        {{ $caseStudy->industry->title }}
                                    </span>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="p-8">
                                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-blue-600 mb-2 block">
                                    {{ $caseStudy->client ?? 'Featured Client' }}
                                </span>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                                    {{ $caseStudy->title }}
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                                    {{ \Illuminate\Support\Str::limit($caseStudy->description, 130) }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-8 pt-0 mt-auto">
                            <!-- Technologies List -->
                            @if($caseStudy->technologies->isNotEmpty())
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    @foreach($caseStudy->technologies->take(4) as $tech)
                                        <span class="bg-slate-50 text-slate-600 px-2 py-0.5 rounded text-[10px] font-bold border border-slate-100">
                                            {{ $tech->name }}
                                        </span>
                                    @endforeach
                                    @if($caseStudy->technologies->count() > 4)
                                        <span class="bg-slate-50 text-slate-400 px-2 py-0.5 rounded text-[10px] font-bold border border-slate-100">
                                            +{{ $caseStudy->technologies->count() - 4 }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <div class="border-t border-slate-100 pt-4 flex justify-between items-center">
                                <a href="{{ url('/case-studies/' . $caseStudy->slug) }}" class="text-sm font-bold flex items-center text-blue-600 hover:text-blue-700">
                                    View Full Case Study <svg class="ml-2 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h16"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-100 shadow-sm">
                        <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-blue-100">
                            <i class="fa-solid fa-folder-open text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 mb-1">No Case Studies Found</h4>
                        <p class="text-slate-500 text-sm max-w-md mx-auto">
                            Try adjusting your industry or technology filters, or check back later.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($caseStudies->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $caseStudies->appends(request()->query())->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
