<?php

use App\Models\Industry;
use App\Models\Technology;
use App\Models\TeamRole;
use App\Models\Testimonial;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// --- INDUSTRIES ---
$industries = [
    'banking-finance' => [
        'banner' => [
            'title' => 'Digital Excellence in Banking & Finance',
            'subtitle' => 'Secure, compliant, and scalable fintech solutions designed for the future of money.',
            'badge' => 'FINTECH EXPERTS',
        ],
        'solutions' => [
            ['title' => 'Digital Banking', 'description' => 'Mobile-first banking experiences with real-time transactions.'],
            ['title' => 'Payment Gateways', 'description' => 'Secure and seamless payment processing integrations.'],
            ['title' => 'Wealth Management', 'description' => 'Advanced platforms for portfolio tracking and investment.'],
            ['title' => 'Compliance & Risk', 'description' => 'Automated KYC/AML and risk assessment systems.']
        ],
        'intro' => ['title' => 'Redefining Financial Services', 'description' => 'We help financial institutions navigate the complex digital landscape with secure and innovative software.'],
        'about' => ['title' => 'Your Trusted Fintech Partner', 'description' => 'With years of experience in the financial sector, we understand the critical importance of security and reliability.'],
        'highlights' => ['PCI DSS Compliance', 'Blockchain Integration', 'High-Frequency Trading', 'AI Fraud Detection'],
        'features' => [
            ['title' => 'Ultra-Secure Backend', 'description' => 'Encryption and security protocols that exceed industry standards.'],
            ['title' => 'Real-time Analytics', 'description' => 'Insights into financial trends and user behavior.'],
            ['title' => 'Cross-border Payments', 'description' => 'Efficient international transaction systems.']
        ],
        'statistics' => [
            ['title' => '$2B+', 'description' => 'Transactions Processed'],
            ['title' => '50+', 'description' => 'Financial Clients']
        ],
        'faqs' => [
            ['question' => 'How do you ensure data security?', 'answer' => 'We implement end-to-end encryption, multi-factor authentication, and regular security audits.'],
            ['question' => 'Are your solutions compliant?', 'answer' => 'Yes, we build with local and international financial regulations in mind.']
        ],
        'cta' => ['title' => 'Ready to Launch Your Fintech Product?', 'button' => 'Contact Our Experts']
    ],
    'ecommerce' => [
        'banner' => [
            'title' => 'Scale Your Sales with Premium Ecommerce',
            'subtitle' => 'We build high-conversion online stores that deliver exceptional shopping experiences.',
            'badge' => 'ECOMMERCE PROS',
        ],
        'solutions' => [
            ['title' => 'B2B Platforms', 'description' => 'Bulk ordering and wholesale management simplified.'],
            ['title' => 'Marketplace Apps', 'description' => 'Connect multiple vendors with a seamless platform.'],
            ['title' => 'DTC Stores', 'description' => 'Direct-to-consumer experiences that build brand loyalty.'],
            ['title' => 'Omnichannel Retail', 'description' => 'Sync your online and offline sales channels.']
        ],
        'intro' => ['title' => 'The Future of Online Retail', 'description' => 'Capture more market share with a website that is as fast as it is beautiful.'],
        'highlights' => ['One-Click Checkout', 'AI Recommendations', 'Inventory Sync', 'Mobile-First UI'],
        'statistics' => [
            ['title' => '35%', 'description' => 'Avg. Conversion Boost'],
            ['title' => '1M+', 'description' => 'Orders Processed']
        ],
        'cta' => ['title' => 'Transform Your Online Store Today', 'button' => 'Get Started']
    ],
    'education' => [
        'banner' => [
            'title' => 'Empowering Learning Through Technology',
            'subtitle' => 'Interactive and scalable EdTech solutions for schools, universities, and corporate training.',
            'badge' => 'EDTECH INNOVATORS',
        ],
        'solutions' => [
            ['title' => 'LMS Platforms', 'description' => 'Comprehensive learning management systems for all scales.'],
            ['title' => 'Virtual Classrooms', 'description' => 'Interactive real-time learning with video and whiteboards.'],
            ['title' => 'Assessment Tools', 'description' => 'Advanced testing and grading systems with proctoring.'],
            ['title' => 'Student Portals', 'description' => 'Centralized hubs for students to manage their journey.']
        ],
        'intro' => ['title' => 'Bridging the Knowledge Gap', 'description' => 'We build tools that make education accessible, engaging, and efficient for everyone.'],
        'highlights' => ['Gamified Learning', 'Mobile Learning', 'AI Tutoring', 'SCORM Compliant'],
        'statistics' => [
            ['title' => '500k+', 'description' => 'Active Students'],
            ['title' => '100+', 'description' => 'Educational Institutions']
        ],
        'cta' => ['title' => 'Build the Future of Learning', 'button' => 'Talk to Us']
    ],
    'business' => [
        'banner' => [
            'title' => 'Streamline Your Business Operations',
            'subtitle' => 'Custom enterprise software that optimizes workflows and scales with your growth.',
            'badge' => 'BUSINESS EFFICIENCY',
        ],
        'solutions' => [
            ['title' => 'Workflow Automation', 'description' => 'Eliminate manual tasks and reduce human error.'],
            ['title' => 'Resource Planning', 'description' => 'Comprehensive ERP solutions for better management.'],
            ['title' => 'Data Analytics', 'description' => 'Turn your business data into actionable insights.'],
            ['title' => 'Legacy Migration', 'description' => 'Modernize your old systems with minimal disruption.']
        ],
        'statistics' => [['title' => '40%', 'description' => 'Efficiency Gain'], ['title' => '200+', 'description' => 'Enterprise Clients']],
        'cta' => ['title' => 'Scale Your Business Today', 'button' => 'Consult an Expert']
    ],
    'food-restaurant' => [
        'banner' => [
            'title' => 'Next-Gen Restaurant Technology',
            'subtitle' => 'From online ordering to kitchen management, we build the tech that feeds your success.',
            'badge' => 'FOODTECH EXPERTS',
        ],
        'solutions' => [
            ['title' => 'Online Ordering', 'description' => 'Branded web and mobile ordering experiences.'],
            ['title' => 'POS Systems', 'description' => 'Seamless point-of-sale integrations.'],
            ['title' => 'Inventory Tracking', 'description' => 'Real-time monitoring of your stock and waste.'],
            ['title' => 'Delivery Management', 'description' => 'Efficient routing and driver tracking.']
        ],
        'statistics' => [['title' => '50%', 'description' => 'Direct Order Growth'], ['title' => '1k+', 'description' => 'Active Locations']],
        'cta' => ['title' => 'Ready to Serve More Customers?', 'button' => 'Talk to Our Team']
    ],
    'retail-ecommerce' => [
        'banner' => [
            'title' => 'Omnichannel Retail Solutions',
            'subtitle' => 'Connecting your physical and digital stores for a unified customer journey.',
            'badge' => 'RETAIL MASTERS',
        ],
        'solutions' => [
            ['title' => 'POS-Online Sync', 'description' => 'Unified inventory and customer data across all channels.'],
            ['title' => 'Customer Loyalty', 'description' => 'Digital rewards and personalized marketing tools.'],
            ['title' => 'Smart Checkout', 'description' => 'Fast and secure payment experiences.'],
            ['title' => 'Inventory Insights', 'description' => 'AI-driven forecasting and stock management.']
        ],
        'statistics' => [['title' => '$500M+', 'description' => 'Retail Revenue'], ['title' => '99%', 'description' => 'Inventory Accuracy']],
        'cta' => ['title' => 'Unified Your Retail Presence', 'button' => 'Contact Us']
    ]
];

