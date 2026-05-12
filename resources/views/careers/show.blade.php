@extends('layouts.app')

@section('title', $career->job_title . ' | Careers')

@section('content')
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <a href="{{ url('/careers') }}" class="text-blue-600 font-bold flex items-center mb-8 hover:gap-2 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Back to Careers
                </a>
                <h1 class="text-4xl md:text-6xl font-bold text-slate-950 mb-6">{{ $career->job_title }}</h1>
                <div class="flex space-x-6 text-slate-500 font-semibold uppercase text-xs tracking-widest">
                    <span>Posted {{ $career->created_at->diffForHumans() }}</span>
                    @if($career->deadline)
                        <span>Deadline: {{ $career->deadline->format('M d, Y') }}</span>
                    @endif
                </div>
            </div>

            <div class="space-y-16">
                <div>
                    <h3 class="text-2xl font-bold text-slate-950 mb-6">Job Description</h3>
                    <div class="prose prose-lg max-w-none text-slate-600">
                        {!! $career->description !!}
                    </div>
                </div>

                @if($career->requirements)
                    <div>
                        <h3 class="text-2xl font-bold text-slate-950 mb-6">Requirements</h3>
                        <div class="prose prose-lg max-w-none text-slate-600">
                            {!! $career->requirements !!}
                        </div>
                    </div>
                @endif

                @if($career->benefits)
                    <div>
                        <h3 class="text-2xl font-bold text-slate-950 mb-6">Benefits</h3>
                        <div class="prose prose-lg max-w-none text-slate-600">
                            {!! $career->benefits !!}
                        </div>
                    </div>
                @endif

                <div id="apply-section" class="bg-slate-950 rounded-[40px] p-8 md:p-12 text-white">
                    @if(session('success'))
                        <div class="mb-10 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-2xl flex items-center">
                            <i class="fa-solid fa-circle-check mr-4 text-xl"></i>
                            <p class="font-bold">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-10 bg-rose-500/10 border border-rose-500/20 text-rose-400 px-6 py-4 rounded-2xl">
                            <div class="flex items-center mb-2">
                                <i class="fa-solid fa-circle-exclamation mr-3"></i>
                                <span class="font-bold">Please fix the following errors:</span>
                            </div>
                            <ul class="list-disc list-inside text-sm opacity-80">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-center mb-10">
                        <h3 class="text-3xl font-bold mb-4">Apply for this position</h3>
                        <p class="text-slate-400">Or send your resume to <span class="text-blue-500 font-bold">{{ $contact_email }}</span></p>
                    </div>
                    
                    <form action="{{ route('careers.apply', $career->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-2xl mx-auto">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-400 mb-2">Full Name</label>
                                <input type="text" name="name" required class="w-full bg-slate-900 border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 transition-colors" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-400 mb-2">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-slate-900 border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 transition-colors" placeholder="john@example.com">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-400 mb-2">Phone Number</label>
                                <input type="text" name="phone" required class="w-full bg-slate-900 border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 transition-colors" placeholder="+1 (555) 000-0000">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-400 mb-2">Resume (PDF, DOC, DOCX)</label>
                                <input type="file" name="resume" required class="w-full bg-slate-900 border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-400 mb-2">Cover Letter (Optional)</label>
                            <textarea name="cover_letter" rows="4" class="w-full bg-slate-900 border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 transition-colors" placeholder="Tell us why you're a good fit..."></textarea>
                        </div>
                        <div class="text-center pt-4">
                            <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-2xl shadow-blue-900/20 transform hover:-translate-y-1">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
