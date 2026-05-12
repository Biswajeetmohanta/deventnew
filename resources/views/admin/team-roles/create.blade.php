@extends('admin.layouts.admin')

@section('title', 'Add Team Role')
@section('page_title', 'Add New Team Role')

@section('content')
<div class="glass p-8 rounded-3xl max-w-5xl mx-auto">
    <form action="{{ route('admin.team-roles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="font-bold text-slate-700">Role Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="e.g. Hire React Developer" class="w-full mt-1">
            </div>

            <div>
                <label for="slug" class="font-bold text-slate-700">Slug</label>
                <input type="text" name="slug" id="slug" required value="{{ old('slug') }}" placeholder="e.g. hire-react-developer" class="w-full mt-1">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="icon" class="font-bold text-slate-700">Icon Class (FontAwesome)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}" placeholder="e.g. fa-brands fa-react" class="w-full mt-1">
            </div>
            <div>
                <label for="image" class="font-bold text-slate-700">Banner Image</label>
                <input type="file" name="image" id="image" class="w-full mt-1 text-sm">
            </div>
            <div>
                <label for="order" class="font-bold text-slate-700">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="w-full mt-1">
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
            <label for="is_active" class="text-sm font-semibold text-slate-700">Active (Show in Navbar & Website)</label>
        </div>

        <hr class="border-slate-200 my-8">
        <h4 class="text-xl font-black text-slate-900 mb-6">🎯 Dynamic Content Builder</h4>

        <div class="space-y-8">
            <!-- 1. Banner -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">01</span>
                    Hero Banner
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Banner Title</label>
                        <input type="text" name="banner_title" value="{{ old('banner_title') }}" placeholder="e.g. Hire Expert React Developers" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Banner Subtitle</label>
                        <input type="text" name="banner_subtitle" value="{{ old('banner_subtitle') }}" placeholder="e.g. Scale your team with our vetted React experts." class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Banner Badge</label>
                        <input type="text" name="banner_badge" value="{{ old('banner_badge', 'HIRE DEVELOPERS') }}" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Video URL</label>
                        <input type="text" name="banner_video_url" value="{{ old('banner_video_url', '#') }}" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Stats Text (Joined by...)</label>
                        <input type="text" name="banner_stats_text" value="{{ old('banner_stats_text', 'Joined by 500+ Companies') }}" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Hero Button Text</label>
                        <input type="text" name="banner_button_text" value="{{ old('banner_button_text', 'Hire Developers Now') }}" class="w-full mt-1">
                    </div>
                </div>
            </div>

            <!-- 2. About -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">02</span>
                    About Service / Introduction
                </h5>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold uppercase text-slate-500">Section Label</label>
                            <input type="text" name="about_label" value="{{ old('about_label', 'Overview') }}" class="w-full mt-1">
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase text-slate-500">Intro Title</label>
                            <input type="text" name="about_title" value="{{ old('about_title') }}" placeholder="e.g. Dedicated React Development Services" class="w-full mt-1">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Intro Description</label>
                        <textarea name="about_description" rows="4" class="w-full mt-1">{{ old('about_description') }}</textarea>
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Intro Image</label>
                        <input type="file" name="about_image" class="w-full mt-1 text-sm">
                    </div>
                </div>
            </div>

            <!-- 3. Why Choose Us -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">03</span>
                    Why Choose Us
                </h5>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Title</label>
                        <input type="text" name="why_choose_title" value="{{ old('why_choose_title') }}" placeholder="e.g. Why Hire React Developers from Devent?" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Description</label>
                        <textarea name="why_choose_description" rows="2" class="w-full mt-1">{{ old('why_choose_description') }}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        <div>
                            <label class="text-xs font-bold uppercase text-slate-500">Stat 1 Value</label>
                            <input type="text" name="why_choose_stat1_value" value="{{ old('why_choose_stat1_value', '10+') }}" class="w-full mt-1">
                            <input type="text" name="why_choose_stat1_label" value="{{ old('why_choose_stat1_label', 'Years Experience') }}" class="w-full mt-1 text-xs">
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase text-slate-500">Stat 2 Value</label>
                            <input type="text" name="why_choose_stat2_value" value="{{ old('why_choose_stat2_value', '500+') }}" class="w-full mt-1">
                            <input type="text" name="why_choose_stat2_label" value="{{ old('why_choose_stat2_label', 'Success Stories') }}" class="w-full mt-1 text-xs">
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase text-slate-500">Stat 3 Value</label>
                            <input type="text" name="why_choose_stat3_value" value="{{ old('why_choose_stat3_value', '150+') }}" class="w-full mt-1">
                            <input type="text" name="why_choose_stat3_label" value="{{ old('why_choose_stat3_label', 'Expert Vetted Devs') }}" class="w-full mt-1 text-xs">
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase text-slate-500">Stat 4 Value</label>
                            <input type="text" name="why_choose_stat4_value" value="{{ old('why_choose_stat4_value', '99%') }}" class="w-full mt-1">
                            <input type="text" name="why_choose_stat4_label" value="{{ old('why_choose_stat4_label', 'Client Retention') }}" class="w-full mt-1 text-xs">
                        </div>
                    </div>
                    <div id="why_choose_points-container" class="space-y-2 mt-4">
                        <label class="text-xs font-bold uppercase text-slate-500 block mb-2">Key Selling Points</label>
                        <!-- Dynamic Rows -->
                    </div>
                    <button type="button" onclick="addSimpleRow('why_choose_points')" class="text-sm text-blue-600 font-bold hover:underline">+ Add Point</button>
                </div>
            </div>

            <!-- 4. Hiring Models -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">04</span>
                    Hiring Models
                </h5>
                <div class="space-y-4">
                    <input type="text" name="hiring_models_title" value="{{ old('hiring_models_title', 'Flexible Hiring Models') }}" class="w-full mb-4" placeholder="Section Title">
                    <div id="hiring_models-container" class="space-y-3">
                        <!-- Dynamic Rows -->
                    </div>
                    <button type="button" onclick="addCardRow('hiring_models')" class="text-sm text-blue-600 font-bold hover:underline">+ Add Hiring Model</button>
                </div>
            </div>

            <!-- 5. Developer Skills -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">05</span>
                    Developer Skills / Expertise
                </h5>
                <div class="space-y-4">
                    <input type="text" name="skills_title" value="{{ old('skills_title', 'Our Developers Skills') }}" class="w-full mb-4" placeholder="Section Title">
                    <div id="skills-container" class="space-y-3">
                        <!-- Dynamic Rows -->
                    </div>
                    <button type="button" onclick="addCardRow('skills')" class="text-sm text-blue-600 font-bold hover:underline">+ Add Skill/Expertise</button>
                </div>
            </div>

            <!-- 6. Development Process -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">06</span>
                    Hiring/Development Process
                </h5>
                <div class="space-y-4">
                    <input type="text" name="process_title" value="{{ old('process_title', 'Our Hiring Process') }}" class="w-full mb-4" placeholder="Section Title">
                    <input type="file" name="process_image" class="w-full mb-4 text-sm">
                    <div id="process-container" class="space-y-3">
                        <!-- Dynamic Rows -->
                    </div>
                    <button type="button" onclick="addCardRow('process')" class="text-sm text-blue-600 font-bold hover:underline">+ Add Process Step</button>
                </div>
            </div>

            <!-- 10. FAQ -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">10</span>
                    FAQs
                </h5>
                <div class="space-y-4">
                    <input type="text" name="faqs_title" value="{{ old('faqs_title', 'Frequently Asked Questions') }}" class="w-full mb-4">
                    <div id="faqs-container" class="space-y-3">
                        <!-- Dynamic Rows -->
                    </div>
                    <button type="button" onclick="addCardRow('faqs')" class="text-sm text-blue-600 font-bold hover:underline">+ Add FAQ Item</button>
                </div>
            </div>

            <!-- 11. CTA -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">11</span>
                    CTA Section
                </h5>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">CTA Title</label>
                        <input type="text" name="cta_title" value="{{ old('cta_title', 'Ready to scale your team?') }}" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">CTA Subtitle</label>
                        <input type="text" name="cta_subtitle" value="{{ old('cta_subtitle', 'Talk to our talent experts today and find the perfect match for your project.') }}" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">CTA Button Text</label>
                        <input type="text" name="cta_button" value="{{ old('cta_button', 'Book a Consultation') }}" class="w-full mt-1">
                    </div>
                </div>
            </div>

            <!-- 13. SEO -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                <h5 class="text-sm font-black text-blue-600 mb-6 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs">13</span>
                    SEO Meta Tags
                </h5>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}" placeholder="e.g. Hire Dedicated React Developers | Devent" class="w-full mt-1">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="w-full mt-1" placeholder="e.g. Hire highly skilled React developers for your web applications.">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-12 border-t border-slate-100 mt-12">
            <a href="{{ route('admin.team-roles.index') }}" class="px-8 py-4 text-slate-600 font-black hover:bg-slate-100 rounded-2xl transition-all">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-black px-12 py-4 rounded-2xl transition-all shadow-xl shadow-blue-500/20 active:scale-95">
                Save Team Role
            </button>
        </div>
    </form>
</div>

<script>
function addSimpleRow(section) {
    const container = document.getElementById(`${section}-container`);
    const div = document.createElement('div');
    div.className = 'flex gap-2 items-center row-item';
    div.innerHTML = `
        <input type="text" name="${section}[]" class="w-full" placeholder="Enter point...">
        <button type="button" onclick="this.closest('.row-item').remove()" class="text-red-500 hover:text-red-700 font-bold text-xl px-2">×</button>
    `;
    container.appendChild(div);
}

function addCardRow(section) {
    const container = document.getElementById(`${section}-container`);
    const index = Date.now();
    const div = document.createElement('div');
    div.className = 'p-4 bg-white rounded-2xl border border-slate-100 shadow-sm relative row-item';
    div.innerHTML = `
        <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-200">×</button>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="${section}[${index}][title]" placeholder="Title / Question" class="w-full text-sm font-bold">
            <input type="text" name="${section}[${index}][icon]" placeholder="Icon class (optional)" class="w-full text-sm">
            <textarea name="${section}[${index}][description]" placeholder="Description / Answer" rows="2" class="w-full text-sm md:col-span-2"></textarea>
        </div>
    `;
    container.appendChild(div);
}
</script>
@endsection