foreach ($industries as $slug => $data) {
    $industry = Industry::where('slug', $slug)->first();
    if ($industry) {
        $industry->update(['content_data' => $data]);
        echo "Updated Industry: {$slug}\n";
    }
}

// --- TECHNOLOGIES ---
$technologies = [
    'laravel' => [
        'banner' => [
            'title' => 'Enterprise-Grade Laravel Development',
            'subtitle' => 'We leverage the PHP framework for web artisans to build robust and elegant backend systems.',
            'badge' => 'LARAVEL MASTERS',
        ],
        'statistics' => [
            ['title' => '100+', 'description' => 'Laravel Projects'],
            ['title' => '10+', 'description' => 'Certified Devs']
        ],
        'solutions' => [
            ['title' => 'SaaS Development', 'description' => 'Scalable multi-tenant platforms built on Laravel.'],
            ['title' => 'API Design', 'description' => 'RESTful and GraphQL APIs for web and mobile.'],
            ['title' => 'Custom Web Apps', 'description' => 'Tailored business tools with elegant architecture.'],
            ['title' => 'Microservices', 'description' => 'Distributed systems for high-scale environments.']
        ],
        'highlights' => ['Eloquent ORM', 'Blade Templating', 'Unit Testing', 'Queue Management'],
        'features' => [
            ['title' => 'Rapid Prototyping', 'description' => 'Go from idea to MVP faster than ever.'],
            ['title' => 'Built-in Security', 'description' => 'Protection against SQL injection, XSS, and CSRF.'],
            ['title' => 'Ecosystem Power', 'description' => 'Leveraging Forge, Vapor, and Nova for performance.']
        ],
        'cta' => ['title' => 'Build Your Next Masterpiece with Laravel', 'subtitle' => 'Contact us for a free technical consultation.']
    ],
    'react' => [
        'banner' => [
            'title' => 'High-Performance React Development',
            'subtitle' => 'Building lightning-fast and highly interactive user interfaces with the power of React.',
            'badge' => 'UI/UX EXPERTS',
        ],
        'statistics' => [
            ['title' => '200+', 'description' => 'React Components'],
            ['title' => '99', 'description' => 'Lighthouse Score']
        ],
        'solutions' => [
            ['title' => 'Single Page Apps', 'description' => 'Seamless transitions and app-like experiences in the browser.'],
            ['title' => 'Progressive Web Apps', 'description' => 'Installable web apps that work offline.'],
            ['title' => 'Design Systems', 'description' => 'Reusable component libraries for brand consistency.'],
            ['title' => 'Server-side Rendering', 'description' => 'SEO-friendly React apps with Next.js.']
        ],
        'highlights' => ['Virtual DOM', 'Component Architecture', 'Redux/Context API', 'React Hooks'],
        'cta' => ['title' => 'Deliver Stunning Experiences with React', 'subtitle' => 'Modernize your frontend today.']
    ],
    'php' => [
        'banner' => ['title' => 'Reliable PHP Development Services', 'subtitle' => 'Building the backbone of the web with secure and high-performance PHP code.', 'badge' => 'BACKEND PROS'],
        'statistics' => [['title' => '15+', 'description' => 'Years Expertise'], ['title' => '500+', 'description' => 'PHP Projects']],
        'cta' => ['title' => 'Need a Solid Backend?', 'button' => 'Contact Us']
    ],
    'nodejs' => [
        'banner' => ['title' => 'Real-time Node.js Solutions', 'subtitle' => 'High-concurrency and event-driven applications for modern web needs.', 'badge' => 'NODE.JS EXPERTS'],
        'statistics' => [['title' => '50k+', 'description' => 'Concurrent Users'], ['title' => '100+', 'description' => 'Real-time Apps']],
        'cta' => ['title' => 'Build Faster with Node.js', 'button' => 'Consult Experts']
    ],
    'mysql' => [
        'banner' => ['title' => 'Scalable Database Management', 'subtitle' => 'Architecting and optimizing data structures for performance and integrity.', 'badge' => 'DATABASE ARCHITECTS'],
        'statistics' => [['title' => '1TB+', 'description' => 'Data Managed'], ['title' => '99.9%', 'description' => 'Data Availability']],
        'cta' => ['title' => 'Secure Your Data', 'button' => 'Get a Quote']
    ],
    'tailwind-css' => [
        'banner' => ['title' => 'Modern Styling with Tailwind CSS', 'subtitle' => 'Rapid UI development with utility-first CSS for beautiful, responsive websites.', 'badge' => 'STYLING NINJAS'],
        'statistics' => [['title' => '0', 'description' => 'CSS Bloat'], ['title' => '100%', 'description' => 'Responsive Design']],
        'cta' => ['title' => 'Beautiful UI, Faster', 'button' => 'Start Designing']
    ],
    'react-native' => [
        'banner' => ['title' => 'Native Cross-Platform Apps', 'subtitle' => 'Build once, deploy everywhere with React Native excellence.', 'badge' => 'MOBILE INNOVATORS'],
        'statistics' => [['title' => '2M+', 'description' => 'App Users'], ['title' => '4.8', 'description' => 'App Store Rating']],
        'cta' => ['title' => 'Go Mobile Today', 'button' => 'Talk to Us']
    ],
    'python' => [
        'banner' => ['title' => 'AI & Data Science with Python', 'subtitle' => 'Unlocking the power of your data with intelligent Python algorithms.', 'badge' => 'AI & DATA EXPERTS'],
        'statistics' => [['title' => '95%', 'description' => 'ML Accuracy'], ['title' => '100+', 'description' => 'Data Pipelines']],
        'cta' => ['title' => 'Unleash AI Potential', 'button' => 'Contact Scientists']
    ]
];

