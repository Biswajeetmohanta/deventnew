<?php

use App\Models\TeamRole;
use Illuminate\Support\Str;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$roles = [
    [
        'title' => 'Hire React Developer',
        'slug' => 'hire-react-developer',
        'icon' => 'fa-brands fa-react',
        'order' => 1,
        'content_data' => [
            'banner' => [
                'title' => 'Hire Expert <span style="color: #61DAFB;">React Developers</span>',
                'subtitle' => 'Scale your business with highly skilled, vetted React.js experts dedicated to building high-performance web applications.',
                'badge' => '⚡ TOP 1% VETTED TALENT',
                'video_url' => '#',
                'stats_text' => 'Joined by 500+ Tech Leaders',
                'button_text' => 'Hire React Experts',
            ],
            'about' => [
                'label' => 'EXECUTIVE OVERVIEW',
                'title' => 'Dedicated React.js Development Services',
                'description' => "Our React developers are experts in building scalable, SEO-friendly, and interactive user interfaces. Whether you need to build a new product from scratch or scale your existing team, we provide the right talent to meet your goals.\n\nWe focus on code quality, performance optimization, and seamless user experiences."
            ],
            'hiring_models_title' => 'Flexible Hiring Models',
            'hiring_models' => [
                ['title' => 'Dedicated Team', 'description' => 'A full-time team dedicated solely to your project.', 'icon' => 'fa-solid fa-users'],
                ['title' => 'Hourly Basis', 'description' => 'Pay only for the hours worked on your tasks.', 'icon' => 'fa-solid fa-clock'],
                ['title' => 'Fixed Price', 'description' => 'Defined scope and timeline with a fixed budget.', 'icon' => 'fa-solid fa-file-invoice-dollar']
            ],
            'skills_title' => 'Core Technical Expertise',
            'skills' => [
                ['title' => 'State Management', 'description' => 'Redux, Context API, MobX'],
                ['title' => 'Modern Hooks', 'description' => 'Custom hooks and performance optimization'],
                ['title' => 'Next.js / SSR', 'description' => 'Server-side rendering and static site generation'],
                ['title' => 'API Integration', 'description' => 'RESTful and GraphQL APIs']
            ],
            'why_choose_title' => 'Why Devent for React?',
            'why_choose_description' => 'We combine technical excellence with business-focused delivery.',
            'why_choose_stat1_value' => '12+',
            'why_choose_stat1_label' => 'Years in React',
            'why_choose_stat2_value' => '200+',
            'why_choose_stat2_label' => 'React Apps Built',
            'why_choose_stat3_value' => '80+',
            'why_choose_stat3_label' => 'Vetted React Devs',
            'why_choose_stat4_value' => '98%',
            'why_choose_stat4_label' => 'Success Rate',
            'why_choose_points' => [
                'Vetted & Experienced Developers',
                'Agile Development Process',
                'Time Zone Compatibility',
                'Direct Communication'
            ],
            'process_title' => 'Our 4-Step Hiring Process',
            'process' => [
                ['title' => 'Requirement Analysis', 'description' => 'We understand your technical and cultural needs.'],
                ['title' => 'Shortlisting', 'description' => 'We pick the best candidates from our pool.'],
                ['title' => 'Technical Interview', 'description' => 'You interview and vet the developers directly.'],
                ['title' => 'Onboarding', 'description' => 'Smooth integration into your existing team workflow.']
            ],
            'faqs_title' => 'React Hiring FAQs',
            'faqs' => [
                ['title' => 'How soon can I start?', 'description' => 'Typically, we can onboard a developer within 48 to 72 hours.'],
                ['title' => 'Do you provide maintenance?', 'description' => 'Yes, we offer ongoing support and maintenance services.']
            ],
            'cta' => [
                'title' => 'Ready to build your React app?',
                'subtitle' => 'Consult with our experts today and hire the best React talent.',
                'button' => 'Start Your React Project',
            ],
            'seo' => [
                'meta_title' => 'Hire Dedicated React Developers | Devent Technology',
                'meta_description' => 'Looking to hire React developers? Get vetted, top-tier React.js experts for your project. Flexible hiring models and competitive pricing.'
            ]
        ]
    ],
    [
        'title' => 'Hire Node.js Developer',
        'slug' => 'hire-nodejs-developer',
        'icon' => 'fa-brands fa-node-js',
        'order' => 2,
        'content_data' => [
            'banner' => [
                'title' => 'Build Scalable Backends with <span style="color: #68A063;">Node.js Experts</span>',
                'subtitle' => 'Hire experienced Node.js developers to build fast, real-time, and data-intensive server-side applications.',
                'badge' => '🚀 ENTERPRISE GRADE BACKENDS',
                'video_url' => '#',
                'stats_text' => 'Trusted by Fortune 500s',
                'button_text' => 'Hire Node.js Pros',
            ],
            'about' => [
                'label' => 'BACKEND EXPERTISE',
                'title' => 'Expert Node.js Development Talent',
                'description' => "Our Node.js developers specialize in building high-performance, asynchronous, and scalable backend systems. From microservices to real-time chat apps, we deliver robust server-side solutions."
            ],
            'hiring_models_title' => 'Our Engagement Models',
            'hiring_models' => [
                ['title' => 'Full-time Hire', 'description' => '160 hours per month dedicated to you.', 'icon' => 'fa-solid fa-calendar-check'],
                ['title' => 'Part-time Hire', 'description' => '80 hours per month for smaller projects.', 'icon' => 'fa-solid fa-user-clock'],
                ['title' => 'Project Based', 'description' => 'End-to-end delivery of a specific scope.', 'icon' => 'fa-solid fa-diagram-project']
            ],
            'skills_title' => 'Backend Prowess',
            'skills' => [
                ['title' => 'Express / NestJS', 'description' => 'Industry-standard frameworks'],
                ['title' => 'Microservices', 'description' => 'Scalable distributed architectures'],
                ['title' => 'Real-time (Socket.io)', 'description' => 'Bi-directional communication'],
                ['title' => 'Database Design', 'description' => 'MongoDB, PostgreSQL, Redis']
            ],
            'why_choose_title' => 'Why Our Node.js Developers?',
            'why_choose_description' => 'Performance, security, and scalability are our top priorities.',
            'why_choose_stat1_value' => '15+',
            'why_choose_stat1_label' => 'Core Node Devs',
            'why_choose_stat2_value' => '300+',
            'why_choose_stat2_label' => 'APIs Delivered',
            'why_choose_stat3_value' => '10M+',
            'why_choose_stat3_label' => 'Requests Handled',
            'why_choose_stat4_value' => '99.9%',
            'why_choose_stat4_label' => 'Uptime Guarantee',
            'why_choose_points' => [
                'Security First Approach',
                'High Performance Optimization',
                'Clean Architecture (SOLID)',
                'Automated Testing'
            ],
            'process_title' => 'The Hiring Journey',
            'process' => [
                ['title' => 'Discovery', 'description' => 'Defining the stack and expertise level.'],
                ['title' => 'Screening', 'description' => 'Rigorous technical and soft skills testing.'],
                ['title' => 'Client Review', 'description' => 'Final interview with your technical lead.'],
                ['title' => 'Integration', 'description' => 'Setup and project kickoff.']
            ],
            'faqs_title' => 'Backend Hiring FAQs',
            'faqs' => [
                ['title' => 'Can they work in my timezone?', 'description' => 'Yes, our developers provide at least 4 hours of overlap with your working hours.'],
                ['title' => 'Is there a trial period?', 'description' => 'We offer a risk-free 1-week trial for all new engagements.']
            ],
            'cta' => [
                'title' => 'Scale your backend today',
                'subtitle' => 'Hire top Node.js engineers to build your next-gen infrastructure.',
                'button' => 'Hire Node.js Developer',
            ],
            'seo' => [
                'meta_title' => 'Hire Node.js Developers | Dedicated Backend Experts',
                'meta_description' => 'Hire professional Node.js developers for scalable web applications. Vetted talent, flexible engagement, and 100% transparency.'
            ]
        ]
    ]
];

foreach ($roles as $roleData) {
    TeamRole::updateOrCreate(
        ['slug' => $roleData['slug']],
        $roleData
    );
}

echo "Data seeded successfully!\n";
