@extends('admin.layouts.admin')

@section('title', 'Edit Service')
@section('page_title', 'Edit: ' . $service->title)

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title">Service Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $service->title) }}">
            </div>

            <div>
                <label for="icon">FontAwesome Icon</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $service->icon) }}">
            </div>
        </div>

        <div>
            <label for="summary">Summary (Short Intro)</label>
            <textarea name="summary" id="summary" rows="3">{{ old('summary', $service->summary) }}</textarea>
        </div>

        <div>
            <label for="description">Full Description</label>
            <textarea name="description" id="description" rows="6">{{ old('description', $service->description) }}</textarea>
        </div>

        <!-- Dynamic Content Sections -->
        <div class="border-t border-slate-200 pt-6 mt-6">
            <h4 class="text-lg font-bold text-slate-900 mb-2">🎯 Dynamic Content Sections</h4>
            <p class="text-xs text-slate-500 mb-6">Manage the content for the dynamic sections below. You can add or remove rows as needed.</p>
            
            <!-- 1. Banner -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">1. Hero Banner</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="banner_title" class="text-xs">Banner Title</label>
                        <input type="text" name="banner_title" id="banner_title" value="{{ old('banner_title', $service->content_data['banner']['title'] ?? '') }}" placeholder="e.g. Custom Software Development Services">
                    </div>
                    <div>
                        <label for="banner_subtitle" class="text-xs">Banner Subtitle</label>
                        <input type="text" name="banner_subtitle" id="banner_subtitle" value="{{ old('banner_subtitle', $service->content_data['banner']['subtitle'] ?? '') }}" placeholder="e.g. We build scalable and secure software solutions.">
                    </div>
                </div>
                <div>
                    <label for="highlights_raw" class="text-xs">Bullet Highlights (one per line)</label>
                    <textarea name="highlights_raw" id="highlights_raw" rows="4" placeholder="e.g.
