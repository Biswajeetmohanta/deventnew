@extends('layouts.app')

@section('title', $portfolio->title . ' | Case Study')

@section('content')
    <!-- Project Hero -->
    <section class="relative h-[70vh] flex items-center overflow-hidden bg-slate-900">
        @if($portfolio->image)
            <img src="{{ Storage::url($portfolio->image) }}" class="absolute inset-0 w-full h-full object-cover opacity-40" alt="{{ $portfolio->title }}">
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight">{{ $portfolio->title }}</h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto">{{ $portfolio->client }}</p>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 to-slate-900"></div>
    </section>

    <!-- Project Details -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold mb-8">Project Overview</h2>
                    <div class="prose prose-lg max-w-none text-slate-600">
                        {!! $portfolio->description !!}
                    </div>
                    
                    @if($portfolio->gallery)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16">
                            @foreach($portfolio->gallery as $img)
                                <img src="{{ Storage::url($img) }}" class="rounded-3xl shadow-xl hover:scale-105 transition-transform duration-500" alt="Project image">
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <div class="lg:col-span-1">
                    <div class="bg-slate-50 p-10 rounded-[40px] sticky top-32">
                        <div class="mb-10">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Client</h4>
                            <p class="text-xl font-bold text-slate-950">{{ $portfolio->client }}</p>
                        </div>
                        
                        @if($portfolio->link)
                            <div class="mb-10">
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Live Link</h4>
                                <a href="{{ $portfolio->link }}" target="_blank" class="text-blue-600 font-bold hover:underline break-words">
                                    {{ $portfolio->link }}
                                </a>
                            </div>
                        @endif
                        
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Technologies</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($portfolio->technologies as $tech)
                                    <span class="px-4 py-2 bg-white border border-slate-200 rounded-full text-sm font-semibold text-slate-700 flex items-center gap-2">
                                        @if($tech->logo)
                                            <img src="{{ Storage::url($tech->logo) }}" class="w-5 h-5 object-contain" alt="{{ $tech->name }}" onerror="this.style.display='none'">
                                        @endif
                                        {{ $tech->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
