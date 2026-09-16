<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Service;
use App\Models\Industry;
use App\Models\Technology;
use App\Models\CaseStudy;
use App\Models\Post;
use App\Models\TeamRole;
use App\Models\Career;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for SEO crawlers.
     */
    public function index(): Response
    {
        $services = Service::where('is_active', true)->get();
        $industries = Industry::all();
        $technologies = Technology::where('is_active', true)->get();
        $caseStudies = CaseStudy::where('is_active', true)->get();
        $posts = Post::where('status', 'published')->get();
        $teamRoles = TeamRole::where('is_active', true)->get();
        $careers = Career::where('is_open', true)->get();

        $staticPages = [
            ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => url('/services'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => url('/about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/portfolio'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/industry'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/technology'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/case-studies'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/build-your-team'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/blog'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/careers'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => url('/testimonials'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => url('/certificates'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => url('/price-calculator'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => url('/contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/privacy-policy'), 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        $content = view('sitemap', compact(
            'staticPages',
            'services',
            'industries',
            'technologies',
            'caseStudies',
            'posts',
            'teamRoles',
            'careers'
        ))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
