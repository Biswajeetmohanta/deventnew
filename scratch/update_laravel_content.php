<?php
use App\Models\Technology;

$laravel = Technology::find(1);
if (!$laravel) {
    echo "Laravel technology not found!";
    exit;
}

$content_data = [
    'banner' => [
        'title' => 'Premier Laravel Development Company',
        'subtitle' => 'Unleash the full potential of PHP with the most elegant and powerful framework. We build enterprise-grade systems with speed and precision.',
        'badge' => '🐘 The PHP Framework for Web Artisans',
        'video_url' => 'https://www.youtube.com/watch?v=376vZ1wNYPA'
    ],
    'statistics' => [
        ['title' => '250+', 'description' => 'Laravel Projects'],
        ['title' => '99.9%', 'description' => 'System Reliability'],
        ['title' => '15+', 'description' => 'Full-Stack Experts'],
        ['title' => '3x', 'description' => 'Faster Development']
    ],
    'intro' => [
        'title' => 'Why Laravel is the Gold Standard',
        'description' => 'Laravel provides a robust foundation for building modern web applications. From its expressive syntax to its comprehensive security features, it allows us to focus on your business logic instead of boilerplate code.'
    ],
    'about' => [
        'title' => 'Artisanal Backend Engineering',
        'description' => 'We specialize in crafting bespoke web applications that are as beautiful on the inside (code) as they are on the outside (UI). Our Laravel solutions are built for longevity and scalability.',
        'detailed_overview' => 'At Devent, we utilize the latest Laravel versions to build secure authentication, complex data migrations, and high-performance APIs. We are experts in the TALL stack (Tailwind, Alpine, Laravel, Livewire) and Inertia.js, ensuring your application is modern, reactive, and incredibly fast.'
    ],
    'highlights' => [
        'Expressive Eloquent ORM',
        'Blade Templating Engine',
        'Built-in Security Features',
        'Database Migrations & Seeding',
        'Powerful Queue Management',
        'Comprehensive Ecosystem'
    ],
    'solutions_label' => 'LARAVEL SERVICES',
    'solutions_title' => 'Our Specialized Laravel Development Solutions',
    'solutions' => [
        ['title' => 'Custom Web Portals', 'description' => 'Enterprise-grade portals with complex permissions and workflows.'],
        ['title' => 'E-commerce Solutions', 'description' => 'Highly scalable online stores built with Laravel and Livewire.'],
        ['title' => 'API & Microservices', 'description' => 'Secure, documented RESTful APIs for mobile and web integration.'],
        ['title' => 'SaaS Product Development', 'description' => 'Multi-tenant applications with recurring billing and analytics.'],
        ['title' => 'Legacy App Modernization', 'description' => 'Migrating old PHP applications to the modern Laravel framework.'],
        ['title' => 'Third-party Integrations', 'description' => 'Connecting your app with Stripe, Twilio, Salesforce, and more.']
    ],
    'features_title' => 'Technical Advantages of Using Laravel',
    'features' => [
        ['title' => 'Rapid Development', 'description' => 'Artisan CLI and built-in features reduce time-to-market significantly.'],
        ['title' => 'Unmatched Security', 'description' => 'Protection against SQL injection, cross-site request forgery, and XSS.'],
        ['title' => 'Easy Maintenance', 'description' => 'Clean, standardized code structure makes updates painless.'],
        ['title' => 'Seamless Testing', 'description' => 'Built-in support for PHPUnit ensuring your app works perfectly.'],
        ['title' => 'Scalable Performance', 'description' => 'Excellent caching and database optimization capabilities.'],
        ['title' => 'Community Power', 'description' => 'A vibrant ecosystem with thousands of pre-built packages.']
    ],
    'advantages' => [
        ['title' => 'Developer Happiness', 'description' => 'Eloquent ORM makes database work a joy.'],
        ['title' => 'Cost-Effective', 'description' => 'Open-source with no licensing fees and fast delivery.'],
        ['title' => 'Enterprise Ready', 'description' => 'Capable of handling millions of requests with ease.'],
        ['title' => 'Modern Tooling', 'description' => 'Laravel Vite, Forge, and Vapor for elite deployment.']
    ],
    'process_title' => 'Our Laravel Development Lifecycle',
    'process' => [
        ['title' => 'Database Schema Design', 'description' => 'Creating optimized migrations for data integrity.'],
        ['title' => 'Core Engine Development', 'description' => 'Building the business logic and service layers.'],
        ['title' => 'Frontend Integration', 'description' => 'Seamlessly connecting Blade or Inertia with your UI.'],
        ['title' => 'Security Hardening', 'description' => 'Rigorous audits for authentication and data protection.'],
        ['title' => 'Automated Testing', 'description' => 'Running CI/CD pipelines with comprehensive test suites.'],
        ['title' => 'Cloud Deployment', 'description' => 'Zero-downtime deployment using Forge or Vapor.']
    ],
    'why_choose' => [
        'title' => 'The Devent Standard in Laravel',
        'description' => 'We follow PSR standards and clean code principles to ensure your application is a technical masterpiece.'
    ],
    'industries_title' => 'Industries We Serve with Laravel',
    'industries_served' => [
        ['title' => 'Enterprise', 'description' => 'fa-solid fa-briefcase'],
        ['title' => 'E-Learning', 'description' => 'fa-solid fa-graduation-cap'],
        ['title' => 'Finance', 'description' => 'fa-solid fa-money-bill-trend-up'],
        ['title' => 'Logistics', 'description' => 'fa-solid fa-truck-fast']
    ],
    'engagement_title' => 'Work With Us',
    'engagement_models' => [
        ['title' => 'Fixed Price', 'description' => 'Defined scope for startups and established projects.'],
        ['title' => 'Monthly Retainer', 'description' => 'Ongoing support, maintenance, and feature updates.'],
        ['title' => 'Hybrid Model', 'description' => 'A mix of fixed milestones and flexible hourly work.']
    ],
    'hiring' => [
        'title' => 'Scale With Expert Laravel Talent',
        'description' => 'Hire top-tier Laravel developers to accelerate your product roadmap and ensure quality.'
    ],
    'tech_stack_title' => 'Our Laravel Ecosystem',
    'tech_stack' => [
        ['title' => 'Backend', 'description' => 'Laravel 11.x, PHP 8.3, Livewire'],
        ['title' => 'Frontend', 'description' => 'Tailwind CSS, Alpine.js, Inertia.js'],
        ['title' => 'Database', 'description' => 'MySQL, PostgreSQL, Redis'],
        ['title' => 'DevOps', 'description' => 'Laravel Forge, Docker, Github Actions']
    ],
    'faqs_title' => 'Laravel Development FAQs',
    'faqs' => [
        ['title' => 'Can Laravel handle high-traffic applications?', 'description' => 'Yes, with proper caching and horizontal scaling, Laravel powers some of the world\'s largest platforms.'],
        ['title' => 'How do you handle application security?', 'description' => 'We use Laravel\'s built-in protection and add extra layers of validation and security headers.'],
        ['title' => 'Do you provide maintenance for existing Laravel apps?', 'description' => 'Yes, we specialize in refactoring and upgrading legacy Laravel projects.']
    ],
    'testimonials_title' => 'Artisan Excellence: Client Feedback',
    'testimonials' => [
        ['title' => 'Mark Wilson', 'subtitle' => 'Operations Director, LogiTrack', 'description' => 'Devent built our core logistics platform in record time. The Laravel backend is rock solid and handles 50k orders daily.'],
        ['title' => 'Jessica Low', 'subtitle' => 'Founder, EduPeak', 'description' => 'The flexibility of their Laravel solutions allowed us to pivot our business model three times without a rewrite.']
    ],
    'expert_consultation' => [
        'title' => 'Planning a Complex Laravel Project?',
        'description' => 'Consult with our senior architects to design a scalable, secure, and future-proof application architecture.',
        'button' => 'Consult a Laravel Expert'
    ],
    'cta' => [
        'title' => 'Transform Your Business with Laravel',
        'subtitle' => 'Let\'s build a web application that sets you apart from the competition.',
        'button' => 'Start Your Laravel Journey'
    ],
    'seo' => [
        'meta_title' => 'Top Laravel Development Company | Devent',
        'meta_description' => 'Expert Laravel development services for enterprise applications and SaaS products. Hire professional Laravel developers today.',
        'meta_keywords' => 'laravel development, php framework, backend development, web artisans'
    ]
];

$laravel->content_data = $content_data;
$laravel->save();

echo "Laravel content updated successfully!";
