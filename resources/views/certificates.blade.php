@extends('layouts.app')

@section('title', 'Certificates & Accreditations | Devent Technology')

@section('content')
    <!-- Hero Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-100/50 rounded-l-[100px] transform translate-x-1/3 -skew-x-12 opacity-30"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black text-slate-950 mb-8 tracking-tighter">
                Our <span style="color: #0052FF;">Certificates & Accreditations</span>
            </h1>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium">
                Our certifications represent our unwavering commitment to quality, standards, security, and operational excellence.
            </p>
        </div>
    </section>

    <!-- Certificates Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                @forelse($certificates as $certificate)
                    @php
                        $isPdf = strtolower(pathinfo($certificate->image_or_pdf, PATHINFO_EXTENSION)) === 'pdf';
                    @endphp
                    <div class="premium-card group flex flex-col h-full rounded-[30px] border border-slate-100 bg-white p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        
                        <!-- Document Display Area -->
                        <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 mb-6 flex items-center justify-center group/preview">
                            @if($isPdf)
                                <div class="flex flex-col items-center justify-center p-6 text-center">
                                    <div class="w-16 h-16 bg-rose-50 rounded-full flex items-center justify-center text-rose-500 mb-4 transition-transform group-hover/preview:scale-110">
                                        <i class="fa-solid fa-file-pdf text-3xl"></i>
                                    </div>
                                    <span class="text-xs text-slate-400 font-bold tracking-widest uppercase">PDF ACCREDITATION</span>
                                </div>
                            @else
                                <img src="{{ asset('storage/' . $certificate->image_or_pdf) }}" alt="{{ $certificate->title }}" class="max-h-full max-w-full object-contain transition-transform duration-500 group-hover/preview:scale-105">
                            @endif

                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover/preview:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4">
                                @if($isPdf)
                                    <a href="{{ asset('storage/' . $certificate->image_or_pdf) }}" target="_blank" class="px-5 py-2.5 bg-white text-slate-900 font-bold text-xs rounded-xl hover:bg-slate-100 transition-colors shadow-lg flex items-center gap-1.5">
                                        <i class="fa-solid fa-file-pdf text-rose-500"></i> Open PDF
                                    </a>
                                @else
                                    <button onclick="openImageLightbox('{{ asset('storage/' . $certificate->image_or_pdf) }}', '{{ addslashes($certificate->title) }}')" class="px-5 py-2.5 bg-white text-slate-900 font-bold text-xs rounded-xl hover:bg-slate-100 transition-colors shadow-lg flex items-center gap-1.5">
                                        <i class="fa-solid fa-eye text-blue-600"></i> Preview Image
                                    </button>
                                    <a href="{{ asset('storage/' . $certificate->image_or_pdf) }}" target="_blank" class="w-9 h-9 bg-white/20 hover:bg-white/30 text-white rounded-xl flex items-center justify-center transition-colors shadow-lg" title="Open in new tab">
                                        <i class="fa-solid fa-expand"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Card Info -->
                        <div class="flex-grow flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    @if($certificate->issuer)
                                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider bg-blue-50 px-3 py-1 rounded-full">{{ $certificate->issuer }}</span>
                                    @endif
                                    @if($certificate->issue_date)
                                        <span class="text-xs text-slate-400 font-medium">{{ $certificate->issue_date->format('M Y') }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 mb-3 leading-snug">{{ $certificate->title }}</h3>
                                @if($certificate->description)
                                    <p class="text-sm text-slate-500 leading-relaxed">{{ $certificate->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 text-slate-400">
                        <i class="fa-solid fa-award text-5xl mb-4 opacity-30"></i>
                        <p class="text-lg font-medium">No certificates displayed at the moment. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Lightbox Modal for Images -->
    <div id="imageLightbox" class="fixed inset-0 z-[99999] bg-slate-950/90 hidden items-center justify-center p-4" onclick="closeImageLightbox()">
        <button class="absolute top-6 right-6 text-white hover:text-slate-300 text-3xl font-light" onclick="closeImageLightbox()">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center gap-4" onclick="event.stopPropagation()">
            <img id="lightboxImg" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl">
            <h4 id="lightboxTitle" class="text-white text-lg font-semibold tracking-wide text-center"></h4>
        </div>
    </div>

    <!-- Client Success CTA -->
    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[50px] p-12 md:p-24 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-10 tracking-tighter">Committed to Excellence</h2>
                    <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto font-medium">Verify our credentials or speak with our solutions architect about standards compliance.</p>
                    <a href="{{ url('/contact') }}" class="premium-cta-btn px-10 py-5">
                        <span class="btn-text">Consult Our Experts</span>
                        <i class="fa-solid fa-arrow-right ml-3 relative z-10"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function openImageLightbox(src, title) {
            const lightbox = document.getElementById('imageLightbox');
            const img = document.getElementById('lightboxImg');
            const titleElem = document.getElementById('lightboxTitle');
            
            img.src = src;
            titleElem.textContent = title;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeImageLightbox() {
            const lightbox = document.getElementById('imageLightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endsection
