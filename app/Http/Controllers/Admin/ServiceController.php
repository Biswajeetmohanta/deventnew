<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $services = Service::orderBy('order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['content_data'] = $this->buildContentData($request);
        
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'services');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        $data['content_data'] = $this->buildContentData($request, $service);

        if ($request->hasFile('image')) {
            if ($service->image) {
                $this->deleteImageDirect($service->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'services');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            $this->deleteImageDirect($service->image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    /**
     * Build the content_data array from all raw form fields.
     */
    private function buildContentData(Request $request, Service $service = null)
    {
        $cd = [];

        // Handle File Uploads for specific sections
        if ($request->hasFile('why_choose_image')) {
            if ($service && isset($service->content_data['why_choose_image'])) {
                $this->deleteImageDirect($service->content_data['why_choose_image']);
            }
            $cd['why_choose_image'] = $this->uploadImageDirect($request->file('why_choose_image'), 'services');
        } elseif ($service && isset($service->content_data['why_choose_image'])) {
            $cd['why_choose_image'] = $service->content_data['why_choose_image'];
        }

        if ($request->hasFile('process_image')) {
            if ($service && isset($service->content_data['process_image'])) {
                $this->deleteImageDirect($service->content_data['process_image']);
            }
            $cd['process_image'] = $this->uploadImageDirect($request->file('process_image'), 'services');
        } elseif ($service && isset($service->content_data['process_image'])) {
            $cd['process_image'] = $service->content_data['process_image'];
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

        // Features
        if ($request->filled('features_title')) {
            $cd['features_title'] = $request->features_title;
        }
        if ($request->has('features')) {
            $cd['features'] = array_filter($request->features, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['features'] = array_values($cd['features']);
        }

        // Approach
        if ($request->filled('approach_title') || $request->filled('approach_description')) {
            $cd['approach'] = [
                'title' => $request->approach_title ?? '',
                'description' => $request->approach_description ?? '',
            ];
            if ($request->filled('approach_description2')) {
                $cd['approach']['description2'] = $request->approach_description2;
            }
        }

        // Solutions
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

        // Achievements
        if ($request->has('achievements')) {
            $cd['achievements'] = array_filter($request->achievements, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['achievements'] = array_values($cd['achievements']);
        }

        // Testimonials
        if ($request->has('testimonials')) {
            $cd['testimonials'] = array_filter($request->testimonials, function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['testimonials'] = array_values($cd['testimonials']);
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

        // Frameworks
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

        return $cd;
    }

    /**
     * Parse "Title | Description" lines into array.
     */
    private function parseRawLines($rawText)
    {
        $items = [];
        if (empty($rawText)) return $items;
        
        $lines = explode("\n", $rawText);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = explode('|', $line);
            if (count($parts) >= 2) {
                $items[] = [
                    'title' => trim($parts[0]),
                    'description' => trim($parts[1]),
                ];
            } else {
                $items[] = [
                    'title' => $line,
                    'description' => '',
                ];
            }
        }
        return $items;
    }

    /**
     * Parse simple lines (one value per line, no pipe).
     */
    private function parseSimpleLines($rawText)
    {
        $items = [];
        if (empty($rawText)) return $items;
        
        $lines = explode("\n", $rawText);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                $items[] = $line;
            }
        }
        return $items;
    }

    /**
     * Parse "Name | Role | Quote" testimonials.
     */
    private function parseTestimonials($rawText)
    {
        $items = [];
        if (empty($rawText)) return $items;
        
        $lines = explode("\n", $rawText);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = explode('|', $line);
            if (count($parts) >= 3) {
                $items[] = [
                    'title' => trim($parts[0]),
                    'role' => trim($parts[1]),
                    'description' => trim($parts[2]),
                ];
            } elseif (count($parts) >= 2) {
                $items[] = [
                    'title' => trim($parts[0]),
                    'role' => '',
                    'description' => trim($parts[1]),
                ];
            }
        }
        return $items;
    }
}
