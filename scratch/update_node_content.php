<?php
use App\Models\Technology;

$node = Technology::find(4);
if (!$node) {
    echo "Node.js technology not found!";
    exit;
}

$content_data = [
    'banner' => [
        'title' => 'Enterprise-Grade Node.js Development Company',
        'subtitle' => 'Build lightning-fast, scalable, and real-time applications using the world\'s most popular JavaScript runtime environment.',
        'badge' => '⚡ Industry-Leading Node.js Development',
        'video_url' => 'https://www.youtube.com/watch?v=uVwtVBpw7RQ'
    ],
    'statistics' => [
        ['title' => '150+', 'description' => 'Node.js Projects'],
        ['title' => '10M+', 'description' => 'Active Users Supported'],
        ['title' => '40%', 'description' => 'Faster Load Times'],
        ['title' => '24/7', 'description' => 'Support & Maintenance']
    ],
    'intro' => [
        'title' => 'Revolutionize Your Backend with Node.js',
        'description' => 'In today\'s fast-paced digital world, performance is everything. Node.js offers a non-blocking, event-driven architecture that is perfect for data-intensive real-time applications running across distributed devices.'
    ],
    'about' => [
        'title' => 'Next-Gen Backend Development Excellence',
        'description' => 'Node.js is a powerful JavaScript runtime built on Chrome\'s V8 engine. At Devent, we specialize in building high-concurrency systems that handle thousands of requests per second without breaking a sweat.',
        'detailed_overview' => 'Our team dives deep into the event loop to optimize every millisecond of performance. We use modern frameworks like NestJS, Express, and Fastify to build secure, scalable, and maintainable backend systems for startups and enterprises alike.'
    ],
    'highlights' => [
        'Asynchronous & Event-Driven',
        'Extremely Fast (V8 Engine)',
        'Scalable Microservices Support',
        'Unified JavaScript Stack',
        'Massive npm Ecosystem',
        'Real-time Data Streaming'
    ],
    'solutions_label' => 'BACKEND EXPERTISE',
    'solutions_title' => 'Comprehensive Node.js Development Services',
    'solutions' => [
        ['title' => 'Custom Node.js Web Apps', 'description' => 'Bespoke web applications built for speed, security, and scalability.'],
        ['title' => 'Real-time Chat & Collaboration', 'description' => 'Using Socket.io for instant data synchronization and messaging.'],
        ['title' => 'API Development & Integration', 'description' => 'High-performance RESTful and GraphQL APIs for seamless connectivity.'],
        ['title' => 'Microservices Architecture', 'description' => 'Breaking complex apps into manageable, independently deployable services.'],
        ['title' => 'Node.js Migration Services', 'description' => 'Seamlessly migrate your legacy systems to a modern Node.js stack.'],
        ['title' => 'Serverless Node.js Solutions', 'description' => 'Cost-effective deployment using AWS Lambda and Azure Functions.']
    ],
    'features_title' => 'Why Node.js is the Right Choice for You',
    'features' => [
        ['title' => 'Superior Performance', 'description' => 'Chrome\'s V8 engine compiles JavaScript to machine code, ensuring peak efficiency.'],
        ['title' => 'Developer Productivity', 'description' => 'Single-language stack (JS/TS) reduces context switching and speeds up delivery.'],
        ['title' => 'Rich Ecosystem', 'description' => 'Access over a million packages in the npm registry to accelerate development.'],
        ['title' => 'Scalability', 'description' => 'Node.js can handle numerous concurrent connections with a small memory footprint.'],
        ['title' => 'Active Community', 'description' => 'Continuous updates and security patches from a massive global community.'],
        ['title' => 'Cloud-Native', 'description' => 'Excellent support for Docker, Kubernetes, and all major cloud providers.']
    ],
    'advantages' => [
        ['title' => 'Cost Efficiency', 'description' => 'Lower infrastructure costs due to high resource utilization.'],
        ['title' => 'Time-to-Market', 'description' => 'Fast prototyping and iterative development cycles.'],
        ['title' => 'Universal Language', 'description' => 'Share code between frontend and backend seamlessly.'],
        ['title' => 'Secure & Robust', 'description' => 'Built-in security features and enterprise-grade frameworks.']
    ],
    'process_title' => 'Our Proven Node.js Development Workflow',
    'process' => [
        ['title' => 'Analysis & Planning', 'description' => 'Defining requirements, system architecture, and technology stack.'],
        ['title' => 'API Design & Modeling', 'description' => 'Creating robust database schemas and API endpoints specifications.'],
        ['title' => 'Agile Development', 'description' => 'Iterative sprints with continuous feedback and code reviews.'],
        ['title' => 'Quality Assurance', 'description' => 'Automated unit, integration, and performance load testing.'],
        ['title' => 'Deployment & DevOps', 'description' => 'CI/CD pipeline setup for seamless, zero-downtime releases.'],
        ['title' => 'Support & Scaling', 'description' => 'Proactive monitoring and horizontal scaling as you grow.']
    ],
    'why_choose' => [
        'title' => 'The Devent Advantage in Node.js',
        'description' => 'We don\'t just write code; we engineer solutions that drive business growth through technical excellence.'
    ],
    'industries_title' => 'Sectors We Transform with Node.js',
    'industries_served' => [
        ['title' => 'FinTech', 'description' => 'fa-solid fa-landmark'],
        ['title' => 'E-Commerce', 'description' => 'fa-solid fa-cart-shopping'],
        ['title' => 'Healthcare', 'description' => 'fa-solid fa-heart-pulse'],
        ['title' => 'Real Estate', 'description' => 'fa-solid fa-building']
    ],
    'engagement_title' => 'Flexible Partnership Models',
    'engagement_models' => [
        ['title' => 'Fixed Cost', 'description' => 'Perfect for well-defined projects with a set scope and timeline.'],
        ['title' => 'Time & Material', 'description' => 'Ideal for evolving projects requiring maximum flexibility.'],
        ['title' => 'Dedicated Team', 'description' => 'Your own offshore team working exclusively on your product.']
    ],
    'hiring' => [
        'title' => 'Hire Vetted Node.js Experts',
        'description' => 'Get access to top 3% of Node.js talent within 24 hours to scale your internal team.'
    ],
    'tech_stack_title' => 'Our Core Node.js Technology Stack',
    'tech_stack' => [
        ['title' => 'Frameworks', 'description' => 'Express, NestJS, Fastify, Koa'],
        ['title' => 'Databases', 'description' => 'MongoDB, PostgreSQL, Redis, MySQL'],
        ['title' => 'Tools', 'description' => 'Docker, PM2, Jest, Mocha, Swagger'],
        ['title' => 'Cloud', 'description' => 'AWS, GCP, Azure, DigitalOcean']
    ],
    'faqs_title' => 'Node.js Development FAQs',
    'faqs' => [
        ['title' => 'Is Node.js suitable for enterprise applications?', 'description' => 'Absolutely. Large enterprises like Netflix, LinkedIn, and Uber use Node.js for their core services due to its scalability and performance.'],
        ['title' => 'How do you ensure the security of Node.js apps?', 'description' => 'We follow OWASP best practices, use security-focused frameworks like NestJS, and perform regular dependency audits.'],
        ['title' => 'Can Node.js handle heavy CPU tasks?', 'description' => 'While optimized for I/O, we can handle CPU tasks using worker threads or by offloading them to specialized services.']
    ],
    'testimonials_title' => 'What Clients Say About Our Node.js Work',
    'testimonials' => [
        ['title' => 'John Doe', 'subtitle' => 'CEO, TechStream', 'description' => 'Devent transformed our legacy system into a high-performance Node.js masterpiece. Our uptime is now 99.99%.'],
        ['title' => 'Sarah Smith', 'subtitle' => 'CTO, HealthFirst', 'description' => 'The real-time features they built with Node.js changed the way our doctors interact with patients. Brilliant execution.']
    ],
    'expert_consultation' => [
        'title' => 'Need an Expert Opinion on Your Node.js Architecture?',
        'description' => 'Our senior architects are ready to audit your system or plan your next big release. Let\'s make it happen.',
        'button' => 'Talk to a Node.js Architect'
    ],
    'cta' => [
        'title' => 'Ready to Build Something Incredible?',
        'subtitle' => 'Join 100+ businesses that trust Devent for their mission-critical backend systems.',
        'button' => 'Start Your Node.js Project'
    ],
    'seo' => [
        'meta_title' => 'Expert Node.js Development Company | Devent',
        'meta_description' => 'High-performance Node.js development services for scalable, real-time web applications. Hire vetted Node.js experts today.',
        'meta_keywords' => 'node.js development, backend services, scalable apps, real-time applications'
    ]
];

$node->content_data = $content_data;
$node->save();

echo "Node.js content updated successfully!";
