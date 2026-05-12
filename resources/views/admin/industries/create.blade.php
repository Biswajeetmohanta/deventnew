@extends('admin.layouts.admin')

@section('title', 'Add New Industry')
@section('page_title', 'Create Industry')

@section('content')
<div class="glass p-8 rounded-3xl max-w-4xl mx-auto">
    <form action="{{ route('admin.industries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title">Industry Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="e.g. Retail & E-commerce">
            </div>

            <div>
                <label for="icon">FontAwesome Icon</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}" placeholder="fa-solid fa-cart-shopping">
            </div>
        </div>

        <div>
            <label for="description">Short Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Briefly describe the industry...">{{ old('description') }}</textarea>
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
                        <input type="text" name="banner_title" id="banner_title" value="{{ old('banner_title') }}" placeholder="e.g. Retail Software Development Services">
                    </div>
                    <div>
                        <label for="banner_subtitle" class="text-xs">Banner Subtitle</label>
                        <input type="text" name="banner_subtitle" id="banner_subtitle" value="{{ old('banner_subtitle') }}" placeholder="e.g. Scalable solutions for modern retail.">
                    </div>
                </div>
                <div>
                    <label for="highlights_raw" class="text-xs">Bullet Highlights (one per line)</label>
                    <textarea name="highlights_raw" id="highlights_raw" rows="4" placeholder="e.g.
