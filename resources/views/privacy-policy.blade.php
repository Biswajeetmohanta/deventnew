@extends('layouts.app')

@section('title', 'Privacy Policy | Devent Technology')

@section('content')
<!-- Premium Hero Section -->
<section class="relative py-28 overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white">
    <!-- Ambient Light Glare/Blobs -->
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-20 right-10 w-[400px] h-[400px] bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>
    
    <!-- Grid Overlay for futuristic aesthetic -->
    <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none opacity-40"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Badge -->
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-black uppercase tracking-[0.2em] mb-8 animate-pulse">
            <i class="fa-solid fa-shield-halved"></i> Privacy & Trust
        </span>
        <!-- Title -->
        <h1 class="text-5xl md:text-7xl font-black tracking-tighter leading-none mb-6">
            Privacy <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-blue-500 bg-clip-text text-transparent">Policy</span>
        </h1>
        <!-- Subtitle -->
        <p class="max-w-2xl mx-auto text-lg md:text-xl text-slate-400 font-medium leading-relaxed mb-4">
            Devent Technology is committed to protecting your personal information and respecting your privacy rights.
        </p>
        <!-- Last Updated -->
        <div class="flex items-center justify-center gap-2 text-slate-500 text-sm font-semibold">
            <i class="fa-regular fa-clock"></i>
            <span>Last Updated: May 2026</span>
        </div>
    </div>
</section>

<!-- Content and Navigation Grid -->
<section class="py-20 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            <!-- Sticky Sidebar Table of Contents -->
            <div class="lg:col-span-1">
                <div class="sticky top-32 space-y-8">
                    <!-- TOC Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-list-ul text-blue-500"></i> Navigation
                        </h4>
                        <!-- Dynamic TOC Menu items will be injected here by JS -->
                        <ul id="dynamic-toc" class="space-y-3 font-semibold text-sm">
                            <!-- Injected dynamically -->
                        </ul>
                    </div>

                    <!-- Help / Contact Card -->
                    <div class="bg-gradient-to-br from-slate-900 to-slate-950 text-white rounded-3xl p-6 shadow-xl relative overflow-hidden border border-slate-800 group">
                        <!-- Ambient Light -->
                        <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-blue-600/20 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
                        
                        <div class="relative z-10 space-y-5">
                            <div class="w-10 h-10 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                                <i class="fa-solid fa-envelope-open-text text-lg"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-lg tracking-tight mb-2">Have Questions?</h5>
                                <p class="text-xs text-slate-400 font-medium leading-relaxed">
                                    Our support team is here to help with any privacy-related questions or inquiries.
                                </p>
                            </div>
                            <div class="pt-2">
                                <a href="{{ url('/contact') }}" class="w-full inline-flex items-center justify-center gap-2 bg-[#0052FF] hover:bg-blue-600 active:scale-95 transition-all text-xs font-black py-4 px-6 rounded-2xl shadow-lg shadow-blue-500/20">
                                    Contact Support <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Dynamic Content Container -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-[2.5rem] p-8 md:p-14 shadow-sm border border-slate-100 relative">
                    <!-- Premium accent stripe -->
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-600 rounded-t-[2.5rem]"></div>
                    
                    <!-- Content Container with special premium typography styling -->
                    <div id="privacy-content" class="prose-premium">
                        @php
                            $defaultPrivacyContent = '<h2>Privacy Policy</h2>
<p>Devent Technology respects your privacy and is committed to protecting the personal information shared by users through our website.</p>

<h2>Information We Collect</h2>
<p>Users may browse our website without providing personal details. We collect information only when users voluntarily submit it through contact forms, inquiry forms, emails, or other communication channels. This may include name, email address, phone number, company details, and service requirements.</p>
<p>We may also collect non-personal information such as IP address, browser type, device details, pages visited, and website usage data through cookies and analytics tools to improve our website, services, and user experience.</p>

<h2>Use of Information</h2>
<p>The information collected may be used to respond to inquiries, understand project requirements, provide service-related communication, improve our website, and prevent misuse or spam.</p>
<p>Devent Technology does not sell, rent, or trade users’ personal information to third parties. Information may be shared only when required for business operations, legal compliance, or protection of our rights.</p>

<h2>Third-Party Links & Consent</h2>
<p>Our website may contain links to third-party websites. Devent Technology is not responsible for the privacy practices, content, or services of such external websites.</p>
<p>By using our website, users agree to this Privacy Policy. For any privacy-related questions, users may contact Devent Technology through the contact details available on our website.</p>';

                            $privacyContent = $settings['privacy_policy'] ?? $defaultPrivacyContent;
                        @endphp

                        {!! $privacyContent !!}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<style>
