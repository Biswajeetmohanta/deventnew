<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalculatorSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Project Types
        $projectTypes = [
            [
                'key' => 'mobile',
                'name' => 'Mobile App',
                'min_price' => 8000.00,
                'max_price' => 25000.00,
                'icon' => 'fa-solid fa-mobile-screen-button',
                'description' => 'iOS / Android native or cross-platform applications'
            ],
            [
                'key' => 'web',
                'name' => 'Web App / SaaS',
                'min_price' => 6000.00,
                'max_price' => 20000.00,
                'icon' => 'fa-solid fa-laptop-code',
                'description' => 'Custom portals, internal tools or web dashboards'
            ],
            [
                'key' => 'ecommerce',
                'name' => 'E-Commerce Store',
                'min_price' => 4000.00,
                'max_price' => 15000.00,
                'icon' => 'fa-solid fa-cart-shopping',
                'description' => 'WooCommerce, Shopify or custom retail stores'
            ],
            [
                'key' => 'website',
                'name' => 'Corporate Website',
                'min_price' => 2000.00,
                'max_price' => 6000.00,
                'icon' => 'fa-solid fa-globe',
                'description' => 'Informational company, portfolio or landing pages'
            ],
        ];
        foreach ($projectTypes as $type) {
            \App\Models\CalculatorProjectType::updateOrCreate(['key' => $type['key']], $type);
        }

        // 2. Complexities
        $complexities = [
            [
                'key' => 'standard',
                'name' => 'Standard Layouts',
                'multiplier' => 1.0,
                'description' => 'Clean layouts utilizing framework designs. Optimized, fast-to-deploy.'
            ],
            [
                'key' => 'premium',
                'name' => 'Custom Figma Design',
                'multiplier' => 1.3,
                'description' => '100% tailor-made UI designed in Figma matching your precise branding rules.'
            ],
            [
                'key' => 'highend',
                'name' => 'Premium Animations',
                'multiplier' => 1.6,
                'description' => 'Immersive pages with dynamic web micro-interactions, custom animations, and complex styling.'
            ],
        ];
        foreach ($complexities as $comp) {
            \App\Models\CalculatorComplexity::updateOrCreate(['key' => $comp['key']], $comp);
        }

        // 3. Features
        $features = [
            [
                'key' => 'auth',
                'name' => 'User Authentication',
                'min_price' => 800.00,
                'max_price' => 1500.00,
                'description' => 'User Login, Signups & Profiles'
            ],
            [
                'key' => 'payment',
                'name' => 'Stripe Payments',
                'min_price' => 600.00,
                'max_price' => 1200.00,
                'description' => 'Payments & Subscriptions'
            ],
            [
                'key' => 'admin',
                'name' => 'Admin Dashboard',
                'min_price' => 1000.00,
                'max_price' => 2500.00,
                'description' => 'Content and database managers'
            ],
            [
                'key' => 'chat',
                'name' => 'Live Chat Support',
                'min_price' => 800.00,
                'max_price' => 1800.00,
                'description' => 'In-app notifications or instant chat'
            ],
            [
                'key' => 'multilang',
                'name' => 'Multi-Language Support',
                'min_price' => 500.00,
                'max_price' => 1000.00,
                'description' => 'Translating views to multiple locales'
            ],
            [
                'key' => 'api',
                'name' => 'Third-Party API Integration',
                'min_price' => 700.00,
                'max_price' => 1500.00,
                'description' => 'Connecting CRM, Maps, or external data'
            ],
        ];
        foreach ($features as $feat) {
            \App\Models\CalculatorFeature::updateOrCreate(['key' => $feat['key']], $feat);
        }

        // 4. Screens
        $screens = [
            ['key' => '1-5', 'name' => '1-5 Screens', 'multiplier' => 1.0],
            ['key' => '6-15', 'name' => '6-15 Screens', 'multiplier' => 1.25],
            ['key' => '16-30', 'name' => '16-30 Screens', 'multiplier' => 1.45],
            ['key' => '30+', 'name' => '30+ Screens', 'multiplier' => 1.75],
        ];
        foreach ($screens as $scr) {
            \App\Models\CalculatorScreen::updateOrCreate(['key' => $scr['key']], $scr);
        }

        // 5. Timelines
        $timelines = [
            ['key' => 'flexible', 'name' => 'Flexible Timeline', 'duration' => '3 to 6 months', 'multiplier' => 1.0],
            ['key' => 'normal', 'name' => 'Normal Timeline', 'duration' => '1 to 3 months', 'multiplier' => 1.15],
            ['key' => 'urgent', 'name' => 'Urgent Target', 'duration' => 'Under 1 month', 'multiplier' => 1.4],
        ];
        foreach ($timelines as $time) {
            \App\Models\CalculatorTimeline::updateOrCreate(['key' => $time['key']], $time);
        }
    }
}