Custom E-commerce Platforms
POS Integration
Omnichannel Solutions">{{ old('highlights_raw') }}</textarea>
                </div>
            </div>

            <!-- 2. Features / Benefits -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">2. Features / Benefits</h5>
                <div class="mb-4">
                    <label for="features_title" class="text-xs">Section Title</label>
                    <input type="text" name="features_title" id="features_title" value="{{ old('features_title') }}" placeholder="e.g. Key Features of Our Solutions">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Features</label>
                    <div id="features-container" class="space-y-2">
                        @php $features = old('features', []); @endphp
                        @foreach($features as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="features[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. Real-time Inventory">
                                <input type="text" name="features[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Track stock across all channels.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('features')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Feature</button>
                </div>
            </div>

            <!-- 3. Solutions / Services -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">3. Solutions / Services</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="solutions_title" class="text-xs">Section Title</label>
                        <input type="text" name="solutions_title" id="solutions_title" value="{{ old('solutions_title') }}" placeholder="e.g. Comprehensive E-commerce Solutions">
                    </div>
                    <div>
                        <label for="solutions_subtitle" class="text-xs">Section Subtitle</label>
                        <input type="text" name="solutions_subtitle" id="solutions_subtitle" value="{{ old('solutions_subtitle') }}" placeholder="e.g. We cover all aspects of retail tech.">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Solutions</label>
                    <div id="solutions-container" class="space-y-2">
                        @php $solutions = old('solutions', []); @endphp
                        @foreach($solutions as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="solutions[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. B2B E-commerce">
                                <input type="text" name="solutions[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. Scalable platforms for business trade.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('solutions')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Solution</button>
                </div>
            </div>

            <!-- 4. Process -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">4. Development Process</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="process_title" class="text-xs">Section Title</label>
                        <input type="text" name="process_title" id="process_title" value="{{ old('process_title') }}" placeholder="e.g. Our Development Workflow">
                    </div>
                    <div>
                        <label for="process_subtitle" class="text-xs">Section Subtitle</label>
                        <input type="text" name="process_subtitle" id="process_subtitle" value="{{ old('process_subtitle') }}" placeholder="e.g. How we deliver success.">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="process_image" class="text-xs">Process Section Image</label>
                    <input type="file" name="process_image" id="process_image" class="text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Steps</label>
                    <div id="process-container" class="space-y-2">
                        @php $process = old('process', []); @endphp
                        @foreach($process as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="process[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. 01. Strategy">
                                <input type="text" name="process[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. We plan the architecture.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('process')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Step</button>
                </div>
            </div>

            <!-- 5. Frameworks / Tech Stack -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">5. Technology Stack</h5>
                <div class="mb-4">
                    <label for="frameworks_title" class="text-xs">Section Title</label>
                    <input type="text" name="frameworks_title" id="frameworks_title" value="{{ old('frameworks_title') }}" placeholder="e.g. Technologies We Specialize In">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Frameworks</label>
                    <div id="frameworks-container" class="space-y-2">
                        @php $frameworks = old('frameworks', []); @endphp
                        @foreach($frameworks as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="frameworks[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. Magento">
                                <input type="text" name="frameworks[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. E-commerce platform.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('frameworks')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Framework</button>
                </div>
            </div>

            <!-- 6. FAQs -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">6. FAQs</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">FAQs</label>
                    <div id="faqs-container" class="space-y-2">
                        @php $faqs = old('faqs', []); @endphp
                        @foreach($faqs as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="faqs[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. How long does it take?">
                                <input type="text" name="faqs[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. It depends on features.">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('faqs')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add FAQ</button>
                </div>
            </div>

            <!-- 7. Why Choose Us -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">7. Why Choose Us</h5>
                <div class="mb-4">
                    <label for="why_choose_title" class="text-xs">Section Title</label>
                    <input type="text" name="why_choose_title" id="why_choose_title" value="{{ old('why_choose_title') }}" placeholder="e.g. Why Partner with Devent?">
                </div>
                <div class="mb-4">
                    <label for="why_choose_description" class="text-xs">Description</label>
                    <textarea name="why_choose_description" id="why_choose_description" rows="3" placeholder="e.g. We deliver enterprise-grade solutions.">{{ old('why_choose_description') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="why_choose_image" class="text-xs">Section Image</label>
                    <input type="file" name="why_choose_image" id="why_choose_image" class="text-sm">
                </div>
                <div>
                    <label for="why_choose_points_raw" class="text-xs">Highlights (one per line)</label>
                    <textarea name="why_choose_points_raw" id="why_choose_points_raw" rows="4" placeholder="e.g.
Expert Developers
On-time Delivery
Scalable Architecture">{{ old('why_choose_points_raw') }}</textarea>
                </div>
            </div>

            <!-- 8. Statistics / Counters -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">8. Statistics / Counters</h5>
                <div>
                    <label class="text-xs font-semibold text-slate-600 mb-2 block">Statistics</label>
                    <div id="statistics-container" class="space-y-2">
                        @php $statistics = old('statistics', []); @endphp
                        @foreach($statistics as $i => $item)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
                                <input type="text" name="statistics[{{ $i }}][title]" value="{{ $item['title'] }}" class="text-sm py-1 w-full" placeholder="e.g. 100+">
                                <input type="text" name="statistics[{{ $i }}][description]" value="{{ $item['description'] }}" class="text-sm py-1 w-full" placeholder="e.g. E-commerce Sites Built">
                                <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addRow('statistics')" class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-semibold">+ Add Statistic</button>
                </div>
            </div>

            <!-- 9. SEO Meta -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6">
                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">9. SEO Meta Tags</h5>
                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="text-xs">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" placeholder="e.g. Retail & E-commerce Software Development | Devent">
                    </div>
                    <div>
                        <label for="meta_description" class="text-xs">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" placeholder="e.g. We provide custom retail and e-commerce software development services.">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="image">Featured Image</label>
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
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.industries.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Save Industry
            </button>
        </div>
    </form>
</div>

<script>
function addRow(section) {
    const container = document.getElementById(`${section}-container`);
    const index = Date.now(); // Use timestamp as unique index
    
    let html = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 bg-white rounded-lg border border-slate-100 row-item relative">
            <input type="text" name="${section}[${index}][title]" class="text-sm py-1 w-full" placeholder="e.g. Title">
            <input type="text" name="${section}[${index}][description]" class="text-sm py-1 w-full" placeholder="e.g. Description">
            <button type="button" onclick="this.closest('.row-item').remove()" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-200">×</button>
        </div>
    `;
    
    const div = document.createElement('div');
    div.innerHTML = html.trim();
    container.appendChild(div.firstChild);
}
</script>
@endsection