/* Premium Typography Styling for Rich Text */
.prose-premium {
    font-size: 1rem;
    line-height: 1.8;
    color: #475569; /* slate-600 */
}

/* Document level title styling if present */
.prose-premium h1 {
    font-size: 2.25rem;
    font-weight: 900;
    color: #0f172a; /* slate-900 */
    letter-spacing: -0.03em;
    margin-bottom: 2rem;
    line-height: 1.15;
}

/* Sections Styling */
.prose-premium h2 {
    font-size: 1.75rem;
    font-weight: 800;
    color: #0f172a; /* slate-900 */
    letter-spacing: -0.02em;
    margin-top: 3rem;
    margin-bottom: 1.25rem;
    line-height: 1.25;
    position: relative;
    padding-bottom: 0.75rem;
    display: flex;
    align-items: center;
}

/* Header accent line */
.prose-premium h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 48px;
    height: 4px;
    background: #0052FF;
    border-radius: 9999px;
}

.prose-premium h2:first-of-type {
    margin-top: 0;
}

/* Subsection Styling */
.prose-premium h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b; /* slate-800 */
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose-premium p {
    margin-bottom: 1.5rem;
    font-weight: 500;
}

/* List elements style overrides */
.prose-premium ul {
    margin-left: 0.5rem;
    margin-bottom: 2rem;
    list-style: none;
    padding: 0;
}

.prose-premium li {
    position: relative;
    padding-left: 1.75rem;
    margin-bottom: 0.75rem;
    font-weight: 500;
}

.prose-premium li::before {
    content: "\f00c"; /* FontAwesome check icon */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    left: 0;
    top: 2px;
    color: #0052FF;
    font-size: 0.85rem;
}

.prose-premium a {
    color: #0052FF;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
    border-bottom: 2px solid rgba(0, 82, 255, 0.1);
}

.prose-premium a:hover {
    color: #1d4ed8;
    border-bottom-color: #1d4ed8;
}

/* Dynamic Sidebar Navigation Styles */
.toc-item-link {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 12px;
    color: #64748b; /* slate-500 */
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-left: 2px solid transparent;
}

.toc-item-link:hover {
    color: #0052FF;
    background-color: #f8fafc;
}

.toc-item-link.active {
    color: #0052FF;
    background-color: #eff6ff;
    border-left-color: #0052FF;
    padding-left: 20px;
}

.toc-item-link.sub-item {
    font-size: 0.8rem;
    padding-left: 28px;
    font-weight: 500;
}

.toc-item-link.sub-item.active {
    padding-left: 32px;
}
</style>

<!-- Dynamic Navigation Generation and Smooth Highlighting script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const content = document.getElementById("privacy-content");
    const tocContainer = document.getElementById("dynamic-toc");
    
    if (!content || !tocContainer) return;
    
    // Find all h2 and h3 headers in the content area
    const headers = content.querySelectorAll("h2, h3");
    const menuItems = [];
    
    headers.forEach((header, index) => {
        // Create a unique id if not already present
        if (!header.id) {
            header.id = "policy-section-" + (index + 1);
        }
        
        const isSub = header.tagName.toLowerCase() === "h3";
        
        // Create TOC Link item
        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + header.id;
        a.textContent = header.textContent.trim();
        a.className = "toc-item-link " + (isSub ? "sub-item" : "");
        
        li.appendChild(a);
        tocContainer.appendChild(li);
        
        // Add scroll animation behavior
        a.addEventListener("click", function(e) {
            e.preventDefault();
            const targetEl = document.getElementById(header.id);
            if (targetEl) {
                const headerOffset = 120; // sticky header spacing
                const elementPosition = targetEl.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
                
                // Set URL state without jumping
                history.pushState(null, null, "#" + header.id);
            }
        });
        
        menuItems.push({
            header: header,
            link: a
        });
    });
    
    // Highlight Active section in sidebar on scroll
    function highlightMenu() {
        const scrollPosition = window.scrollY + 160; // offset to match trigger zone
        
        let activeIndex = -1;
        
        for (let i = 0; i < menuItems.length; i++) {
            const el = menuItems[i].header;
            const top = el.getBoundingClientRect().top + window.pageYOffset;
            
            if (scrollPosition >= top) {
                activeIndex = i;
            } else {
                break;
            }
        }
        
        menuItems.forEach((item, index) => {
            if (index === activeIndex) {
                item.link.classList.add("active");
            } else {
                if (activeIndex === -1 && index === 0) {
                    // Fallback to highlight the first one if we are at the absolute top
                    item.link.classList.add("active");
                } else {
                    item.link.classList.remove("active");
                }
            }
        });
    }
    
    // Listen for scroll & load events
    window.addEventListener("scroll", highlightMenu);
    highlightMenu();
});
</script>
@endsection
