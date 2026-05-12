<?php

use App\Models\TeamRole;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$newRoles = [
    'hire-laravel-developer' => [
        'title' => 'Hire Laravel Developer',
        'content_data' => [
            'banner' => [
                'title' => 'Hire Expert <span style="color: #ef4444;">Laravel Developers</span>',
                'subtitle' => 'Scale your backend team with top-tier Laravel talent, vetted for building secure, scalable, and high-performance applications.',
                'badge' => 'TOP 1% VETTED TALENT',
                'stats_text' => 'Trusted by 150+ Enterprise Clients'
            ],
            'about' => [
                'title' => 'Why Hire Laravel Devs from Devent?',
                'description' => 'Our developers are masters of the Laravel ecosystem. They don\'t just write code; they architect enterprise-grade solutions with clean, maintainable codebases.',
                'label' => 'EXPERT TALENT'
            ],
            'why_choose_points' => ['Eloquent ORM Masters', 'API & Microservices Experts', 'Clean Code & PSR Standards', 'TDD & Automated Testing'],
            'why_choose' => [
                'title' => 'The Devent Advantage',
                'description' => 'We take the risk out of hiring. Our rigorous vetting process ensures you only get the best developers.',
                'stat1_value' => '48h', 'stat1_label' => 'Matching Time',
                'stat2_value' => '100%', 'stat2_label' => 'IP Protection',
                'stat3_value' => 'Flexible', 'stat3_label' => 'Engagement',
                'stat4_value' => 'Expert', 'stat4_label' => 'Project Mgmt'
            ],
            'hiring_models' => [
                ['title' => 'Dedicated Monthly', 'description' => 'A full-time developer focused exclusively on your project.', 'icon' => 'fa-solid fa-calendar-check'],
                ['title' => 'Hourly Basis', 'description' => 'Pay only for the hours worked, perfect for small tasks.', 'icon' => 'fa-solid fa-clock'],
                ['title' => 'Fixed Price', 'description' => 'Well-defined scope with a set budget and timeline.', 'icon' => 'fa-solid fa-file-contract']
            ],
            'skills' => [
                ['title' => 'Core Laravel', 'description' => 'Eloquent, Queues, Events, and Middleware.'],
                ['title' => 'API Dev', 'description' => 'RESTful & GraphQL API architecture.'],
                ['title' => 'Ecosystem', 'description' => 'Nova, Forge, Vapor, and Cashier.'],
                ['title' => 'Frontend Sync', 'description' => 'Inertia.js, Livewire, and Vue.js integration.']
            ],
            'faqs' => [
                ['title' => 'How soon can a developer start?', 'description' => 'Typically, we can match you with a developer within 48 to 72 hours.'],
                ['title' => 'Can I interview the developer?', 'description' => 'Yes, we encourage you to interview our shortlisted candidates to ensure a perfect fit.']
            ]
        ]
    ],
    'hire-python-developer' => [
        'title' => 'Hire Python Developer',
        'content_data' => [
            'banner' => [
                'title' => 'Hire Expert <span style="color: #3b82f6;">Python Developers</span>',
                'subtitle' => 'Accelerate your AI, Data Science, and Backend projects with world-class Python engineers.',
                'badge' => 'AI & DATA EXPERTS',
                'stats_text' => 'Powering Intelligent Solutions'
            ],
            'about' => [
                'title' => 'Why Hire Python Devs from Devent?',
                'description' => 'Our Python developers specialize in building intelligent systems, complex data pipelines, and high-performance backends.',
                'label' => 'DATA & AI TALENT'
            ],
            'why_choose_points' => ['AI & Machine Learning Pros', 'Django & FastAPI Experts', 'Data Engineering Masters', 'Automation Specialists'],
            'why_choose' => [
                'title' => 'The Devent Advantage',
                'description' => 'We take the risk out of hiring. Our rigorous vetting process ensures you only get the best developers.',
                'stat1_value' => '48h', 'stat1_label' => 'Matching Time',
                'stat2_value' => '100%', 'stat2_label' => 'IP Protection',
                'stat3_value' => 'Flexible', 'stat3_label' => 'Engagement',
                'stat4_value' => 'Expert', 'stat4_label' => 'Project Mgmt'
            ],
            'hiring_models' => [
                ['title' => 'Dedicated Monthly', 'description' => 'A full-time developer focused exclusively on your project.', 'icon' => 'fa-solid fa-calendar-check'],
                ['title' => 'Hourly Basis', 'description' => 'Pay only for the hours worked, perfect for small tasks.', 'icon' => 'fa-solid fa-clock'],
                ['title' => 'Fixed Price', 'description' => 'Well-defined scope with a set budget and timeline.', 'icon' => 'fa-solid fa-file-contract']
            ],
            'skills' => [
                ['title' => 'Frameworks', 'description' => 'Django, Flask, and FastAPI.'],
                ['title' => 'AI & ML', 'description' => 'TensorFlow, PyTorch, and Scikit-Learn.'],
                ['title' => 'Data Processing', 'description' => 'Pandas, NumPy, and ETL pipelines.'],
                ['title' => 'Automation', 'description' => 'Selenium, Web Scraping, and Scripting.']
            ],
            'faqs' => [
                ['title' => 'How soon can a developer start?', 'description' => 'Typically, we can match you with a developer within 48 to 72 hours.'],
                ['title' => 'Do they have experience with AI?', 'description' => 'Yes, our Python developers are heavily vetted for AI and Machine Learning capabilities.']
            ]
        ]
    ],
    'hire-uiux-designer' => [
        'title' => 'Hire UI/UX Designer',
        'content_data' => [
            'banner' => [
                'title' => 'Hire Expert <span style="color: #a855f7;">UI/UX Designers</span>',
                'subtitle' => 'Create stunning, user-centric interfaces that drive engagement and conversion for your digital products.',
                'badge' => 'CREATIVE MASTERS',
                'stats_text' => 'Designing Award-Winning UI'
            ],
            'about' => [
                'title' => 'Why Hire Designers from Devent?',
                'description' => 'Our designers don\'t just make things look pretty; they craft intuitive user journeys based on data, research, and psychological principles.',
                'label' => 'CREATIVE TALENT'
            ],
            'why_choose_points' => ['User-Centric Philosophy', 'Figma & Adobe XD Pros', 'Interactive Prototyping', 'Conversion Optimization'],
            'why_choose' => [
                'title' => 'The Devent Advantage',
                'description' => 'We take the risk out of hiring. Our rigorous vetting process ensures you only get the best designers.',
                'stat1_value' => '48h', 'stat1_label' => 'Matching Time',
                'stat2_value' => '100%', 'stat2_label' => 'IP Protection',
                'stat3_value' => 'Flexible', 'stat3_label' => 'Engagement',
                'stat4_value' => 'Expert', 'stat4_label' => 'Project Mgmt'
            ],
            'hiring_models' => [
                ['title' => 'Dedicated Monthly', 'description' => 'A full-time designer focused exclusively on your project.', 'icon' => 'fa-solid fa-calendar-check'],
                ['title' => 'Hourly Basis', 'description' => 'Pay only for the hours worked, perfect for small tasks.', 'icon' => 'fa-solid fa-clock'],
                ['title' => 'Project Basis', 'description' => 'Fixed scope for a complete redesign or new product.', 'icon' => 'fa-solid fa-file-contract']
            ],
            'skills' => [
                ['title' => 'UI Design', 'description' => 'Visual design, typography, and color theory.'],
                ['title' => 'UX Research', 'description' => 'User interviews, personas, and journey mapping.'],
                ['title' => 'Prototyping', 'description' => 'High-fidelity interactive prototypes in Figma.'],
                ['title' => 'Design Systems', 'description' => 'Building scalable component libraries.']
            ],
            'faqs' => [
                ['title' => 'How soon can a designer start?', 'description' => 'Typically, we can match you with a designer within 48 to 72 hours.'],
                ['title' => 'Can we see their portfolio?', 'description' => 'Absolutely. We will provide detailed case studies and portfolios for all shortlisted candidates.']
            ]
        ]
    ],
    'hire-mobile-developer' => [
        'title' => 'Hire Mobile App Developer',
        'content_data' => [
            'banner' => [
                'title' => 'Hire Expert <span style="color: #10b981;">Mobile Developers</span>',
                'subtitle' => 'Build high-performance iOS and Android applications with our top-tier mobile engineers.',
                'badge' => 'MOBILE MASTERS',
                'stats_text' => 'Top Rated on App Stores'
            ],
            'about' => [
                'title' => 'Why Hire Mobile Devs from Devent?',
                'description' => 'Our developers specialize in cross-platform and native mobile apps, ensuring fluid performance, offline capabilities, and native feel.',
                'label' => 'MOBILE TALENT'
            ],
            'why_choose_points' => ['React Native & Flutter Pros', 'Native iOS/Android Experts', 'Fluid UI Animations', 'App Store Deployment'],
            'why_choose' => [
                'title' => 'The Devent Advantage',
                'description' => 'We take the risk out of hiring. Our rigorous vetting process ensures you only get the best developers.',
                'stat1_value' => '48h', 'stat1_label' => 'Matching Time',
                'stat2_value' => '100%', 'stat2_label' => 'IP Protection',
                'stat3_value' => 'Flexible', 'stat3_label' => 'Engagement',
                'stat4_value' => 'Expert', 'stat4_label' => 'Project Mgmt'
            ],
            'hiring_models' => [
                ['title' => 'Dedicated Monthly', 'description' => 'A full-time developer focused exclusively on your project.', 'icon' => 'fa-solid fa-calendar-check'],
                ['title' => 'Hourly Basis', 'description' => 'Pay only for the hours worked, perfect for small tasks.', 'icon' => 'fa-solid fa-clock'],
                ['title' => 'Fixed Price', 'description' => 'Well-defined scope with a set budget and timeline.', 'icon' => 'fa-solid fa-file-contract']
            ],
            'skills' => [
                ['title' => 'Cross-Platform', 'description' => 'React Native and Flutter.'],
                ['title' => 'Native', 'description' => 'Swift (iOS) and Kotlin (Android).'],
                ['title' => 'APIs', 'description' => 'Seamless integration with backend services.'],
                ['title' => 'Hardware', 'description' => 'Camera, GPS, and Bluetooth integration.']
            ],
            'faqs' => [
                ['title' => 'How soon can a developer start?', 'description' => 'Typically, we can match you with a developer within 48 to 72 hours.'],
                ['title' => 'Do they handle app store submission?', 'answer' => 'Yes, our developers manage the entire submission process for both Apple App Store and Google Play Store.']
            ]
        ]
    ]
];

foreach ($newRoles as $slug => $data) {
    TeamRole::updateOrCreate(
        ['slug' => $slug],
        [
            'title' => $data['title'],
            'content_data' => $data['content_data']
        ]
    );
    echo "Successfully created/updated Team Role: {$slug}\n";
}

echo "Done! Added more professional hiring roles to the submenu.\n";