foreach ($technologies as $slug => $data) {
    $tech = Technology::where('slug', $slug)->first();
    if ($tech) {
        $tech->update(['content_data' => $data]);
        echo "Updated Technology: {$slug}\n";
    }
}

// --- TEAM ROLES ---
$teamRoles = [
    'hire-react-developer' => [
        'banner' => [
            'title' => 'Hire Expert <span style="color: #6366f1;">React Developers</span>',
            'subtitle' => 'Scale your frontend team with top-tier React talent, vetted for technical excellence and cultural fit.',
            'badge' => 'TOP 1% VETTED TALENT',
            'stats_text' => 'Trusted by 200+ Startups'
        ],
        'about' => [
            'title' => 'Why Hire React Devs from Devent?',
            'description' => 'Our developers aren\'t just coders; they are problem solvers who understand state management, component lifecycle, and performance optimization.',
            'label' => 'OUR TALENT'
        ],
        'why_choose_points' => ['Expert in Hooks & Context', 'Redux & State Masters', 'Clean & Modular Code', 'Fluent Communication'],
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
            ['title' => 'Core React', 'description' => 'Hooks, Context, JSX, and Lifecycle.'],
            ['title' => 'Next.js', 'description' => 'SSR, SSG, and performance optimization.'],
            ['title' => 'State Mgmt', 'description' => 'Redux, MobX, and Zustand.'],
            ['title' => 'Styling', 'description' => 'Tailwind, Styled Components, and CSS Modules.']
        ],
        'faqs' => [
            ['title' => 'How soon can a developer start?', 'description' => 'Typically, we can match you with a developer within 48 to 72 hours.'],
            ['title' => 'Can I interview the developer?', 'description' => 'Yes, we encourage you to interview our shortlisted candidates to ensure a perfect fit.']
        ],
        'cta' => ['title' => 'Build Your Dream Team Today', 'button' => 'Schedule an Interview']
    ],
    'hire-nodejs-developer' => [
        'banner' => [
            'title' => 'Hire Vetted <span style="color: #6366f1;">Node.js Developers</span>',
            'subtitle' => 'Build scalable backends and real-time apps with our top-tier Node.js talent.',
            'badge' => 'BACKEND EXPERTS'
        ],
        'about' => ['title' => 'Why Hire Node.js Devs from Us?', 'description' => 'Our developers are experts in asynchronous programming, microservices, and server-side performance.', 'label' => 'EXPERT TALENT'],
        'why_choose_points' => ['Express & NestJS Pros', 'Real-time & Socket.io Masters', 'Database Optimization', 'AWS & Cloud Deployment'],
        'cta' => ['title' => 'Scale Your Backend Now', 'button' => 'Hire a Developer']
    ]
];

foreach ($teamRoles as $slug => $data) {
    $role = TeamRole::where('slug', $slug)->first();
    if ($role) {
        $role->update(['content_data' => $data]);
        echo "Updated Team Role: {$slug}\n";
    }
}

// --- TESTIMONIALS ---
$testimonials = [
    ['client_name' => 'Sarah Johnson', 'client_position' => 'CTO at TechFlow', 'content' => 'Devent Technology transformed our legacy system into a modern, scalable platform. Their Laravel expertise is unmatched.', 'rating' => 5],
    ['client_name' => 'Michael Chen', 'client_position' => 'Founder of BloomRetail', 'content' => 'The React developers we hired from Devent were exceptional. They delivered a complex UI ahead of schedule.', 'rating' => 5],
    ['client_name' => 'Emma Williams', 'client_position' => 'Marketing Manager at EduLearn', 'content' => 'Our EdTech platform has seen a 50% increase in user engagement thanks to Devent\'s intuitive UX design.', 'rating' => 5]
];

Testimonial::truncate();
foreach ($testimonials as $t) {
    Testimonial::create($t);
}
echo "Updated Testimonials\n";
