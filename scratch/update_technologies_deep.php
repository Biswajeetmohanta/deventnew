<?php

use App\Models\Technology;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$technologies = [
    'laravel' => [
        'banner' => [
            'title' => 'Enterprise Laravel Development Experts',
            'subtitle' => 'We leverage the world\'s leading PHP framework to build secure, scalable, and high-performance web applications tailored for complex business needs.',
            'badge' => 'LARAVEL CERTIFIED PARTNERS',
            'video_url' => '#'
        ],
        'statistics' => [
            ['title' => '150+', 'description' => 'Laravel Projects Delivered', 'icon' => 'fa-solid fa-rocket'],
            ['title' => '10+', 'description' => 'Years of Laravel Expertise', 'icon' => 'fa-solid fa-calendar-check'],
            ['title' => '98%', 'description' => 'Client Satisfaction Rate', 'icon' => 'fa-solid fa-star']
        ],
        'solutions' => [
            ['title' => 'Custom Web Apps', 'description' => 'Tailor-made web solutions with elegant architecture and robust features.', 'icon' => 'fa-solid fa-window-maximize'],
            ['title' => 'SaaS Platforms', 'description' => 'Building scalable multi-tenant architectures with advanced subscription management.', 'icon' => 'fa-solid fa-cloud'],
            ['title' => 'E-commerce Solutions', 'description' => 'High-conversion online stores with seamless payment and logistics integration.', 'icon' => 'fa-solid fa-cart-shopping'],
            ['title' => 'API Development', 'description' => 'Developing RESTful and GraphQL APIs for seamless mobile and web communication.', 'icon' => 'fa-solid fa-code']
        ],
        'intro' => [
            'title' => 'Mastering the Art of Laravel',
            'description' => "Laravel is more than just a framework; it's an ecosystem for innovation. At Devent Technology, we utilize Laravel's expressive syntax and powerful features to build applications that are as beautiful under the hood as they are on the screen.\n\nFrom utilizing Eloquent ORM for seamless data management to leveraging Laravel Queues for high-concurrency tasks, our developers ensure your application is built for maximum efficiency and long-term maintainability."
        ],
        'about' => [
            'title' => 'Why Choose Devent for Laravel?',
            'description' => 'We follow the highest standards of clean code and architectural best practices.',
            'detailed_overview' => "Our Laravel development process focuses on security, speed, and scalability. We implement advanced caching strategies (Redis/Memcached), utilize modern CI/CD pipelines, and follow PSR coding standards to ensure your codebase is ready for the future.\n\nWhether you're migrating a legacy system to Laravel or building a ground-up enterprise platform, our team provides the strategic guidance and technical execution you need."
        ],
        'highlights' => [
            'Eloquent ORM Optimization',
            'Blade & Livewire Interactivity',
            'Robust Unit & Feature Testing',
            'Advanced Queue Management',
            'Secure Auth & Authorization',
            'Laravel Ecosystem Experts (Nova, Forge, Vapor)'
        ],
        'features' => [
            ['title' => 'Fast Development', 'description' => 'Accelerated time-to-market with Laravel\'s built-in tools.'],
            ['title' => 'High Security', 'description' => 'Protection against SQL injection, XSS, and CSRF attacks.'],
            ['title' => 'Seamless Scalability', 'description' => 'Designed to handle growth from day one.']
        ],
        'process' => [
            ['title' => 'Strategic Discovery', 'description' => 'Defining requirements and technical architecture.'],
            ['title' => 'Database Modeling', 'description' => 'Architecting optimized data structures with Eloquent.'],
            ['title' => 'Backend Development', 'description' => 'Building robust logic and API endpoints.'],
            ['title' => 'Quality Assurance', 'description' => 'Rigorous testing for performance and security.']
        ],
        'advantages' => [
            ['title' => 'Modern Stack', 'description' => 'Always using the latest stable Laravel versions.'],
            ['title' => 'Clean Code', 'description' => 'Code that is easy to maintain and scale.'],
            ['title' => 'Performance', 'description' => 'Optimized queries and caching for speed.'],
            ['title' => 'Active Support', 'description' => 'Post-launch maintenance and optimization.']
        ],
        'why_choose' => [
            'title' => 'Enterprise Architecture',
            'description' => 'We build Laravel applications that aren\'t just websites—they are powerful business tools designed to handle enterprise-level loads.'
        ],
        'industries_served' => [
            ['title' => 'Fintech', 'description' => 'fa-solid fa-building-columns'],
            ['title' => 'Healthcare', 'description' => 'fa-solid fa-heart-pulse'],
            ['title' => 'E-commerce', 'description' => 'fa-solid fa-shop'],
            ['title' => 'Real Estate', 'description' => 'fa-solid fa-house-chimney']
        ],
        'engagement_models' => [
            ['title' => 'Dedicated Team', 'description' => 'A full squad of Laravel experts at your disposal.'],
            ['title' => 'Fixed Price', 'description' => 'Clear scope and budget for specific projects.'],
            ['title' => 'Hourly Basis', 'description' => 'Flexible development for evolving needs.']
        ],
        'hiring' => [
            'title' => 'Need a Laravel Specialist?',
            'description' => 'Our developers are available for immediate hire to augment your existing team or lead new projects.'
        ],
        'faqs' => [
            ['question' => 'Why should I choose Laravel for my project?', 'answer' => 'Laravel offers a perfect balance of security, speed, and maintainability, making it ideal for everything from MVPs to enterprise systems.'],
            ['question' => 'Do you provide Laravel migration services?', 'answer' => 'Yes, we specialize in migrating legacy PHP applications or other platforms to Laravel with zero data loss.'],
            ['question' => 'Is Laravel good for high-traffic sites?', 'answer' => 'Absolutely. With proper caching and architecture, Laravel handles millions of requests seamlessly.']
        ],
        'cta' => [
            'title' => 'Build Your Next Masterpiece with Laravel',
            'subtitle' => 'Schedule a free technical consultation with our lead architects today.',
            'button' => 'Contact Our Laravel Team'
        ]
    ],
    'react' => [
        'banner' => [
            'title' => 'Cutting-Edge React.js Development',
            'subtitle' => 'Building lightning-fast, interactive, and highly responsive user interfaces that deliver exceptional user experiences.',
            'badge' => 'FRONTEND INNOVATORS',
        ],
        'statistics' => [
            ['title' => '50ms', 'description' => 'Average Interaction Delay', 'icon' => 'fa-solid fa-bolt'],
            ['title' => '200+', 'description' => 'React Projects Done', 'icon' => 'fa-solid fa-code-merge'],
            ['title' => '100%', 'description' => 'SEO Optimization', 'icon' => 'fa-solid fa-magnifying-glass-chart']
        ],
        'solutions' => [
            ['title' => 'Single Page Apps (SPA)', 'description' => 'Fast, fluid web experiences that feel like native desktop apps.', 'icon' => 'fa-solid fa-window-restore'],
            ['title' => 'Server-Side Rendering', 'description' => 'SEO-friendly React apps with Next.js for maximum search visibility.', 'icon' => 'fa-solid fa-server'],
            ['title' => 'Progressive Web Apps', 'description' => 'Offline-ready web applications with app-like features.', 'icon' => 'fa-solid fa-mobile-screen'],
            ['title' => 'Custom UI Components', 'description' => 'Building reusable, high-performance component libraries.', 'icon' => 'fa-solid fa-cubes']
        ],
        'intro' => [
            'title' => 'Elevating User Experiences',
            'description' => "In today's digital world, the frontend is your brand's face. We use React.js to create interfaces that are not only visually stunning but also incredibly performant.\n\nOur team masters the entire React ecosystem, from state management with Redux/Zustand to advanced animations and component architecture, ensuring your application is scalable and easy to maintain."
        ],
        'highlights' => [
            'Virtual DOM Performance',
            'Next.js for SSR & SSG',
            'Reusable Component Design',
            'Advanced State Management',
            'Seamless API Integration',
            'Modern Animation Libraries'
        ],
        'advantages' => [
            ['title' => 'Speed', 'description' => 'React\'s virtual DOM ensures ultra-fast UI updates.'],
            ['title' => 'Modularity', 'description' => 'Component-based architecture for clean code.'],
            ['title' => 'SEO Friendly', 'description' => 'Next.js integrations for perfect indexing.'],
            ['title' => 'Rich UX', 'description' => 'Highly interactive and engaging interfaces.']
        ],
        'faqs' => [
            ['question' => 'Why is React better than other frameworks?', 'answer' => 'React offers unparalleled flexibility and performance, especially for complex, data-driven user interfaces.'],
            ['question' => 'Do you use Next.js with React?', 'answer' => 'Yes, we highly recommend Next.js for projects that require SEO and fast initial load times.']
        ],
        'cta' => [
            'title' => 'Modernize Your Frontend with React',
            'subtitle' => 'Transform your legacy UI into a high-performance experience.',
            'button' => 'Talk to Our React Experts'
        ]
    ],
    'nodejs' => [
        'banner' => [
            'title' => 'Real-Time Scalable Node.js Solutions',
            'subtitle' => 'Harnessing event-driven architecture to build high-concurrency backends and lightning-fast real-time applications.',
            'badge' => 'NODE.JS BACKEND MASTERS',
        ],
        'statistics' => [
            ['title' => '1M+', 'description' => 'Concurrent Requests Handled', 'icon' => 'fa-solid fa-microchip'],
            ['title' => '100+', 'description' => 'Real-time Apps Built', 'icon' => 'fa-solid fa-bolt-lightning'],
            ['title' => '40%', 'description' => 'Lower Server Costs', 'icon' => 'fa-solid fa-money-bill-trend-up']
        ],
        'solutions' => [
            ['title' => 'Real-time Chat & Apps', 'description' => 'Using Socket.io for instant data sync and live interactions.', 'icon' => 'fa-solid fa-comments'],
            ['title' => 'Microservices', 'description' => 'Scalable, independent service architectures for complex systems.', 'icon' => 'fa-solid fa-network-wired'],
            ['title' => 'Streaming Solutions', 'description' => 'Handling large data and video streams with low latency.', 'icon' => 'fa-solid fa-play'],
            ['title' => 'Serverless Backend', 'description' => 'Developing lightweight, efficient AWS Lambda and Cloud Functions.', 'icon' => 'fa-solid fa-cloud-bolt']
        ],
        'intro' => [
            'title' => 'The Power of Asynchronous Backend',
            'description' => "Node.js changed the way we think about the web. By using a non-blocking I/O model, it allows for incredible scalability that traditional frameworks can't match.\n\nAt Devent Technology, we build Node.js backends that power everything from real-time trading platforms to massive social networks, ensuring your data flows instantly and securely."
        ],
        'highlights' => [
            'Event-Driven Architecture',
            'Express & NestJS Mastery',
            'Socket.io Real-time Sync',
            'Efficient Cluster Management',
            'NoSQL & SQL Integration',
            'High-Performance APIs'
        ],
        'faqs' => [
            ['question' => 'Is Node.js good for enterprise apps?', 'answer' => 'Yes, especially when built with TypeScript and NestJS, Node.js provides enterprise-grade structure and scalability.'],
            ['question' => 'How do you handle real-time data?', 'answer' => 'We utilize WebSockets (Socket.io) and message brokers like Redis/RabbitMQ for seamless real-time communication.']
        ],
        'cta' => [
            'title' => 'Build a Real-Time Future with Node.js',
            'subtitle' => 'Scale your application to millions of users with ease.',
            'button' => 'Contact Our Node.js Team'
        ]
    ],
    'php' => [
        'banner' => [
            'title' => 'Expert PHP Development Services',
            'subtitle' => 'Building the backbone of the web with stable, secure, and high-performance PHP solutions tailored to your business.',
            'badge' => 'PHP ARCHITECTS',
        ],
        'statistics' => [
            ['title' => '20+', 'description' => 'Years of PHP Experience', 'icon' => 'fa-solid fa-clock-rotate-left'],
            ['title' => '500+', 'description' => 'Websites Delivered', 'icon' => 'fa-solid fa-globe'],
            ['title' => '78%', 'description' => 'Web Powering Factor', 'icon' => 'fa-solid fa-percent']
        ],
        'solutions' => [
            ['title' => 'Custom CMS', 'description' => 'Tailored content management systems for unique publishing needs.', 'icon' => 'fa-solid fa-file-pen'],
            ['title' => 'Legacy Modernization', 'description' => 'Upgrading old PHP codebases to modern, secure standards.', 'icon' => 'fa-solid fa-wand-magic-sparkles'],
            ['title' => 'System Integration', 'description' => 'Connecting disparate business tools through robust PHP middleware.', 'icon' => 'fa-solid fa-link'],
            ['title' => 'Bespoke Business Logic', 'description' => 'Implementing complex calculations and workflows in PHP.', 'icon' => 'fa-solid fa-brain']
        ],
        'intro' => [
            'title' => 'The Proven Language of the Web',
            'description' => "PHP powers over 75% of the internet for a reason: it's reliable, versatile, and continuously evolving. Our PHP experts don't just write code; they architect solutions that last.\n\nFrom vanilla PHP to modern frameworks, we ensure your application follows modern security standards, has optimized memory usage, and integrates perfectly with your database layer."
        ],
        'highlights' => [
            'Modern PHP 8+ Features',
            'Secure Coding Standards',
            'Database Optimization',
            'Third-Party API Mastery',
            'High-Availability Servers',
            'Robust Error Handling'
        ],
        'cta' => [
            'title' => 'Need a Solid PHP Solution?',
            'subtitle' => 'Our experts are ready to modernize or build your application.',
            'button' => 'Consult a PHP Expert'
        ]
    ],
    'mysql' => [
        'banner' => [
            'title' => 'Master Database Architecture & Optimization',
            'subtitle' => 'Ensuring your data is secure, structured, and instantly accessible with expert MySQL management.',
            'badge' => 'DATA INTEGRITY EXPERTS',
        ],
        'statistics' => [
            ['title' => '50TB+', 'description' => 'Data Managed Securely', 'icon' => 'fa-solid fa-database'],
            ['title' => '99.9%', 'description' => 'Query Performance Boost', 'icon' => 'fa-solid fa-gauge'],
            ['title' => '0', 'description' => 'Data Loss History', 'icon' => 'fa-solid fa-shield-heart']
        ],
        'solutions' => [
            ['title' => 'Database Design', 'description' => 'Architecting normalized, efficient data structures.', 'icon' => 'fa-solid fa-sitemap'],
            ['title' => 'Query Optimization', 'description' => 'Speeding up slow applications by tuning complex SQL queries.', 'icon' => 'fa-solid fa-bolt'],
            ['title' => 'Data Migration', 'description' => 'Safe and seamless transfer of large datasets between systems.', 'icon' => 'fa-solid fa-truck-fast'],
            ['title' => 'High Availability', 'description' => 'Setting up replication and clusters for zero-downtime data.', 'icon' => 'fa-solid fa-clone']
        ],
        'intro' => [
            'title' => 'Data is Your Most Valuable Asset',
            'description' => "A fast application is useless without a solid data foundation. We specialize in MySQL architecture that handles high read/write loads without breaking a sweat.\n\nOur team focuses on everything from proper indexing and partitioning to advanced backup strategies, ensuring your business data is always safe, consistent, and ready when you need it."
        ],
        'highlights' => [
            'Advanced Schema Design',
            'Index & Query Tuning',
            'Master-Slave Replication',
            'Data Encryption at Rest',
            'Automated Backup Systems',
            'Scalable Partitioning'
        ],
        'cta' => [
            'title' => 'Optimize Your Data Performance',
            'subtitle' => 'Stop letting slow queries hold your business back.',
            'button' => 'Request a Database Audit'
        ]
    ],
    'tailwind-css' => [
        'banner' => [
            'title' => 'Utility-First Design Perfection',
            'subtitle' => 'Crafting beautiful, pixel-perfect, and ultra-lightweight user interfaces with Tailwind CSS.',
            'badge' => 'MODERN UI MASTERS',
        ],
        'statistics' => [
            ['title' => '0', 'description' => 'Unused CSS Bloat', 'icon' => 'fa-solid fa-broom'],
            ['title' => '2x', 'description' => 'Faster UI Development', 'icon' => 'fa-solid fa-forward'],
            ['title' => '100', 'description' => 'Perfect Mobile Score', 'icon' => 'fa-solid fa-mobile-screen']
        ],
        'solutions' => [
            ['title' => 'Responsive Design', 'description' => 'Interfaces that look stunning on every screen size.', 'icon' => 'fa-solid fa-desktop'],
            ['title' => 'Custom Design Systems', 'description' => 'Building consistent brand languages with utility classes.', 'icon' => 'fa-solid fa-palette'],
            ['title' => 'Dark Mode UI', 'description' => 'Seamless implementation of premium dark and light themes.', 'icon' => 'fa-solid fa-moon'],
            ['title' => 'Fast Load Times', 'description' => 'Minimal CSS bundle size for lightning-fast page loads.', 'icon' => 'fa-solid fa-feather']
        ],
        'intro' => [
            'title' => 'Design Without Limits',
            'description' => "Tailwind CSS revolutionized the way we build for the web. By moving away from restrictive components and into utility-first styling, we can build custom designs faster and with zero CSS bloat.\n\nOur design team leverages Tailwind to create unique brand experiences that are impossible to achieve with standard UI kits, while keeping your site's performance at the highest level."
        ],
        'highlights' => [
            'Utility-First Efficiency',
            'Pixel-Perfect Responsive UI',
            'Zero CSS Specification Issues',
            'Optimized Production Bundles',
            'Consistent Design Tokens',
            'Highly Maintainable Styles'
        ],
        'cta' => [
            'title' => 'Beautiful UI, Engineered for Performance',
            'subtitle' => 'Let\'s build a design that wows your users.',
            'button' => 'Start Your Design Project'
        ]
    ],
    'react-native' => [
        'banner' => [
            'title' => 'Native Cross-Platform Mobile Apps',
            'subtitle' => 'Delivering premium iOS and Android applications with a single codebase and native-level performance.',
            'badge' => 'MOBILE DEVELOPMENT PROS',
        ],
        'statistics' => [
            ['title' => '50%', 'description' => 'Lower Development Costs', 'icon' => 'fa-solid fa-tags'],
            ['title' => '100%', 'description' => 'Native Code Integration', 'icon' => 'fa-solid fa-mobile'],
            ['title' => '4.9', 'description' => 'Average App Store Rating', 'icon' => 'fa-solid fa-star']
        ],
        'solutions' => [
            ['title' => 'iOS & Android Apps', 'description' => 'Simultaneous deployment to both major platforms.', 'icon' => 'fa-brands fa-app-store-ios'],
            ['title' => 'Native Modules', 'description' => 'Bridging custom native functionality for high performance.', 'icon' => 'fa-solid fa-link'],
            ['title' => 'App Modernization', 'description' => 'Upgrading legacy mobile apps to React Native.', 'icon' => 'fa-solid fa-rocket'],
            ['title' => 'UI/UX Mobile Design', 'description' => 'Fluid animations and gesture-based mobile interfaces.', 'icon' => 'fa-solid fa-fingerprint']
        ],
        'intro' => [
            'title' => 'Build Once, Deploy Everywhere',
            'description' => "React Native allows us to bring the power of React to mobile development. We build apps that aren't just 'web views' but true native applications that leverage the full power of the device.\n\nWhether you're building a social network, a fitness app, or a complex enterprise tool, we provide the native-level performance you need with the development speed of cross-platform technology."
        ],
        'highlights' => [
            'Single Codebase Efficiency',
            'Native-Level Performance',
            'Over-the-Air (OTA) Updates',
            'Rich Mobile Ecosystem',
            'Hardware Feature Integration',
            'Fast Refresh Iteration'
        ],
        'cta' => [
            'title' => 'Go Mobile with Confidence',
            'subtitle' => 'Reach your users on any device with one powerful app.',
            'button' => 'Consult Our Mobile Experts'
        ]
    ],
    'python' => [
        'banner' => [
            'title' => 'AI, Data Science & Python Automation',
            'subtitle' => 'Unlocking the power of artificial intelligence and complex data processing with expert Python development.',
            'badge' => 'INTELLIGENT TECH LEADERS',
        ],
        'statistics' => [
            ['title' => '95%+', 'description' => 'Model Prediction Accuracy', 'icon' => 'fa-solid fa-brain'],
            ['title' => '10k+', 'description' => 'Data Sets Processed Daily', 'icon' => 'fa-solid fa-microchip'],
            ['title' => '50%', 'description' => 'Task Automation Boost', 'icon' => 'fa-solid fa-robot']
        ],
        'solutions' => [
            ['title' => 'AI & Machine Learning', 'description' => 'Developing predictive models and intelligent automation.', 'icon' => 'fa-solid fa-head-side-virus'],
            ['title' => 'Data Engineering', 'description' => 'Building complex ETL pipelines and data warehouses.', 'icon' => 'fa-solid fa-database'],
            ['title' => 'Web Scraping & Bots', 'description' => 'Automated data extraction and process automation bots.', 'icon' => 'fa-solid fa-spider'],
            ['title' => 'Scientific Computing', 'description' => 'Solving complex mathematical and scientific problems with code.', 'icon' => 'fa-solid fa-flask']
        ],
        'intro' => [
            'title' => 'The Language of the Future',
            'description' => "Python is the heartbeat of modern innovation. From Artificial Intelligence to Big Data, we use Python to solve problems that were previously thought impossible.\n\nOur team focuses on building intelligent systems that learn from your data, automate your most boring tasks, and provide insights that give your business a massive competitive advantage."
        ],
        'highlights' => [
            'Advanced AI & ML Models',
            'Scalable Data Pipelines',
            'Intelligent Automation Bots',
            'Scientific Analysis Tools',
            'Fast Backend APIs (FastAPI)',
            'Robust Scripting Solutions'
        ],
        'cta' => [
            'title' => 'Unleash the Power of AI & Data',
            'subtitle' => 'Transform your data into your biggest business advantage.',
            'button' => 'Talk to Our Data Scientists'
        ]
    ]
];

foreach ($technologies as $slug => $data) {
    $tech = Technology::where('slug', $slug)->first();
    if ($tech) {
        $tech->update(['content_data' => $data]);
        echo "Successfully updated Technology with deep content: {$slug}\n";
    } else {
        echo "Warning: Technology with slug '{$slug}' not found.\n";
    }
}

echo "Done! All technologies have been updated with rich, professional, and technology-specific content.\n";
