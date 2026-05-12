<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $technologies = Technology::latest()->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.technologies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'logo' => 'nullable|image|max:2048',
            'category' => 'required|string',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['content_data'] = $this->buildContentData($request);

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadImageDirect($request->file('logo'), 'technologies');
        }

        Technology::create($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology added successfully.');
    }

    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'name' => 'required|max:255',
            'logo' => 'nullable|image|max:2048',
            'category' => 'required|string',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['content_data'] = $this->buildContentData($request, $technology);

        if ($request->hasFile('logo')) {
            if ($technology->logo) {
                $this->deleteImageDirect($technology->logo);
            }
            $data['logo'] = $this->uploadImageDirect($request->file('logo'), 'technologies');
        }

        $technology->update($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology updated successfully.');
    }

    public function destroy(Technology $technology)
    {
        if ($technology->logo) {
            $this->deleteImageDirect($technology->logo);
        }
        
        // Delete section images if any
        if (isset($technology->content_data['intro_image'])) {
            $this->deleteImageDirect($technology->content_data['intro_image']);
        }
        if (isset($technology->content_data['process_image'])) {
            $this->deleteImageDirect($technology->content_data['process_image']);
        }

        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted successfully.');
    }

    /**
     * Build the content_data array from all raw form fields.
     */
    private function buildContentData(Request $request, Technology $technology = null)
    {
        $cd = [];

        // Handle File Uploads for specific sections
        if ($request->hasFile('intro_image')) {
            if ($technology && isset($technology->content_data['intro_image'])) {
                $this->deleteImageDirect($technology->content_data['intro_image']);
            }
            $cd['intro_image'] = $this->uploadImageDirect($request->file('intro_image'), 'technologies');
        } elseif ($technology && isset($technology->content_data['intro_image'])) {
            $cd['intro_image'] = $technology->content_data['intro_image'];
        }

        if ($request->hasFile('process_image')) {
            if ($technology && isset($technology->content_data['process_image'])) {
                $this->deleteImageDirect($technology->content_data['process_image']);
            }
            $cd['process_image'] = $this->uploadImageDirect($request->file('process_image'), 'technologies');
        } elseif ($technology && isset($technology->content_data['process_image'])) {
            $cd['process_image'] = $technology->content_data['process_image'];
        }

        // 1. Hero/Banner
        if ($request->filled('banner_title') || $request->filled('banner_subtitle')) {
            $cd['banner'] = [
                'title' => $request->banner_title ?? '',
                'subtitle' => $request->banner_subtitle ?? '',
            ];
        }

        // 2. Breadcrumbs
        if ($request->filled('breadcrumb_title')) {
            $cd['breadcrumb_title'] = $request->breadcrumb_title;
        }

        // 3. Technology Introduction
        if ($request->filled('intro_title') || $request->filled('intro_description')) {
            $cd['intro'] = [
                'title' => $request->intro_title ?? '',
                'description' => $request->intro_description ?? '',
            ];
        }

        // 4. About Technology
        if ($request->filled('about_title') || $request->filled('about_description')) {
            $cd['about'] = [
                'title' => $request->about_title ?? '',
                'description' => $request->about_description ?? '',
            ];
        }

        // 5. Services/Solutions
        if ($request->filled('solutions_title')) {
            $cd['solutions_title'] = $request->solutions_title;
        }
        if ($request->has('solutions')) {
            $cd['solutions'] = array_filter($request->solutions, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['solutions'] = array_values($cd['solutions']);
        }

        // 6. Features/Benefits
        if ($request->filled('features_title')) {
            $cd['features_title'] = $request->features_title;
        }
        if ($request->has('features')) {
            $cd['features'] = array_filter($request->features, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['features'] = array_values($cd['features']);
        }

        // 7. Process
        if ($request->filled('process_title')) {
            $cd['process_title'] = $request->process_title;
        }
        if ($request->has('process')) {
            $cd['process'] = array_filter($request->process, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['process'] = array_values($cd['process']);
        }

        // 8. Why Choose Us
        if ($request->filled('why_choose_title') || $request->filled('why_choose_description')) {
            $cd['why_choose'] = [
                'title' => $request->why_choose_title ?? '',
                'description' => $request->why_choose_description ?? '',
            ];
        }

        // 9. Industries We Serve
        if ($request->has('industries_served')) {
            $cd['industries_served'] = array_filter($request->industries_served, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['industries_served'] = array_values($cd['industries_served']);
        }

        // 10. Engagement Models
        if ($request->has('engagement_models')) {
            $cd['engagement_models'] = array_filter($request->engagement_models, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['engagement_models'] = array_values($cd['engagement_models']);
        }

        // 11. Hiring Model/Team
        if ($request->filled('hiring_title') || $request->filled('hiring_description')) {
            $cd['hiring'] = [
                'title' => $request->hiring_title ?? '',
                'description' => $request->hiring_description ?? '',
            ];
        }

        // 12. Statistics
        if ($request->has('statistics')) {
            $cd['statistics'] = array_filter($request->statistics, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['statistics'] = array_values($cd['statistics']);
        }

        // 13. Technology Stack/Tools
        if ($request->has('tech_stack')) {
            $cd['tech_stack'] = array_filter($request->tech_stack, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['tech_stack'] = array_values($cd['tech_stack']);
        }

        // 14. FAQs
        if ($request->has('faqs')) {
            $cd['faqs'] = array_filter($request->faqs, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['faqs'] = array_values($cd['faqs']);
        }

        // 15. Testimonials
        if ($request->has('testimonials')) {
            $cd['testimonials'] = array_filter($request->testimonials, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['testimonials'] = array_values($cd['testimonials']);
        }

        // 16. CTA Sections
        if ($request->filled('cta_title') || $request->filled('cta_subtitle')) {
            $cd['cta'] = [
                'title' => $request->cta_title ?? '',
                'subtitle' => $request->cta_subtitle ?? '',
                'button' => $request->cta_button ?? 'Contact Us',
            ];
        }

        // 19. SEO Meta
        if ($request->filled('meta_title') || $request->filled('meta_description') || $request->filled('meta_keywords')) {
            $cd['seo'] = [
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'meta_keywords' => $request->meta_keywords ?? '',
            ];
        }

        return $cd;
    }
}