Agile Development Process
Dedicated Team of Experts
24/7 Support">@if(isset($service->content_data['highlights']))@foreach($service->content_data['highlights'] as $h){{ $h }}
@endforeach @endif</textarea>
                </div>
            </div>

            <!-- 2. Features -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">2. Features / Services Grid</h5>
                <div class="mb-4">
                    <label for="features_title" class="text-xs">Section Title</label>
                    <input type="text" name="features_title" id="features_title" value="{{ old('features_title', $service->content_data['features_title'] ?? '') }}" placeholder="e.g. Our Core Features">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Features</label>
                    <div id="features-container" class="space-y-2">
                        @php $features = $service->content_data['features'] ?? []; @endphp
                        @foreach($features as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="features[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. Custom Development">
                                <input type="text" name="features[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. We build tailored software solutions.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('features')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Feature</button>
                </div>
            </div>

            <!-- 3. Approach -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">3. Approach Section</h5>
                <div class="mb-4">
                    <label for="approach_title" class="text-xs">Approach Title</label>
                    <input type="text" name="approach_title" id="approach_title" value="{{ old('approach_title', $service->content_data['approach']['title'] ?? '') }}" placeholder="e.g. Our Proven Approach">
                </div>
                <div class="mb-4">
                    <label for="approach_description" class="text-xs">Approach Description (Paragraph 1)</label>
                    <textarea name="approach_description" id="approach_description" rows="3" placeholder="e.g. We follow a client-centric approach to deliver high-quality solutions.">{{ old('approach_description', $service->content_data['approach']['description'] ?? '') }}</textarea>
                </div>
                <div>
                    <label for="approach_description2" class="text-xs">Approach Description (Paragraph 2)</label>
                    <textarea name="approach_description2" id="approach_description2" rows="3" placeholder="e.g. Our team ensures seamless communication throughout the project life cycle.">{{ old('approach_description2', $service->content_data['approach']['description2'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- 4. Solutions -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">4. Solutions Grid</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="solutions_title" class="text-xs">Section Title</label>
                        <input type="text" name="solutions_title" id="solutions_title" value="{{ old('solutions_title', $service->content_data['solutions_title'] ?? '') }}" placeholder="e.g. Comprehensive Solutions">
                    </div>
                    <div>
                        <label for="solutions_subtitle" class="text-xs">Section Subtitle</label>
                        <input type="text" name="solutions_subtitle" id="solutions_subtitle" value="{{ old('solutions_subtitle', $service->content_data['solutions_subtitle'] ?? '') }}" placeholder="e.g. Tailored solutions for your business.">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Solutions</label>
                    <div id="solutions-container" class="space-y-2">
                        @php $solutions = $service->content_data['solutions'] ?? []; @endphp
                        @foreach($solutions as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="solutions[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. Enterprise Solutions">
                                <input type="text" name="solutions[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Scalable systems for large operations.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('solutions')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Solution</button>
                </div>
            </div>

            <!-- 5. CTA -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">5. CTA Banners</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="cta_title" class="text-xs">CTA 1 Title</label>
                        <input type="text" name="cta_title" id="cta_title" value="{{ old('cta_title', $service->content_data['cta']['title'] ?? '') }}" placeholder="e.g. Want to Consult Our Experts?">
                    </div>
                    <div>
                        <label for="cta_subtitle" class="text-xs">CTA 1 Subtitle</label>
                        <input type="text" name="cta_subtitle" id="cta_subtitle" value="{{ old('cta_subtitle', $service->content_data['cta']['subtitle'] ?? '') }}" placeholder="e.g. Contact our team today!">
                    </div>
                    <div>
                        <label for="cta_button" class="text-xs">CTA 1 Button Text</label>
                        <input type="text" name="cta_button" id="cta_button" value="{{ old('cta_button', $service->content_data['cta']['button'] ?? '') }}" placeholder="e.g. Connect With Us Today">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="cta2_title" class="text-xs">CTA 2 Title</label>
                        <input type="text" name="cta2_title" id="cta2_title" value="{{ old('cta2_title', $service->content_data['cta2']['title'] ?? '') }}" placeholder="e.g. Looking for Other Services?">
                    </div>
                    <div>
                        <label for="cta2_subtitle" class="text-xs">CTA 2 Subtitle</label>
                        <input type="text" name="cta2_subtitle" id="cta2_subtitle" value="{{ old('cta2_subtitle', $service->content_data['cta2']['subtitle'] ?? '') }}" placeholder="e.g. Explore our other offerings.">
                    </div>
                    <div>
                        <label for="cta2_button" class="text-xs">CTA 2 Button Text</label>
                        <input type="text" name="cta2_button" id="cta2_button" value="{{ old('cta2_button', $service->content_data['cta2']['button'] ?? '') }}" placeholder="e.g. Let's Connect">
                    </div>
                </div>
            </div>

            <!-- 6. Achievements -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">6. Achievements</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Achievements</label>
                    <div id="achievements-container" class="space-y-2">
                        @php $achievements = $service->content_data['achievements'] ?? []; @endphp
                        @foreach($achievements as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="achievements[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. 500+">
                                <input type="text" name="achievements[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Projects Delivered">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('achievements')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Achievement</button>
                </div>
            </div>

            <!-- 7. Testimonials -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">7. Testimonials</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Testimonials</label>
                    <div id="testimonials-container" class="space-y-2">
                        @php $testimonials = $service->content_data['testimonials'] ?? []; @endphp
                        @foreach($testimonials as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="testimonials[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. John Doe">
                                <input type="text" name="testimonials[{{ $i }}][role]" value="{{ $item['role'] ?? '' }}" class="text-sm py-1 w-full" placeholder="e.g. CEO at TechCorp">
                                <input type="text" name="testimonials[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Great service!">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('testimonials')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Testimonial</button>
                </div>
            </div>

            <!-- 8. Process -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">8. Development Process</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="process_title" class="text-xs">Section Title</label>
                        <input type="text" name="process_title" id="process_title" value="{{ old('process_title', $service->content_data['process_title'] ?? '') }}" placeholder="e.g. Our Development Process">
                    </div>
                    <div>
                        <label for="process_subtitle" class="text-xs">Section Subtitle</label>
                        <input type="text" name="process_subtitle" id="process_subtitle" value="{{ old('process_subtitle', $service->content_data['process_subtitle'] ?? '') }}" placeholder="e.g. How we bring your idea to life.">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="process_image" class="text-xs">Process Section Image</label>
                    @if(isset($service->content_data['process_image']))
                        <div class="w-20 h-20 mb-2">
                            <img src="{{ Storage::url($service->content_data['process_image']) }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" name="process_image" id="process_image" class="text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Steps</label>
                    <div id="process-container" class="space-y-2">
                        @php $process = $service->content_data['process'] ?? []; @endphp
                        @foreach($process as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="process[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. 01. Discovery">
                                <input type="text" name="process[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. We analyze requirements.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('process')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Step</button>
                </div>
            </div>

            <!-- 9. Frameworks -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">9. Frameworks / Technologies</h5>
                <div class="mb-4">
                    <label for="frameworks_title" class="text-xs">Section Title</label>
                    <input type="text" name="frameworks_title" id="frameworks_title" value="{{ old('frameworks_title', $service->content_data['frameworks_title'] ?? '') }}" placeholder="e.g. Technologies We Use">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Frameworks</label>
                    <div id="frameworks-container" class="space-y-2">
                        @php $frameworks = $service->content_data['frameworks'] ?? []; @endphp
                        @foreach($frameworks as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="frameworks[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. Laravel">
                                <input type="text" name="frameworks[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. PHP Framework">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('frameworks')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Framework</button>
                </div>
            </div>

            <!-- 10. FAQs -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">10. FAQs</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">FAQs</label>
                    <div id="faqs-container" class="space-y-2">
                        @php $faqs = $service->content_data['faqs'] ?? []; @endphp
                        @foreach($faqs as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="faqs[{{ $i }}][title]" value="{{ $item['title'] ?? $item['question'] ?? '' }}" class="text-sm py-1 w-full" placeholder="e.g. What is the timeline?">
                                <input type="text" name="faqs[{{ $i }}][description]" value="{{ $item['description'] ?? $item['answer'] ?? '' }}" class="text-sm py-1 w-full" placeholder="e.g. It depends on scope.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('faqs')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add FAQ</button>
                </div>
            </div>

            <!-- 11. Why Choose Us -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">11. Why Choose Us</h5>
                <div class="mb-4">
                    <label for="why_choose_title" class="text-xs">Section Title</label>
                    <input type="text" name="why_choose_title" id="why_choose_title" value="{{ old('why_choose_title', $service->content_data['why_choose']['title'] ?? '') }}" placeholder="e.g. Why Choose Us?">
                </div>
                <div class="mb-4">
                    <label for="why_choose_description" class="text-xs">Description</label>
                    <textarea name="why_choose_description" id="why_choose_description" rows="3" placeholder="e.g. We are committed to delivering excellence.">{{ old('why_choose_description', $service->content_data['why_choose']['description'] ?? '') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="why_choose_image" class="text-xs">Section Image</label>
                    @if(isset($service->content_data['why_choose_image']))
                        <div class="w-20 h-20 mb-2">
                            <img src="{{ Storage::url($service->content_data['why_choose_image']) }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" name="why_choose_image" id="why_choose_image" class="text-sm">
                </div>
                <div>
                    <label for="why_choose_points_raw" class="text-xs">Highlights (one per line)</label>
                    <textarea name="why_choose_points_raw" id="why_choose_points_raw" rows="4" placeholder="e.g.
Expert Team
On-time Delivery
Scalable Solutions">@if(isset($service->content_data['why_choose_points']))@foreach($service->content_data['why_choose_points'] as $h){{ $h }}
@endforeach @endif</textarea>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label>Current Image</label>
                @if($service->image)
                    <div class="relative group w-40 h-24 mb-4">
                        <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full rounded-xl object-cover border border-slate-200 shadow-sm" alt="">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                            <span class="text-white text-xs font-bold uppercase tracking-wider">Current</span>
                        </div>
                    </div>
                @else
                    <div class="w-40 h-24 mb-4 bg-slate-50 border border-slate-200 border-dashed rounded-xl flex items-center justify-center text-slate-400 italic text-xs">
                        No image
                    </div>
                @endif
                
                <label for="image" class="text-xs text-slate-500 font-semibold mb-2">Change Image</label>
                <input type="file" name="image" id="image" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm w-full">
            </div>

            <div>
                <label for="order">Display Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $service->order) }}">
                
                <div class="mt-8 flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                    <label for="is_active" class="ml-2 mb-0 cursor-pointer text-slate-600 font-medium">Active (Visible on website)</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.services.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Update Service
            </button>
        </div>
    </form>
</div>

<script>
function addRow(section) {
    const container = document.getElementById(`${section}-container`);
    const index = Date.now(); // Use timestamp as unique index
    
    let html = '';
    if (section === 'testimonials') {
        html = `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                <input type="text" name="${section}[${index}][title]" class="text-sm py-1 w-full" placeholder="e.g. John Doe">
                <input type="text" name="${section}[${index}][role]" class="text-sm py-1 w-full" placeholder="e.g. CEO at TechCorp">
                <input type="text" name="${section}[${index}][description]" class="text-sm py-1 w-full" placeholder="e.g. Great service!">
                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
            </div>
        `;
    } else {
        html = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                <input type="text" name="${section}[${index}][title]" class="text-sm py-1 w-full" placeholder="e.g. Title">
                <input type="text" name="${section}[${index}][description]" class="text-sm py-1 w-full" placeholder="e.g. Description">
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
