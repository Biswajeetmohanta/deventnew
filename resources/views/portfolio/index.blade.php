@extends('layouts.app')

@section('title', 'Our Portfolio | Devent Technology')

@section('content')
    <!-- Portfolio Hero -->
    <section class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-bold text-slate-950 mb-6 tracking-tight">Our <span class="text-blue-600">Work</span></h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Explore our diverse portfolio of successful projects across various industries.</p>
        </div>
    </section>

    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($portfolios as $portfolio)
                    <div class="group relative overflow-hidden rounded-[40px] bg-white shadow-lg hover:shadow-2xl transition-all duration-700">
                        <div class="aspect-w-16 aspect-h-12 overflow-hidden">
                             @if($portfolio->image)
                                <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                             @else
                                <div class="w-full h-64 bg-slate-200"></div>
                             @endif
                        </div>
                        <div class="p-8">
                            <div class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-3">{{ $portfolio->client }}</div>
                            <h3 class="text-2xl font-bold text-slate-950 mb-4 group-hover:text-blue-600 transition-colors">{{ $portfolio->title }}</h3>
                            <a href="{{ url('/portfolio/' . $portfolio->slug) }}" class="inline-flex items-center text-sm font-bold text-slate-900 group-hover:text-blue-600">
                                View Case Study <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h16"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-16">
                {{ $portfolios->links() }}
            </div>
        </div>
    </section>
@endsection
