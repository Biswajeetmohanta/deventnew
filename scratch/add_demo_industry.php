<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Industry;
use Illuminate\Support\Str;

$slug = 'retail-ecommerce';
$industry = Industry::where('slug', $slug)->first();

$content_data = [
    'banner' => [
        'title' => 'Retail & E-commerce Software Development',
        'subtitle' => 'Scalable, secure, and innovative solutions to drive your retail business forward.',
    ],
    'highlights' => [
        'Custom E-commerce Platforms',
        'Omnichannel Retail Solutions',
        'POS & Inventory Management',
        'Secure Payment Gateway Integration',
    ],
    'features_title' => 'Key Features of Our Retail Solutions',
    'features' => [
        [
            'title' => 'Real-time Inventory',
            'description' => 'Track stock levels across all physical and online stores instantly.',
        ],
        [
            'title' => 'Personalized Shopping',
            'description' => 'AI-driven product recommendations based on user behavior.',
        ],
        [
            'title' => 'Secure Checkout',
            'description' => 'PCI-compliant payment processing with multiple gateway supports.',
        ],
    ],
    'solutions_title' => 'Comprehensive E-commerce Solutions',
    'solutions_subtitle' => 'We cover all aspects of modern digital commerce.',
    'solutions' => [
        [
            'title' => 'B2C E-commerce Platforms',
            'description' => 'Feature-rich online stores designed to convert visitors into customers.',
        ],
        [
            'title' => 'B2B Trade Portals',
            'description' => 'Bulk ordering, custom pricing, and corporate account management.',
        ],
        [
            'title' => 'POS System Integration',
            'description' => 'Bridge the gap between your physical store and online presence.',
        ],
    ],
    'process_title' => 'Our Development Workflow',
    'process_subtitle' => 'How we bring your retail vision to life.',
    'process' => [
        [
            'title' => 'Discovery & Planning',
            'description' => 'We analyze your business needs and define the project scope.',
        ],
        [
            'title' => 'UI/UX Design',
            'description' => 'Creating engaging and intuitive shopping experiences.',
        ],
        [
            'title' => 'Development',
            'description' => 'Building secure, scalable, and high-performance code.',
        ],
        [
            'title' => 'Launch & Support',
            'description' => 'Deploying the platform and providing continuous updates.',
        ],
    ],
    'frameworks_title' => 'Technologies We Specialize In',
    'frameworks' => [
        [
            'title' => 'Shopify',
            'description' => 'Rapid deployment for standard e-commerce needs.',
        ],
        [
            'title' => 'Magento',
            'description' => 'Enterprise-grade flexibility and scalability.',
        ],
        [
            'title' => 'Laravel',
            'description' => 'Custom development for unique business logic.',
        ],
    ],
    'faqs' => [
        [
            'title' => 'How long does it take to build a custom e-commerce site?',
            'description' => 'Typically 3 to 6 months depending on the complexity and integrations required.',
        ],
        [
            'title' => 'Do you provide post-launch support?',
            'description' => 'Yes, we provide 24/7 monitoring and regular maintenance packages.',
        ],
    ],
    'why_choose' => [
        'title' => 'Why Partner with Devent?',
        'description' => 'We have a proven track record of delivering successful retail solutions.',
    ],
    'why_choose_points' => [
        '10+ Years of Experience',
        'Dedicated Team of Experts',
        'On-time and On-budget Delivery',
    ],
    'testimonials' => [
        [
            'title' => 'John Doe',
            'subtitle' => 'CEO, RetailCorp',
            'description' => 'Devent transformed our brick-and-mortar store into a thriving online business. Their expertise is unmatched.',
        ],
    ],
    'statistics' => [
        [
            'title' => '50+',
            'description' => 'E-commerce Stores Launched',
        ],
        [
            'title' => '$10M+',
            'description' => 'Processed in Sales',
        ],
    ],
    'seo' => [
        'meta_title' => 'Retail & E-commerce Software Development | Devent',
        'meta_description' => 'Custom retail and e-commerce software development services by Devent Technology.',
    ],
];

if ($industry) {
    $industry->update([
        'content_data' => $content_data,
        'description' => 'Custom technology solutions designed specifically for the unique demands and complexities of the Retail & E-commerce sector.',
    ]);
    echo "Updated existing industry: " . $industry->title . "\n";
} else {
    $industry = Industry::create([
        'title' => 'Retail & E-commerce',
        'slug' => $slug,
        'icon' => 'fa-solid fa-cart-shopping',
        'description' => 'Custom technology solutions designed specifically for the unique demands and complexities of the Retail & E-commerce sector.',
        'content_data' => $content_data,
    ]);
    echo "Created new industry: " . $industry->title . "\n";
}
