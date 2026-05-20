@extends('admin.layouts.admin')

@section('title', 'Add New Case Study')
@section('page_title', 'Create Case Study')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.case-studies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="font-semibold text-slate-700">Case Study Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="e.g. Doctor Appointment App Development">
            </div>

            <div>
                <label for="client" class="font-semibold text-slate-700">Client Name</label>
                <input type="text" name="client" id="client" value="{{ old('client') }}" placeholder="e.g. Vrinsoft Medical Care">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="industry_id" class="font-semibold text-slate-700">Industry Sector</label>
                <select name="industry_id" id="industry_id" class="w-full">
                    <option value="">Select Industry</option>
                    @foreach($industries as $industry)
                        <option value="{{ $industry->id }}" {{ old('industry_id') == $industry->id ? 'selected' : '' }}>
                            {{ $industry->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="link" class="font-semibold text-slate-700">Live Project URL (Optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}" placeholder="https://example.com">
            </div>
        </div>

        <div>
            <label class="font-semibold text-slate-700 mb-2 block">Technologies Used</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 max-h-48 overflow-y-auto">
                @foreach($technologies as $tech)
                    <div class="flex items-center">
                        <input type="checkbox" name="technologies[]" value="{{ $tech->id }}" id="tech-{{ $tech->id }}"
                               {{ is_array(old('technologies')) && in_array($tech->id, old('technologies')) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                        <label for="tech-{{ $tech->id }}" class="ml-2 mb-0 text-sm cursor-pointer text-slate-600 font-medium">{{ $tech->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <label for="description" class="font-semibold text-slate-700">Short Summary description (Grid card layout description)</label>
            <textarea name="description" id="description" rows="3" placeholder="Brief card summary description...">{{ old('description') }}</textarea>
        </div>

        <!-- Dynamic Content Sections -->
        <div class="border-t border-slate-200 pt-6 mt-6">
            <div class="mb-6">
                <h4 class="text-lg font-bold text-slate-900 flex items-center gap-2"><i class="fa-solid fa-puzzle-piece text-amber-500"></i> Dynamic Content Sections</h4>
                <p class="text-xs text-slate-500">Configure page blocks to make this case study rich, interactive and dynamically styled.</p>
            </div>
            
            <!-- 1. Hero Banner -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-rectangle-ad text-blue-500"></i> 1. Hero Banner</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="banner_title" class="text-xs">Banner Main Title</label>
                        <input type="text" name="banner_title" id="banner_title" value="{{ old('banner_title') }}" placeholder="e.g. Revolutionizing Medical Consultations">
                    </div>
                    <div>
                        <label for="banner_subtitle" class="text-xs">Banner Subtitle</label>
                        <input type="text" name="banner_subtitle" id="banner_subtitle" value="{{ old('banner_subtitle') }}" placeholder="e.g. Scalable telehealth app connecting users and clinic networks.">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="banner_badge" class="text-xs">Badge Tag</label>
                        <input type="text" name="banner_badge" id="banner_badge" value="{{ old('banner_badge', 'CASE STUDY') }}" placeholder="e.g. MOBILE CASE STUDY">
                    </div>
                    <div>
                        <label for="banner_video_url" class="text-xs">Featured Video URL / Explainer URL</label>
                        <input type="text" name="banner_video_url" id="banner_video_url" value="{{ old('banner_video_url') }}" placeholder="e.g. https://www.youtube.com/watch?v=...">
                    </div>
                </div>
                <div>
                    <label for="highlights_raw" class="text-xs font-semibold">Hero Highlights (one per line)</label>
                    <textarea name="highlights_raw" id="highlights_raw" rows="3" placeholder="e.g.
HIPAA Compliant Security
Real-Time Video Consultations
Automated Prescription Management">{{ old('highlights_raw') }}</textarea>
                </div>
            </div>

            <!-- 2. Project Overview -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-circle-info text-blue-500"></i> 2. Project Overview</h5>
                <div class="mb-4">
                    <label for="overview_title" class="text-xs">Overview Title</label>
                    <input type="text" name="overview_title" id="overview_title" value="{{ old('overview_title', 'Project Overview') }}" placeholder="Project Overview">
                </div>
                <div>
                    <label for="overview_description" class="text-xs">Overview Detailed Content</label>
                    <textarea name="overview_description" id="overview_description" rows="4" placeholder="Detailed text explaining the background, context, and goals of this case study...">{{ old('overview_description') }}</textarea>
                </div>
            </div>

            <!-- 3. Challenge Section -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation text-rose-500"></i> 3. The Challenge</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="challenge_title" class="text-xs">Challenge Title</label>
                        <input type="text" name="challenge_title" id="challenge_title" value="{{ old('challenge_title', 'The Challenge') }}" placeholder="The Challenge">
                    </div>
                    <div>
                        <label for="challenge_image" class="text-xs font-semibold">Challenge Section Illustration/Image</label>
                        <input type="file" name="challenge_image" id="challenge_image" class="text-sm">
                    </div>
                </div>
                <div>
                    <label for="challenge_description" class="text-xs">Challenge Content</label>
                    <textarea name="challenge_description" id="challenge_description" rows="4" placeholder="Detail the business problems, technical obstacles, or user needs you had to solve...">{{ old('challenge_description') }}</textarea>
                </div>
            </div>

            <!-- 4. Solution Section -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-lightbulb text-emerald-500"></i> 4. The Solution</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="solution_title" class="text-xs">Solution Title</label>
                        <input type="text" name="solution_title" id="solution_title" value="{{ old('solution_title', 'The Solution') }}" placeholder="The Solution">
                    </div>
                    <div>
                        <label for="solution_image" class="text-xs font-semibold">Solution Section Illustration/Image</label>
                        <input type="file" name="solution_image" id="solution_image" class="text-sm">
                    </div>
                </div>
                <div>
                    <label for="solution_description" class="text-xs">Solution Content</label>
                    <textarea name="solution_description" id="solution_description" rows="4" placeholder="Detail how Devent built the custom solution, architectures, and approaches used...">{{ old('solution_description') }}</textarea>
                </div>
            </div>

            <!-- 5. Features Grid -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-list-check text-blue-500"></i> 5. Features Grid</h5>
                <div class="mb-4">
                    <label for="features_title" class="text-xs">Features Section Title</label>
                    <input type="text" name="features_title" id="features_title" value="{{ old('features_title', 'Key Features & Capabilities') }}" placeholder="Key Features">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Features List</label>
                    <div id="features-container" class="space-y-2">
                        @php $features = old('features', []); @endphp
                        @foreach($features as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="features[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full font-semibold" placeholder="e.g. Appointment Booker">
                                <input type="text" name="features[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Interactive scheduling engine for patient appointments.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('features')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1"><i class="fa-solid fa-plus-circle"></i> Add Feature Item</button>
                </div>
            </div>

            <!-- 6. Approach Section -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-compass text-blue-500"></i> 6. Strategic Approach</h5>
                <div class="mb-4">
                    <label for="approach_title" class="text-xs">Section Title</label>
                    <input type="text" name="approach_title" id="approach_title" value="{{ old('approach_title', 'Our Methodology & Approach') }}" placeholder="Strategic Approach">
                </div>
                <div class="mb-4">
                    <label for="approach_description" class="text-xs">Approach Description (Paragraph 1)</label>
                    <textarea name="approach_description" id="approach_description" rows="3" placeholder="Explain the project delivery philosophy, agile sprints, or UX mapping...">{{ old('approach_description') }}</textarea>
                </div>
                <div>
                    <label for="approach_description2" class="text-xs">Approach Description (Paragraph 2 - Optional)</label>
                    <textarea name="approach_description2" id="approach_description2" rows="3" placeholder="Provide extra technical architecture details or collaboration models...">{{ old('approach_description2') }}</textarea>
                </div>
            </div>

            <!-- 7. Process timeline -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-timeline text-blue-500"></i> 7. Timeline / Process Steps</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="process_title" class="text-xs">Section Title</label>
                        <input type="text" name="process_title" id="process_title" value="{{ old('process_title', 'Step-by-Step Delivery') }}" placeholder="Timeline Title">
                    </div>
                    <div>
                        <label for="process_subtitle" class="text-xs">Section Subtitle</label>
                        <input type="text" name="process_subtitle" id="process_subtitle" value="{{ old('process_subtitle', 'From Discovery to Final Launch') }}" placeholder="Timeline Subtitle">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="process_image" class="text-xs font-semibold">Process Section Image/Workflow diagram</label>
                    <input type="file" name="process_image" id="process_image" class="text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Delivery Steps</label>
                    <div id="process-container" class="space-y-2">
                        @php $process = old('process', []); @endphp
                        @foreach($process as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="process[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full font-semibold" placeholder="e.g. Phase 01: Wireframing">
                                <input type="text" name="process[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Drafting interactive schemas and screen transitions.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('process')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1"><i class="fa-solid fa-plus-circle"></i> Add Step Item</button>
                </div>
            </div>

            <!-- 8. Achievements / Stats -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-chart-simple text-blue-500"></i> 8. Key Statistics / Metrics</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Metrics (Display key stats achieved, e.g. '120%' | 'Increase in bookings')</label>
                    <div id="achievements-container" class="space-y-2">
                        @php $achievements = old('achievements', []); @endphp
                        @foreach($achievements as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="achievements[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full font-black text-blue-600" placeholder="e.g. +40% or 2.5 Secs">
                                <input type="text" name="achievements[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Speed optimization or Growth in transactions">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('achievements')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1"><i class="fa-solid fa-plus-circle"></i> Add Statistic</button>
                </div>
            </div>

            <!-- 9. Testimonials -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-quote-left text-blue-500"></i> 9. Case Testimonials</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Feedback</label>
                    <div id="testimonials-container" class="space-y-2">
                        @php $testimonials = old('testimonials', []); @endphp
                        @foreach($testimonials as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="testimonials[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full font-bold" placeholder="e.g. Client Name / CEO">
                                <input type="text" name="testimonials[{{ $i }}][role]" value="{{ $item['role'] ?? '' }}" class="text-sm py-1 w-full" placeholder="e.g. VP at Medical Inc.">
                                <input type="text" name="testimonials[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Devent delivered before schedule and exceeding requirements.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('testimonials')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1"><i class="fa-solid fa-plus-circle"></i> Add Testimonial</button>
                </div>
            </div>

            <!-- 10. FAQs -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-circle-question text-blue-500"></i> 10. Accordion FAQs</h5>
                <div>
                    <div id="faqs-container" class="space-y-2">
                        @php $faqs = old('faqs', []); @endphp
                        @foreach($faqs as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="faqs[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full font-semibold" placeholder="e.g. How secure is the prescription tool?">
                                <input type="text" name="faqs[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. It relies on cryptographical hashes conforming to HL7 data models.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('faqs')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1"><i class="fa-solid fa-plus-circle"></i> Add FAQ Accordion</button>
                </div>
            </div>

            <!-- 11. CTA Banners -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-bullhorn text-blue-500"></i> 11. CTA Banners</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="cta_title" class="text-xs">CTA 1 Title</label>
                        <input type="text" name="cta_title" id="cta_title" value="{{ old('cta_title') }}" placeholder="e.g. Need a similar application?">
                    </div>
                    <div>
                        <label for="cta_subtitle" class="text-xs">CTA 1 Subtitle</label>
                        <input type="text" name="cta_subtitle" id="cta_subtitle" value="{{ old('cta_subtitle') }}" placeholder="e.g. Consult with our telemedicine product managers.">
                    </div>
                    <div>
                        <label for="cta_button" class="text-xs">CTA 1 Button Text</label>
                        <input type="text" name="cta_button" id="cta_button" value="{{ old('cta_button') }}" placeholder="e.g. Book Dynamic Consultation">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="cta2_title" class="text-xs">CTA 2 Title</label>
                        <input type="text" name="cta2_title" id="cta2_title" value="{{ old('cta2_title') }}" placeholder="e.g. Scale your Healthcare Practice.">
                    </div>
                    <div>
                        <label for="cta2_subtitle" class="text-xs">CTA 2 Subtitle</label>
                        <input type="text" name="cta2_subtitle" id="cta2_subtitle" value="{{ old('cta2_subtitle') }}" placeholder="e.g. Let us build a reliable, custom compliance-ready infrastructure.">
                    </div>
                    <div>
                        <label for="cta2_button" class="text-xs">CTA 2 Button Text</label>
                        <input type="text" name="cta2_button" id="cta2_button" value="{{ old('cta2_button') }}" placeholder="e.g. Initiate Healthcare R&D">
                    </div>
                </div>
            </div>

            <!-- 12. Why Choose Us -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 border border-slate-100">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-award text-blue-500"></i> 12. Why Choose Devent</h5>
                <div class="mb-4">
                    <label for="why_choose_title" class="text-xs">Section Title</label>
                    <input type="text" name="why_choose_title" id="why_choose_title" value="{{ old('why_choose_title', 'Why Partner with Devent?') }}" placeholder="Why Partner with Devent?">
                </div>
                <div class="mb-4">
                    <label for="why_choose_description" class="text-xs">Description Summary</label>
                    <textarea name="why_choose_description" id="why_choose_description" rows="3" placeholder="Summarize our value proposition for this project sector...">{{ old('why_choose_description') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="why_choose_image" class="text-xs font-semibold">Section Illustration/Graphics</label>
                    <input type="file" name="why_choose_image" id="why_choose_image" class="text-sm">
                </div>
                <div>
                    <label for="why_choose_points_raw" class="text-xs font-semibold">Key Highlights (one per line)</label>
                    <textarea name="why_choose_points_raw" id="why_choose_points_raw" rows="3" placeholder="e.g.
End-to-End Compliance Certification
Agile Development Sprint Teams
Multi-Region Scalable Architecture">{{ old('why_choose_points_raw') }}</textarea>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="image" class="font-semibold text-slate-700">Featured Card Image</label>
                <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50">
                    <div class="space-y-1 text-center">
                        <i class="fa-solid fa-image text-slate-300 text-3xl mb-2"></i>
                        <div class="flex text-sm text-slate-600">
                            <input type="file" name="image" id="image" class="sr-only">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none">
                                <span>Upload a file</span>
                            </label>
                            <p class="pl-1 text-slate-500">or drag and drop</p>
                        </div>
                        <p class="text-xs text-slate-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>

            <div>
                <label for="order" class="font-semibold text-slate-700">Display Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}">
                <div class="mt-8 flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                    <label for="is_active" class="ml-2 mb-0 cursor-pointer text-slate-600 font-medium">Active (Visible on website)</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.case-studies.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Save Case Study
            </button>
        </div>
    </form>
</div>

<script>
function addRow(section) {
    const container = document.getElementById(`${section}-container`);
    const index = Date.now();
    
    let html = '';
    if (section === 'testimonials') {
        html = `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                <input type="text" name="${section}[${index}][title]" class="text-sm py-1 w-full font-bold" placeholder="e.g. John Doe / VP">
                <input type="text" name="${section}[${index}][role]" class="text-sm py-1 w-full" placeholder="e.g. CEO at TechCorp">
                <input type="text" name="${section}[${index}][description]" class="text-sm py-1 w-full" placeholder="e.g. Great service!">
                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
            </div>
        `;
    } else {
        html = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                <input type="text" name="${section}[${index}][title]" class="text-sm py-1 w-full font-semibold" placeholder="e.g. Item Title">
                <input type="text" name="${section}[${index}][description]" class="text-sm py-1 w-full" placeholder="e.g. Item Description">
                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
            </div>
        `;
    }
    
    const div = document.createElement('div');
    div.innerHTML = html.trim();
    container.appendChild(div.firstChild);
}
</script>
@endsection
