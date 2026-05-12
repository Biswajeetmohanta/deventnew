<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamRoleController extends Controller
{
    use HandlesDirectImageUploads;

    public function index()
    {
        $roles = TeamRole::orderBy('order')->get();
        return view('admin.team-roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.team-roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:team_roles,slug',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $data = $request->all();
        $data['content_data'] = $this->buildContentData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'team_roles');
        }

        TeamRole::create($data);

        return redirect()->route('admin.team-roles.index')->with('success', 'Team Role added successfully.');
    }

    public function edit(TeamRole $teamRole)
    {
        return view('admin.team-roles.edit', compact('teamRole'));
    }

    public function update(Request $request, TeamRole $teamRole)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:team_roles,slug,' . $teamRole->id,
            'icon' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $data = $request->all();
        $data['content_data'] = $this->buildContentData($request, $teamRole);

        if ($request->hasFile('image')) {
            if ($teamRole->image) {
                $this->deleteImageDirect($teamRole->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'team_roles');
        }

        $teamRole->update($data);

        return redirect()->route('admin.team-roles.index')->with('success', 'Team Role updated successfully.');
    }

    public function destroy(TeamRole $teamRole)
    {
        if ($teamRole->image) {
            $this->deleteImageDirect($teamRole->image);
        }
        
        // Delete section images if any
        if (isset($teamRole->content_data['about_image'])) {
            $this->deleteImageDirect($teamRole->content_data['about_image']);
        }
        if (isset($teamRole->content_data['process_image'])) {
            $this->deleteImageDirect($teamRole->content_data['process_image']);
        }

        $teamRole->delete();
        return redirect()->route('admin.team-roles.index')->with('success', 'Team Role deleted successfully.');
    }

    private function buildContentData(Request $request, TeamRole $role = null)
    {
        $cd = [];

        // Handle File Uploads for specific sections
        if ($request->hasFile('about_image')) {
            if ($role && isset($role->content_data['about_image'])) {
                $this->deleteImageDirect($role->content_data['about_image']);
            }
            $cd['about_image'] = $this->uploadImageDirect($request->file('about_image'), 'team_roles');
        } elseif ($role && isset($role->content_data['about_image'])) {
            $cd['about_image'] = $role->content_data['about_image'];
        }

        if ($request->hasFile('process_image')) {
            if ($role && isset($role->content_data['process_image'])) {
                $this->deleteImageDirect($role->content_data['process_image']);
            }
            $cd['process_image'] = $this->uploadImageDirect($request->file('process_image'), 'team_roles');
        } elseif ($role && isset($role->content_data['process_image'])) {
            $cd['process_image'] = $role->content_data['process_image'];
        }

        // 1. Hero/Banner
        if ($request->filled('banner_title') || $request->filled('banner_subtitle') || $request->filled('banner_badge')) {
            $cd['banner'] = [
                'title' => $request->banner_title ?? '',
                'subtitle' => $request->banner_subtitle ?? '',
                'badge' => $request->banner_badge ?? 'HIRE DEVELOPERS',
                'video_url' => $request->banner_video_url ?? '#',
                'stats_text' => $request->banner_stats_text ?? 'Joined by 500+ Companies',
            ];
        }

        // 2. About Service
        if ($request->filled('about_title') || $request->filled('about_description')) {
            $cd['about'] = [
                'title' => $request->about_title ?? '',
                'label' => $request->about_label ?? 'Overview',
                'description' => $request->about_description ?? '',
            ];
        }

        // 3. Why Choose Us / Stats
        if ($request->filled('why_choose_title') || $request->filled('why_choose_description')) {
            $cd['why_choose'] = [
                'title' => $request->why_choose_title ?? '',
                'description' => $request->why_choose_description ?? '',
                'stat1_value' => $request->why_choose_stat1_value ?? '10+',
                'stat1_label' => $request->why_choose_stat1_label ?? 'Years Experience',
                'stat2_value' => $request->why_choose_stat2_value ?? '500+',
                'stat2_label' => $request->why_choose_stat2_label ?? 'Success Stories',
                'stat3_value' => $request->why_choose_stat3_value ?? '150+',
                'stat3_label' => $request->why_choose_stat3_label ?? 'Expert Vetted Devs',
                'stat4_value' => $request->why_choose_stat4_value ?? '99%',
                'stat4_label' => $request->why_choose_stat4_label ?? 'Client Retention',
            ];
        }

        // 11. CTA Section
        if ($request->filled('cta_title') || $request->filled('cta_subtitle')) {
            $cd['cta'] = [
                'title' => $request->cta_title ?? 'Ready to scale your team?',
                'subtitle' => $request->cta_subtitle ?? 'Talk to our talent experts today and find the perfect match for your project.',
                'button' => $request->cta_button ?? 'Book a Consultation',
            ];
        }

        // Additional Banner Button
        if ($request->filled('banner_button_text')) {
            $cd['banner']['button_text'] = $request->banner_button_text;
        } else {
            $cd['banner']['button_text'] = 'Hire Developers Now';
        }
        if ($request->has('why_choose_points')) {
            $cd['why_choose_points'] = array_filter($request->why_choose_points);
        }

        // 4. Hiring Models
        if ($request->filled('hiring_models_title')) {
            $cd['hiring_models_title'] = $request->hiring_models_title;
            $cd['hiring_models'] = array_filter($request->hiring_models ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 5. Developer Skills
        if ($request->filled('skills_title')) {
            $cd['skills_title'] = $request->skills_title;
            $cd['skills'] = array_filter($request->skills ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 6. Development Process
        if ($request->filled('process_title')) {
            $cd['process_title'] = $request->process_title;
            $cd['process'] = array_filter($request->process ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 7. Technologies
        if ($request->filled('tech_title')) {
            $cd['tech_title'] = $request->tech_title;
            $cd['tech_stack'] = array_filter($request->tech_stack ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 8. Benefits
        if ($request->filled('benefits_title')) {
            $cd['benefits_title'] = $request->benefits_title;
            $cd['benefits'] = array_filter($request->benefits ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 9. Engagement Models
        if ($request->filled('engagement_title')) {
            $cd['engagement_title'] = $request->engagement_title;
            $cd['engagement_models'] = array_filter($request->engagement_models ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 10. FAQ
        if ($request->filled('faqs_title')) {
            $cd['faqs_title'] = $request->faqs_title;
            $cd['faqs'] = array_filter($request->faqs ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 11. CTA Section
        if ($request->filled('cta_title') || $request->filled('cta_subtitle')) {
            $cd['cta'] = [
                'title' => $request->cta_title ?? '',
                'subtitle' => $request->cta_subtitle ?? '',
                'button' => $request->cta_button ?? 'Hire Now',
            ];
        }

        // 12. Testimonials
        if ($request->filled('testimonials_title')) {
            $cd['testimonials_title'] = $request->testimonials_title;
            $cd['testimonials'] = array_filter($request->testimonials ?? [], function($item) {
                return !empty(trim($item['title'] ?? ''));
            });
        }

        // 13. SEO
        if ($request->filled('meta_title') || $request->filled('meta_description')) {
            $cd['seo'] = [
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'meta_keywords' => $request->meta_keywords ?? '',
            ];
        }

        return $cd;
    }
}
