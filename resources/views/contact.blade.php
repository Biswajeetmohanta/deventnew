@extends('layouts.app')

@section('title', 'Contact Us | Devent Technology')

@section('content')
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div>
                    <h2 class="text-blue-600 font-bold uppercase tracking-widest text-sm mb-4">Get in Touch</h2>
                    <h1 class="text-5xl md:text-7xl font-bold text-slate-950 mb-8 tracking-tighter">Let's build <span class="text-blue-600">Great</span> things.</h1>
                    <p class="text-xl text-slate-600 mb-12 leading-relaxed">Have a question or a project in mind? We'd love to hear from you. Send us a message and we'll respond within 24 hours.</p>
                    
                    <div class="space-y-8">
                        <div class="flex items-start space-x-6">
                            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7 8.941L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-950">Email Us</h4>
                                <p class="text-slate-600 font-medium">{{ $settings['contact_email'] ?? 'contact@deventtechnology.com' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-6">
                            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-950">Call Us</h4>
                                <p class="text-slate-600 font-medium">{{ $settings['contact_phone'] ?? '+91 1234567890' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button onclick="openCalendlyModal()" class="btn-gradient text-white px-8 py-4 rounded-xl font-bold flex items-center shadow-xl shadow-blue-200">
                            Schedule a Call Directly
                            <i class="fa-solid fa-calendar-check ml-3"></i>
                        </button>
                    </div>
                </div>
                
                <div class="bg-slate-50 p-10 md:p-16 rounded-[40px] border border-slate-200 shadow-2xl shadow-blue-50">
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-6 rounded-3xl mb-8 font-bold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Name</label>
                                <input type="text" name="name" required placeholder="e.g. John Doe" class="w-full bg-white border border-slate-300 rounded-2xl py-4 px-6 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all shadow-sm placeholder:text-slate-400">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                                <input type="email" name="email" required placeholder="e.g. john@example.com" class="w-full bg-white border border-slate-300 rounded-2xl py-4 px-6 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all shadow-sm placeholder:text-slate-400">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Subject</label>
                            <input type="text" name="subject" placeholder="How can we help you?" class="w-full bg-white border border-slate-300 rounded-2xl py-4 px-6 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all shadow-sm placeholder:text-slate-400">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Message</label>
                            <textarea name="message" rows="5" required placeholder="Tell us about your project or inquiry..." class="w-full bg-white border border-slate-300 rounded-2xl py-4 px-6 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all shadow-sm placeholder:text-slate-400"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-bold text-lg hover:bg-blue-700 transition-all shadow-xl shadow-blue-200">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
