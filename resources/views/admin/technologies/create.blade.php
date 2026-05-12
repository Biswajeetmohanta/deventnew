@extends('admin.layouts.admin')

@section('title', 'Add Technology')
@section('page_title', 'Add New Technology')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name">Technology Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}" placeholder="e.g. React Native">
            </div>

            <div>
                <label for="category">Category</label>
                <input type="text" name="category" id="category" required value="{{ old('category') }}" placeholder="e.g. Mobile">
            </div>
        </div>

        <div>
            <label for="description">Short Description</label>
            <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo">
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
            <label for="is_active" class="text-sm font-semibold text-slate-700">Active</label>
        </div>

        <!-- Dynamic Content Sections -->
        <div class="border-t border-slate-200 pt-6 mt-6">
            <h4 class="text-lg font-bold text-slate-900 mb-2">🎯 Dynamic Content Sections</h4>
            <p class="text-xs text-slate-500 mb-6">Manage the content for the dynamic sections below.</p>
            
            <!-- 1. Banner -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">1. Hero Banner</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="banner_title" class="text-xs">Banner Title</label>
                        <input type="text" name="banner_title" id="banner_title" value="{{ old('banner_title') }}" placeholder="e.g. React Native App Development Company">
                    </div>
                    <div>
                        <label for="banner_subtitle" class="text-xs">Banner Subtitle</label>
                        <input type="text" name="banner_subtitle" id="banner_subtitle" value="{{ old('banner_subtitle') }}" placeholder="e.g. Build high-performance cross-platform apps.">
                    </div>
                    <div>
                        <label for="banner_badge" class="text-xs">Banner Badge (with emoji)</label>
                        <input type="text" name="banner_badge" id="banner_badge" value="{{ old('banner_badge') }}" placeholder="e.g. ⚡ Python Development Excellence">
                    </div>
                    <div>
                        <label for="banner_video_url" class="text-xs">Banner Video URL</label>
                        <input type="text" name="banner_video_url" id="banner_video_url" value="{{ old('banner_video_url') }}" placeholder="e.g. https://youtube.com/...">
                    </div>
                </div>
            </div>

            <!-- 2. Breadcrumbs -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">2. Breadcrumbs</h5>
                <div>
                    <label for="breadcrumb_title" class="text-xs">Breadcrumb Title</label>
                    <input type="text" name="breadcrumb_title" id="breadcrumb_title" value="{{ old('breadcrumb_title') }}" placeholder="e.g. React Native Development">
                </div>
            </div>

            <!-- 3. Introduction -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">3. Technology Introduction</h5>
                <div class="space-y-4">
                    <div>
                        <label for="intro_title" class="text-xs">Intro Title</label>
                        <input type="text" name="intro_title" id="intro_title" value="{{ old('intro_title') }}" placeholder="e.g. Why Choose React Native?">
                    </div>
                    <div>
                        <label for="intro_description" class="text-xs">Intro Description</label>
                        <textarea name="intro_description" id="intro_description" rows="3">{{ old('intro_description') }}</textarea>
                    </div>
                    <div>
                        <label for="intro_image" class="text-xs">Intro Image</label>
                        <input type="file" name="intro_image" id="intro_image" class="text-sm">
                    </div>
                </div>
            </div>

            <!-- 4. About -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">4. About Technology</h5>
                <div class="space-y-4">
                    <div>
                        <label for="about_title" class="text-xs">About Title</label>
                        <input type="text" name="about_title" id="about_title" value="{{ old('about_title') }}" placeholder="e.g. About React Native">
                    </div>
                    <div>
                        <label for="about_description" class="text-xs">About Description</label>
                        <textarea name="about_description" id="about_description" rows="3">{{ old('about_description') }}</textarea>
                    </div>
                    <div>
                        <label for="detailed_overview" class="text-xs">Detailed Overview (Longer text)</label>
                        <textarea name="detailed_overview" id="detailed_overview" rows="5">{{ old('detailed_overview') }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Key Highlights (Checklist)</label>
                    <div id="highlights-container" class="space-y-2">
                        <!-- Rows added via JS -->
                    </div>
                    <button type="button" onclick="addHighlightRow()" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Highlight</button>
                </div>
            </div>

            <!-- 5. Solutions -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">5. Services / Solutions</h5>
                <div class="mb-4">
                    <label for="solutions_title" class="text-xs">Section Title</label>
                    <input type="text" name="solutions_title" id="solutions_title" value="{{ old('solutions_title') }}" placeholder="e.g. Our React Native Services">
                </div>
                <div class="mb-4">
                    <label for="solutions_label" class="text-xs">Section Label</label>
                    <input type="text" name="solutions_label" id="solutions_label" value="{{ old('solutions_label') }}" placeholder="e.g. WHAT WE DO">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Solutions</label>
                    <div id="solutions-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('solutions')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Solution</button>
                </div>
            </div>

            <!-- 6. Features -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">6. Features / Benefits</h5>
                <div class="mb-4">
                    <label for="features_title" class="text-xs">Section Title</label>
                    <input type="text" name="features_title" id="features_title" value="{{ old('features_title') }}" placeholder="e.g. Benefits of React Native">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Features</label>
                    <div id="features-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('features')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Feature</button>
                </div>
            </div>

            <!-- 7. Process -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">7. Development Process</h5>
                <div class="mb-4">
                    <label for="process_title" class="text-xs">Section Title</label>
                    <input type="text" name="process_title" id="process_title" value="{{ old('process_title') }}" placeholder="e.g. Our Development Process">
                </div>
                <div class="mb-4">
                    <label for="process_image" class="text-xs">Process Image</label>
                    <input type="file" name="process_image" id="process_image" class="text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Steps</label>
                    <div id="process-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('process')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Step</button>
                </div>
            </div>

            <!-- 8. Why Choose Us -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">8. Why Choose Us</h5>
                <div class="space-y-4">
                    <div>
                        <label for="why_choose_title" class="text-xs">Title</label>
                        <input type="text" name="why_choose_title" id="why_choose_title" value="{{ old('why_choose_title') }}" placeholder="e.g. Why Devent for React Native?">
                    </div>
                    <div>
                        <label for="why_choose_description" class="text-xs">Description</label>
                        <textarea name="why_choose_description" id="why_choose_description" rows="3">{{ old('why_choose_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 9. Industries We Serve -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">9. Industries We Serve</h5>
                <div class="mb-4">
                    <label for="industries_title" class="text-xs">Section Title</label>
                    <input type="text" name="industries_title" id="industries_title" value="{{ old('industries_title') }}" placeholder="e.g. Industries We Serve">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Industries</label>
                    <div id="industries_served-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('industries_served')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Industry</button>
                </div>
            </div>

            <!-- 10. Engagement Models -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">10. Engagement Models</h5>
                <div class="mb-4">
                    <label for="engagement_title" class="text-xs">Section Title</label>
                    <input type="text" name="engagement_title" id="engagement_title" value="{{ old('engagement_title') }}" placeholder="e.g. Flexible Engagement Models">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Models</label>
                    <div id="engagement_models-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('engagement_models')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Model</button>
                </div>
            </div>

            <!-- 11. Hiring Model -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">11. Hiring Model / Team</h5>
                <div class="space-y-4">
                    <div>
                        <label for="hiring_title" class="text-xs">Title</label>
                        <input type="text" name="hiring_title" id="hiring_title" value="{{ old('hiring_title') }}" placeholder="e.g. Hire React Native Developers">
                    </div>
                    <div>
                        <label for="hiring_description" class="text-xs">Description</label>
                        <textarea name="hiring_description" id="hiring_description" rows="3">{{ old('hiring_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 12. Statistics -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">12. Statistics / Counters</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Statistics</label>
                    <div id="statistics-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('statistics')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Statistic</button>
                </div>
            </div>

            <!-- 13. Tech Stack -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">13. Technology Stack / Tools</h5>
                <div class="mb-4">
                    <label for="tech_stack_title" class="text-xs">Section Title</label>
                    <input type="text" name="tech_stack_title" id="tech_stack_title" value="{{ old('tech_stack_title') }}" placeholder="e.g. Technology Stack & Tools">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Tools</label>
                    <div id="tech_stack-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('tech_stack')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Tool</button>
                </div>
            </div>

            <!-- 14. FAQs -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">14. FAQs</h5>
                <div class="mb-4">
                    <label for="faqs_title" class="text-xs">Section Title</label>
                    <input type="text" name="faqs_title" id="faqs_title" value="{{ old('faqs_title') }}" placeholder="e.g. Frequently Asked Questions">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">FAQs</label>
                    <div id="faqs-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('faqs')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add FAQ</button>
                </div>
            </div>

            <!-- 15. Testimonials -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">15. Testimonials</h5>
                <div class="mb-4">
                    <label for="testimonials_title" class="text-xs">Section Title</label>
                    <input type="text" name="testimonials_title" id="testimonials_title" value="{{ old('testimonials_title') }}" placeholder="e.g. Client Success Stories">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Testimonials</label>
                    <div id="testimonials-container" class="space-y-2">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    <button type="button" onclick="addRow('testimonials', true)" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Testimonial</button>
                </div>
            </div>

            <!-- 16. CTA -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">16. CTA Section (Footer)</h5>
                <div class="space-y-4">
                    <div>
                        <label for="cta_title" class="text-xs">CTA Title</label>
                        <input type="text" name="cta_title" id="cta_title" value="{{ old('cta_title') }}" placeholder="e.g. Ready to Build Your App?">
                    </div>
                    <div>
                        <label for="cta_subtitle" class="text-xs">CTA Subtitle</label>
                        <input type="text" name="cta_subtitle" id="cta_subtitle" value="{{ old('cta_subtitle') }}" placeholder="e.g. Get a free quote today.">
                    </div>
                    <div>
                        <label for="cta_button" class="text-xs">Button Text</label>
                        <input type="text" name="cta_button" id="cta_button" value="{{ old('cta_button') }}" placeholder="e.g. Let's Talk">
                    </div>
                </div>
            </div>

            <!-- 17. Advantages -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">17. Advantages (Why Choose This Tech)</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Advantages</label>
                    <div id="advantages-container" class="space-y-2">
                        <!-- Rows added via JS -->
                    </div>
                    <button type="button" onclick="addRow('advantages')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Advantage</button>
                </div>
            </div>

            <!-- 18. Expert Consultation -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">18. Expert Consultation</h5>
                <div class="space-y-4">
                    <div>
                        <label for="expert_title" class="text-xs">Title</label>
                        <input type="text" name="expert_title" id="expert_title" value="{{ old('expert_title') }}" placeholder="e.g. Talk to Our Technology Experts">
                    </div>
                    <div>
                        <label for="expert_description" class="text-xs">Description</label>
                        <textarea name="expert_description" id="expert_description" rows="3">{{ old('expert_description') }}</textarea>
                    </div>
                    <div>
                        <label for="expert_button" class="text-xs">Button Text</label>
                        <input type="text" name="expert_button" id="expert_button" value="{{ old('expert_button') }}" placeholder="e.g. Schedule a Call">
                    </div>
                </div>
            </div>

            <!-- 19. SEO Meta -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">19. SEO Meta Tags</h5>
                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="text-xs">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" placeholder="e.g. React Native App Development | Devent">
                    </div>
                    <div>
                        <label for="meta_description" class="text-xs">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" placeholder="e.g. We provide top-notch React Native development services.">{{ old('meta_description') }}</textarea>
                    </div>
                    <div>
                        <label for="meta_keywords" class="text-xs">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="e.g. react native, app development, mobile apps">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.technologies.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                Save Technology
            </button>
        </div>
    </form>
</div>

<script>
function addRow(section, isTestimonial = false) {
    const container = document.getElementById(`${section}-container`);
    const index = Date.now(); // Use timestamp as unique index
    
    let html = '';
    
    if (isTestimonial) {
        html = `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                <input type="text" name="${section}[${index}][title]" class="text-sm py-1 w-full" placeholder="Name">
                <input type="text" name="${section}[${index}][subtitle]" class="text-sm py-1 w-full" placeholder="Position/Company">
                <input type="text" name="${section}[${index}][description]" class="text-sm py-1 w-full" placeholder="Feedback">
                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
            </div>
        `;
    } else {
        html = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                <input type="text" name="${section}[${index}][title]" class="text-sm py-1 w-full" placeholder="e.g. Title / Key">
                <input type="text" name="${section}[${index}][description]" class="text-sm py-1 w-full" placeholder="e.g. Description / Value">
                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
            </div>
        `;
    }
    
    const div = document.createElement('div');
    div.innerHTML = html.trim();
    container.appendChild(div.firstChild);
}

function addHighlightRow() {
    const container = document.getElementById('highlights-container');
    const html = `
        <div class="flex gap-2 row-item relative">
            <input type="text" name="highlights[]" class="text-sm py-1 w-full" placeholder="e.g. New Feature">
            <button type="button" onclick="this.closest('.row-item').remove()" class="bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
        </div>
    `;
    const div = document.createElement('div');
    div.innerHTML = html.trim();
    container.appendChild(div.firstChild);
}
</script>
@endsection
