<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class IndustryController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $industries = Industry::latest()->get();
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'icon' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['content_data'] = $this->buildContentData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'industries');
        }

        Industry::create($data);

        return redirect()->route('admin.industries.index')->with('success', 'Industry added successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'icon' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['content_data'] = $this->buildContentData($request, $industry);

        if ($request->hasFile('image')) {
            if ($industry->image) {
                $this->deleteImageDirect($industry->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'industries');
        }

        $industry->update($data);

        return redirect()->route('admin.industries.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        if ($industry->image) {
            $this->deleteImageDirect($industry->image);
        }
        
        // Delete section images if any
        if (isset($industry->content_data['why_choose_image'])) {
            $this->deleteImageDirect($industry->content_data['why_choose_image']);
        }
        if (isset($industry->content_data['process_image'])) {
            $this->deleteImageDirect($industry->content_data['process_image']);
        }

        $industry->delete();
        return redirect()->route('admin.industries.index')->with('success', 'Industry deleted successfully.');
    }

    /**
     * Build the content_data array from all raw form fields.
     */
    private function buildContentData(Request $request, Industry $industry = null)
    {
        $cd = [];

        // Handle File Uploads for specific sections
        if ($request->hasFile('why_choose_image')) {
            if ($industry && isset($industry->content_data['why_choose_image'])) {
                $this->deleteImageDirect($industry->content_data['why_choose_image']);
            }
            $cd['why_choose_image'] = $this->uploadImageDirect($request->file('why_choose_image'), 'industries');
        } elseif ($industry && isset($industry->content_data['why_choose_image'])) {
            $cd['why_choose_image'] = $industry->content_data['why_choose_image'];
        }

        if ($request->hasFile('process_image')) {
            if ($industry && isset($industry->content_data['process_image'])) {
                $this->deleteImageDirect($industry->content_data['process_image']);
            }
            $cd['process_image'] = $this->uploadImageDirect($request->file('process_image'), 'industries');
        } elseif ($industry && isset($industry->content_data['process_image'])) {
            $cd['process_image'] = $industry->content_data['process_image'];
        }

        // Banner
        if ($request->filled('banner_title') || $request->filled('banner_subtitle')) {
            $cd['banner'] = [
                'title' => $request->banner_title ?? '',
                'subtitle' => $request->banner_subtitle ?? '',
            ];
        }

        // Highlights
        if ($request->filled('highlights_raw')) {
            $cd['highlights'] = $this->parseSimpleLines($request->highlights_raw);
        }

        // Features / Benefits
        if ($request->filled('features_title')) {
            $cd['features_title'] = $request->features_title;
        }
        if ($request->has('features')) {
            $cd['features'] = array_filter($request->features, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['features'] = array_values($cd['features']);
        }

        // Solutions / Services
        if ($request->filled('solutions_title')) {
            $cd['solutions_title'] = $request->solutions_title;
        }
        if ($request->filled('solutions_subtitle')) {
            $cd['solutions_subtitle'] = $request->solutions_subtitle;
        }
        if ($request->has('solutions')) {
            $cd['solutions'] = array_filter($request->solutions, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['solutions'] = array_values($cd['solutions']);
        }

        // CTA 1
        if ($request->filled('cta_title') || $request->filled('cta_subtitle')) {
            $cd['cta'] = [
                'title' => $request->cta_title ?? '',
                'subtitle' => $request->cta_subtitle ?? '',
                'button' => $request->cta_button ?? 'Contact Us',
            ];
        }

        // CTA 2
        if ($request->filled('cta2_title') || $request->filled('cta2_subtitle')) {
            $cd['cta2'] = [
                'title' => $request->cta2_title ?? '',
                'subtitle' => $request->cta2_subtitle ?? '',
                'button' => $request->cta2_button ?? 'Get Started',
            ];
        }

        // Process
        if ($request->filled('process_title')) {
            $cd['process_title'] = $request->process_title;
        }
        if ($request->filled('process_subtitle')) {
            $cd['process_subtitle'] = $request->process_subtitle;
        }
        if ($request->has('process')) {
            $cd['process'] = array_filter($request->process, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['process'] = array_values($cd['process']);
        }

        // Frameworks / Tech Stack
        if ($request->filled('frameworks_title')) {
            $cd['frameworks_title'] = $request->frameworks_title;
        }
        if ($request->has('frameworks')) {
            $cd['frameworks'] = array_filter($request->frameworks, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['frameworks'] = array_values($cd['frameworks']);
        }

        // FAQs
        if ($request->has('faqs')) {
            $cd['faqs'] = array_filter($request->faqs, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['faqs'] = array_values($cd['faqs']);
        }

        // Why Choose Us
        if ($request->filled('why_choose_title') || $request->filled('why_choose_description')) {
            $cd['why_choose'] = [
                'title' => $request->why_choose_title ?? '',
                'description' => $request->why_choose_description ?? '',
            ];
        }
        if ($request->filled('why_choose_points_raw')) {
            $cd['why_choose_points'] = $this->parseSimpleLines($request->why_choose_points_raw);
        }

        // Testimonials
        if ($request->has('testimonials')) {
            $cd['testimonials'] = array_filter($request->testimonials, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['testimonials'] = array_values($cd['testimonials']);
        }

        // Statistics / Counters
        if ($request->has('statistics')) {
            $cd['statistics'] = array_filter($request->statistics, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['statistics'] = array_values($cd['statistics']);
        }

        // SEO Meta
        if ($request->filled('meta_title') || $request->filled('meta_description')) {
            $cd['seo'] = [
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
            ];
        }

        return $cd;
    }

    private function parseSimpleLines($text)
    {
        if (empty($text)) return [];
        return array_values(array_filter(array_map('trim', explode("\n", $text))));
    }
}
