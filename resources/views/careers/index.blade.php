@extends('layouts.app')

@section('title', 'Careers | Join Our Team')

@section('content')
    <section class="py-24 bg-slate-950 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-8 tracking-tighter">Join the <span class="text-blue-500">Revolution</span>.</h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto mb-12">We're always looking for talented individuals who are passionate about technology and innovation.</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8">
                @forelse($careers as $career)
                    <div class="group p-8 md:p-12 bg-slate-50 rounded-[40px] border border-slate-100 hover:bg-white hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-8 md:mb-0">
                            <h3 class="text-3xl font-bold text-slate-950 mb-4">{{ $career->job_title }}</h3>
                            <div class="flex flex-wrap gap-4 text-slate-500 font-semibold text-sm">
                                <span class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> Remote / Office</span>
                                <span class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Full Time</span>
                            </div>
                        </div>
                        <a href="{{ url('/careers/' . $career->id) }}" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200">
                            View Details
                        </a>
                    </div>
                @empty
                    <div class="text-center py-20 bg-slate-50 rounded-[40px] border border-dashed border-slate-200">
                        <h4 class="text-2xl font-bold text-slate-400">No open positions at the moment.</h4>
                        <p class="text-slate-500 mt-2">Check back later or send us your CV at careers@deventtechnology.com</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
