<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\Industry;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaseStudyController extends Controller
{
    use HandlesDirectImageUploads;

    /**
     * Display a listing of case studies in admin.
     */
    public function index()
    {
        $caseStudies = CaseStudy::with('industry')->latest()->paginate(10);
        return view('admin.case-studies.index', compact('caseStudies'));
    }

    /**
     * Show the form for creating a new case study.
     */
    public function create()
    {
        $industries = Industry::all();
        $technologies = Technology::all();
        return view('admin.case-studies.create', compact('industries', 'technologies'));
    }

    /**
     * Store a newly created case study in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'client' => 'nullable|string|max:255',
            'industry_id' => 'nullable|exists:industries,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'case_studies');
        }

        // Build dynamic content_data
        $data['content_data'] = $this->buildContentData($request);

        $caseStudy = CaseStudy::create($data);

        if ($request->has('technologies')) {
            $caseStudy->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study created successfully.');
    }

    /**
     * Show the form for editing the specified case study.
     */
    public function edit(CaseStudy $caseStudy)
    {
        $industries = Industry::all();
        $technologies = Technology::all();
        return view('admin.case-studies.edit', compact('caseStudy', 'industries', 'technologies'));
    }

    /**
     * Update the specified case study in storage.
     */
    public function update(Request $request, CaseStudy $caseStudy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'client' => 'nullable|string|max:255',
            'industry_id' => 'nullable|exists:industries,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($caseStudy->image) {
                $this->deleteImageDirect($caseStudy->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'case_studies');
        }

        // Build dynamic content_data
        $data['content_data'] = $this->buildContentData($request, $caseStudy);

        $caseStudy->update($data);

        if ($request->has('technologies')) {
            $caseStudy->technologies()->sync($request->technologies);
        } else {
            $caseStudy->technologies()->sync([]);
        }

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study updated successfully.');
    }

    /**
     * Remove the specified case study from storage.
     */
    public function destroy(CaseStudy $caseStudy)
    {
        if ($caseStudy->image) {
            $this->deleteImageDirect($caseStudy->image);
        }

        // Clean up nested images in content_data
        if (isset($caseStudy->content_data['why_choose_image'])) {
            $this->deleteImageDirect($caseStudy->content_data['why_choose_image']);
        }
        if (isset($caseStudy->content_data['process_image'])) {
            $this->deleteImageDirect($caseStudy->content_data['process_image']);
        }
        if (isset($caseStudy->content_data['challenge_image'])) {
            $this->deleteImageDirect($caseStudy->content_data['challenge_image']);
        }
        if (isset($caseStudy->content_data['solution_image'])) {
            $this->deleteImageDirect($caseStudy->content_data['solution_image']);
        }

        $caseStudy->delete();

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study deleted successfully.');
    }

    /**
     * Build the content_data array from all raw form fields.
     */
    private function buildContentData(Request $request, CaseStudy $caseStudy = null)
    {
        $cd = [];

        // Handle File Uploads for specific sections
        if ($request->hasFile('why_choose_image')) {
            if ($caseStudy && isset($caseStudy->content_data['why_choose_image'])) {
                $this->deleteImageDirect($caseStudy->content_data['why_choose_image']);
            }
            $cd['why_choose_image'] = $this->uploadImageDirect($request->file('why_choose_image'), 'case_studies');
        } elseif ($caseStudy && isset($caseStudy->content_data['why_choose_image'])) {
            $cd['why_choose_image'] = $caseStudy->content_data['why_choose_image'];
        }

        if ($request->hasFile('process_image')) {
            if ($caseStudy && isset($caseStudy->content_data['process_image'])) {
                $this->deleteImageDirect($caseStudy->content_data['process_image']);
            }
            $cd['process_image'] = $this->uploadImageDirect($request->file('process_image'), 'case_studies');
        } elseif ($caseStudy && isset($caseStudy->content_data['process_image'])) {
            $cd['process_image'] = $caseStudy->content_data['process_image'];
        }

        if ($request->hasFile('challenge_image')) {
            if ($caseStudy && isset($caseStudy->content_data['challenge_image'])) {
                $this->deleteImageDirect($caseStudy->content_data['challenge_image']);
            }
            $cd['challenge_image'] = $this->uploadImageDirect($request->file('challenge_image'), 'case_studies');
        } elseif ($caseStudy && isset($caseStudy->content_data['challenge_image'])) {
            $cd['challenge_image'] = $caseStudy->content_data['challenge_image'];
        }

        if ($request->hasFile('solution_image')) {
            if ($caseStudy && isset($caseStudy->content_data['solution_image'])) {
                $this->deleteImageDirect($caseStudy->content_data['solution_image']);
            }
            $cd['solution_image'] = $this->uploadImageDirect($request->file('solution_image'), 'case_studies');
        } elseif ($caseStudy && isset($caseStudy->content_data['solution_image'])) {
            $cd['solution_image'] = $caseStudy->content_data['solution_image'];
        }

        // Hero Banner
        if ($request->filled('banner_title') || $request->filled('banner_subtitle')) {
            $cd['banner'] = [
                'title' => $request->banner_title ?? '',
                'subtitle' => $request->banner_subtitle ?? '',
                'badge' => $request->banner_badge ?? 'CASE STUDY',
                'video_url' => $request->banner_video_url ?? '#',
            ];
        }

        // Highlights
        if ($request->filled('highlights_raw')) {
            $cd['highlights'] = $this->parseSimpleLines($request->highlights_raw);
        }

        // Project Overview
        if ($request->filled('overview_title') || $request->filled('overview_description')) {
            $cd['overview'] = [
                'title' => $request->overview_title ?? 'Project Overview',
                'description' => $request->overview_description ?? '',
            ];
        }

        // Challenge Section
        if ($request->filled('challenge_title') || $request->filled('challenge_description')) {
            $cd['challenge'] = [
                'title' => $request->challenge_title ?? 'The Challenge',
                'description' => $request->challenge_description ?? '',
            ];
        }

        // Solution Section
        if ($request->filled('solution_title') || $request->filled('solution_description')) {
            $cd['solution'] = [
                'title' => $request->solution_title ?? 'The Solution',
                'description' => $request->solution_description ?? '',
            ];
        }

        // Features
        if ($request->filled('features_title')) {
            $cd['features_title'] = $request->features_title;
        }
        if ($request->has('features')) {
            $cd['features'] = array_filter($request->features, function ($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['features'] = array_values($cd['features']);
        }

        // Approach Section
        if ($request->filled('approach_title') || $request->filled('approach_description')) {
            $cd['approach'] = [
                'title' => $request->approach_title ?? 'Our Strategic Approach',
                'description' => $request->approach_description ?? '',
            ];
            if ($request->filled('approach_description2')) {
                $cd['approach']['description2'] = $request->approach_description2;
            }
        }

        // CTA 1
        if ($request->filled('cta_title') || $request->filled('cta_subtitle')) {
            $cd['cta'] = [
                'title' => $request->cta_title ?? 'Want to Consult Our Experts?',
                'subtitle' => $request->cta_subtitle ?? '',
                'button' => $request->cta_button ?? 'Connect With Us Today',
            ];
        }

        // CTA 2
        if ($request->filled('cta2_title') || $request->filled('cta2_subtitle')) {
            $cd['cta2'] = [
                'title' => $request->cta2_title ?? 'Ready to Build Your Solution?',
                'subtitle' => $request->cta2_subtitle ?? '',
                'button' => $request->cta2_button ?? 'Get Started Now',
            ];
        }

        // Achievements / Results
        if ($request->has('achievements')) {
            $cd['achievements'] = array_filter($request->achievements, function ($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['achievements'] = array_values($cd['achievements']);
        }

        // Testimonials
        if ($request->has('testimonials')) {
            $cd['testimonials'] = array_filter($request->testimonials, function ($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['testimonials'] = array_values($cd['testimonials']);
        }

        // Process Section
        if ($request->filled('process_title')) {
            $cd['process_title'] = $request->process_title;
        }
        if ($request->filled('process_subtitle')) {
            $cd['process_subtitle'] = $request->process_subtitle;
        }
        if ($request->has('process')) {
            $cd['process'] = array_filter($request->process, function ($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['process'] = array_values($cd['process']);
        }

        // Frameworks
        if ($request->filled('frameworks_title')) {
            $cd['frameworks_title'] = $request->frameworks_title;
        }
        if ($request->has('frameworks')) {
            $cd['frameworks'] = array_filter($request->frameworks, function ($item) {
                return !empty(trim($item['title'] ?? ''));
            });
            $cd['frameworks'] = array_values($cd['frameworks']);
        }

        // FAQs
        if ($request->has('faqs')) {
            $cd['faqs'] = array_filter($request->faqs, function ($item) {
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
     * Parse simple lines (one value per line).
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
}
