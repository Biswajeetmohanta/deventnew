<?php

use App\Models\Industry;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$industries = [
    'banking-finance' => [
        'banner' => [
            'title' => 'Future-Ready Fintech & Banking Solutions',
            'subtitle' => 'Empowering financial institutions with secure, scalable, and innovative digital transformation strategies that redefine customer experience.',
            'badge' => 'ISO 27001 CERTIFIED PARTNER',
            'video_url' => '#'
        ],
        'statistics' => [
            ['title' => '$5B+', 'description' => 'Transactions Secured', 'icon' => 'fa-solid fa-shield-halved'],
            ['title' => '99.99%', 'description' => 'Uptime Guarantee', 'icon' => 'fa-solid fa-up-right-from-square'],
            ['title' => '2M+', 'description' => 'Active Users', 'icon' => 'fa-solid fa-users']
        ],
        'solutions' => [
            ['title' => 'Digital Wallets', 'description' => 'Contactless payment solutions with multi-currency support and instant settlement.', 'icon' => 'fa-solid fa-wallet'],
            ['title' => 'Neo-Banking', 'description' => 'Full-service digital banking platforms with automated onboarding and KYC.', 'icon' => 'fa-solid fa-building-columns'],
            ['title' => 'InsurTech', 'description' => 'Claim automation and risk assessment using advanced AI algorithms.', 'icon' => 'fa-solid fa-file-invoice-dollar'],
            ['title' => 'Wealth Management', 'description' => 'AI-driven portfolio optimization and real-time market data analytics.', 'icon' => 'fa-solid fa-chart-line']
        ],
        'intro' => [
            'title' => 'Leading the Digital Finance Revolution',
            'description' => "In an era of rapid financial evolution, Devent Technology provides the technical backbone for traditional banks and emerging fintechs alike. We specialize in building high-concurrency systems that handle millions of requests while maintaining military-grade security.\n\nOur approach combines deep domain expertise with cutting-edge technologies like Blockchain, AI, and Cloud-native architecture to ensure your financial products stay ahead of the curve."
        ],
        'about' => [
            'title' => 'Why Finance Leaders Trust Devent',
            'description' => 'We don\'t just build apps; we build trust. Our engineering team follows the strictest security protocols to protect sensitive financial data.',
            'detailed_overview' => "Our team of fintech engineers has experience working with global financial regulations including GDPR, PCI DSS, and local banking mandates. We prioritize low-latency performance and high availability, ensuring that your users never experience a delay in their financial life.\n\nFrom legacy system modernization to launching a brand-new digital bank, we provide end-to-end consulting and development services."
        ],
        'highlights' => [
            'Biometric Authentication Integration',
            'Microservices-based Architecture',
            'Real-time Fraud Detection AI',
            'Cross-border Payment Protocols',
            'Automated Regulatory Reporting',
            'High-load Distributed Databases'
        ],
        'features' => [
            ['title' => 'Bank-Grade Security', 'description' => 'Implementation of 256-bit AES encryption and multi-factor authentication across all layers.'],
            ['title' => 'Regulatory Compliance', 'description' => 'Built-in support for KYC, AML, and local financial compliance requirements.'],
            ['title' => 'Seamless Integrations', 'description' => 'Native connectors for core banking systems, payment gateways, and third-party APIs.']
        ],
        'process' => [
            ['title' => 'Security Audit', 'description' => 'Comprehensive vulnerability assessment and threat modeling.'],
            ['title' => 'Architecture Design', 'description' => 'Designing scalable, high-availability system architecture.'],
            ['title' => 'Agile Development', 'description' => 'Sprint-based development with continuous security testing.'],
            ['title' => 'Compliance Validation', 'description' => 'Ensuring all features meet regulatory standards before launch.']
        ],
        'advantages' => [
            ['title' => 'Low Latency', 'description' => 'Milliseconds count in finance; we optimize every millisecond.'],
            ['title' => 'Scalability', 'description' => 'Scale from thousands to millions of users without downtime.'],
            ['title' => 'Interoperability', 'description' => 'Connect effortlessly with the global financial ecosystem.'],
            ['title' => 'Data Privacy', 'description' => 'Absolute commitment to user data protection and privacy.']
        ],
        'why_choose' => [
            'title' => 'Security is Our DNA',
            'description' => 'We understand that in banking, there is no room for error. Our zero-trust security model ensures every transaction is verified and every bit of data is encrypted.'
        ],
        'faqs' => [
            ['question' => 'How do you handle PCI DSS compliance?', 'answer' => 'We follow strict development guidelines and work with certified auditors to ensure all payment processing components are fully compliant.'],
            ['question' => 'Can you integrate with existing legacy banking systems?', 'answer' => 'Yes, we specialize in building middleware and APIs that allow modern digital interfaces to communicate securely with older COBOL or mainframe-based systems.'],
            ['question' => 'Do you provide maintenance after launch?', 'answer' => 'Absolutely. We offer 24/7 monitoring and maintenance packages to ensure 100% uptime for critical financial services.']
        ],
        'expert_consultation' => [
            'title' => 'Consult with a Fintech Expert',
            'description' => 'Discuss your project with our specialized financial technology consultants today.',
            'button' => 'Book a Strategy Session'
        ],
        'cta' => [
            'title' => 'Build the Future of Finance',
            'subtitle' => 'Join the world\'s leading financial institutions in the digital age.',
            'button' => 'Contact Us Today'
        ]
    ],
    'business' => [
        'banner' => [
            'title' => 'Enterprise Software for Modern Business',
            'subtitle' => 'Transforming complex business processes into streamlined, efficient, and profitable digital workflows.',
            'badge' => 'DIGITAL TRANSFORMATION LEADERS'
        ],
        'statistics' => [
            ['title' => '45%', 'description' => 'Efficiency Increase', 'icon' => 'fa-solid fa-bolt'],
            ['title' => '300+', 'description' => 'Enterprise Tools Built', 'icon' => 'fa-solid fa-gears'],
            ['title' => '60%', 'description' => 'Operational Cost Reduction', 'icon' => 'fa-solid fa-piggy-bank']
        ],
        'solutions' => [
            ['title' => 'Custom ERP Systems', 'description' => 'Unified platforms for managing finance, HR, and supply chain in one place.', 'icon' => 'fa-solid fa-network-wired'],
            ['title' => 'Intelligent CRM', 'description' => 'Data-driven customer relationship management with predictive sales analytics.', 'icon' => 'fa-solid fa-address-card'],
            ['title' => 'Business Intelligence', 'description' => 'Visualizing complex business data for faster, better decision-making.', 'icon' => 'fa-solid fa-magnifying-glass-chart'],
            ['title' => 'HR Management', 'description' => 'Automated payroll, recruitment, and performance tracking systems.', 'icon' => 'fa-solid fa-user-gear']
        ],
        'intro' => [
            'title' => 'Unlocking Business Potential Through Tech',
            'description' => "At Devent Technology, we believe that software should work for the business, not the other way around. We specialize in identifying bottlenecks in your operations and building custom digital solutions that solve them permanently.\n\nOur enterprise experts work closely with your stakeholders to understand the nuances of your industry and deliver a product that integrates perfectly with your existing ecosystem."
        ],
        'about' => [
            'title' => 'Your Partner in Efficiency',
            'description' => 'We help businesses of all sizes modernize their stack and embrace the power of automation.',
            'detailed_overview' => "Digital transformation isn't just a buzzword for us; it's a measurable outcome. We focus on reducing manual tasks, eliminating data silos, and providing executives with the real-time insights they need to lead effectively.\n\nWhether you need a custom SaaS product for your clients or an internal tool for your global workforce, we have the expertise to deliver."
        ],
        'highlights' => [
            'Cloud-Native Scalability',
            'AI-Powered Process Automation',
            'Robust Data Security & Governance',
            'User-Centric Enterprise Design',
            'Legacy System Integration',
            'Real-Time Collaboration Tools'
        ],
        'advantages' => [
            ['title' => 'Reduced Overhead', 'description' => 'Automate repetitive tasks and save hundreds of man-hours.'],
            ['title' => 'Better Data Flow', 'description' => 'Ensure information is accessible across all departments.'],
            ['title' => 'Actionable Insights', 'description' => 'Make decisions based on data, not guesses.'],
            ['title' => 'Employee Satisfaction', 'description' => 'Give your team better tools to do their best work.']
        ],
        'faqs' => [
            ['question' => 'How do you measure ROI for custom software?', 'answer' => 'We establish clear KPIs at the start, such as time saved per task, reduction in error rates, or increase in sales velocity, and track them throughout the lifecycle.'],
            ['question' => 'Can your software grow with my company?', 'answer' => 'Yes, we build using modular, cloud-native architectures that allow you to add features and handle more users as your business expands.']
        ],
        'cta' => [
            'title' => 'Ready to Streamline Your Operations?',
            'subtitle' => 'Let\'s talk about how custom software can transform your business.',
            'button' => 'Start Your Transformation'
        ]
    ],
    'ecommerce' => [
        'banner' => [
            'title' => 'High-Conversion Ecommerce Experiences',
            'subtitle' => 'We build online stores that don\'t just look great—they sell. Fast, intuitive, and optimized for maximum ROI.',
            'badge' => 'ECOMMERCE EXCELLENCE',
        ],
        'statistics' => [
            ['title' => '40%', 'description' => 'Higher Conversion Rates', 'icon' => 'fa-solid fa-cart-arrow-down'],
            ['title' => '200ms', 'description' => 'Avg. Page Load Time', 'icon' => 'fa-solid fa-gauge-high'],
            ['title' => '$100M+', 'description' => 'Annual Client Revenue', 'icon' => 'fa-solid fa-money-bill-trend-up']
        ],
        'solutions' => [
            ['title' => 'Headless Commerce', 'description' => 'Decoupled frontend for ultimate speed and creative freedom.', 'icon' => 'fa-solid fa-puzzle-piece'],
            ['title' => 'Multi-Vendor Marketplaces', 'description' => 'Scale your business by allowing third-party sellers on your platform.', 'icon' => 'fa-solid fa-shop'],
            ['title' => 'Subscription Systems', 'description' => 'Build recurring revenue with seamless subscription and billing models.', 'icon' => 'fa-solid fa-repeat'],
            ['title' => 'Mobile-First Stores', 'description' => 'Optimized shopping experiences for the generation on the move.', 'icon' => 'fa-solid fa-mobile-screen-button']
        ],
        'intro' => [
            'title' => 'Dominating the Digital Marketplace',
            'description' => "The ecommerce landscape is more competitive than ever. To win, you need more than just a cart; you need a performance-driven engine. We focus on speed, user experience, and SEO-optimized architecture to ensure your store stays at the top of search results and customer minds.\n\nFrom Shopify Plus customizations to bespoke Laravel-based platforms, we choose the right technology to match your scale and ambition."
        ],
        'about' => [
            'title' => 'Conversion-Focused Engineering',
            'description' => 'We analyze user behavior to build interfaces that guide customers effortlessly to the checkout.',
            'detailed_overview' => "Every millisecond of delay costs money in ecommerce. Our engineering team prioritizes performance optimization, implementing advanced caching, image optimization, and CDN strategies to ensure your store is always ready for peak traffic.\n\nWe also integrate deeply with logistics, payment, and marketing tools to provide a truly unified backend for your retail operations."
        ],
        'highlights' => [
            'PWA (Progressive Web App) Ready',
            'One-Click Checkout Integrations',
            'Advanced Inventory Management',
            'AI-Driven Product Recommendations',
            'Omnichannel Data Sync',
            'SEO-First Architecture'
        ],
        'features' => [
            ['title' => 'Lightning Fast Performance', 'description' => 'Optimized code and assets for sub-second load times.'],
            ['title' => 'Advanced Analytics', 'description' => 'Deep insights into funnel drops and customer lifetime value.'],
            ['title' => 'Global Readiness', 'description' => 'Multi-currency, multi-language, and international shipping support.']
        ],
        'process' => [
            ['title' => 'Strategy & UX', 'description' => 'Mapping the customer journey for maximum conversion.'],
            ['title' => 'Agile Build', 'description' => 'Rapid development of core features with continuous feedback.'],
            ['title' => 'Load Testing', 'description' => 'Ensuring the store can handle thousands of simultaneous shoppers.'],
            ['title' => 'SEO & Launch', 'description' => 'Full technical SEO audit and smooth deployment.']
        ],
        'advantages' => [
            ['title' => 'Mobile Conversion', 'description' => 'Stores that feel like native apps on mobile devices.'],
            ['title' => 'Customer Retention', 'description' => 'Tools to keep your customers coming back again and again.'],
            ['title' => 'Low Maintenance', 'description' => 'Stable, reliable code that lets you focus on selling.'],
            ['title' => 'Security', 'description' => 'Level 1 PCI compliance and fraud protection integrations.']
        ],
        'why_choose' => [
            'title' => 'Results, Not Just Code',
            'description' => 'We judge our success by your sales growth. Our team is obsessed with metrics, from bounce rates to average order value.'
        ],
        'faqs' => [
            ['question' => 'Do you work with existing platforms like Shopify or Magento?', 'answer' => 'Yes, we are experts at customizing Shopify, Magento, and WooCommerce, as well as building custom headless solutions.'],
            ['question' => 'Can you help with payment gateway integration?', 'answer' => 'Absolutely. We have experience with Stripe, PayPal, Razorpay, and dozens of other global and local payment processors.'],
            ['question' => 'Is my store mobile-friendly?', 'answer' => 'We follow a mobile-first design philosophy, ensuring your store is fully responsive and high-performing on all devices.']
        ],
        'expert_consultation' => [
            'title' => 'Free Ecommerce Growth Audit',
            'description' => 'Let us analyze your current store and show you where you can improve performance and sales.',
            'button' => 'Request My Audit'
        ],
        'cta' => [
            'title' => 'Ready to Scale Your Online Sales?',
            'subtitle' => 'Let\'s build a store that your customers will love.',
            'button' => 'Contact Our Ecommerce Experts'
        ]
    ],
    'education' => [
        'banner' => [
            'title' => 'Next-Generation EdTech Solutions',
            'subtitle' => 'Creating immersive, accessible, and engaging learning experiences for the digital age.',
            'badge' => 'REVOLUTIONIZING EDUCATION',
        ],
        'statistics' => [
            ['title' => '1M+', 'description' => 'Learners Impacted', 'icon' => 'fa-solid fa-graduation-cap'],
            ['title' => '50+', 'description' => 'LMS Platforms Built', 'icon' => 'fa-solid fa-book-open'],
            ['title' => '90%', 'description' => 'Student Engagement Rate', 'icon' => 'fa-solid fa-face-smile']
        ],
        'solutions' => [
            ['title' => 'Modern LMS', 'description' => 'Scalable learning management systems with gamification and social learning.', 'icon' => 'fa-solid fa-chalkboard-user'],
            ['title' => 'Assessment Engines', 'description' => 'Secure, anti-cheat testing platforms with automated grading.', 'icon' => 'fa-solid fa-file-signature'],
            ['title' => 'Interactive Content', 'description' => 'Rich media and interactive video learning experiences.', 'icon' => 'fa-solid fa-play'],
            ['title' => 'Edu-Analytics', 'description' => 'Tracking student progress and predicting outcomes with AI.', 'icon' => 'fa-solid fa-chart-pie']
        ],
        'intro' => [
            'title' => 'Education Without Boundaries',
            'description' => "Technology has rewritten the rules of learning. We help institutions and startups build platforms that make high-quality education available to anyone, anywhere.\n\nOur EdTech specialized team understands the unique challenges of the sector—from student data privacy to the need for high engagement—and we build solutions that educators and students love to use."
        ],
        'about' => [
            'title' => 'Building the Future of Knowledge',
            'description' => 'We combine pedagogical principles with cutting-edge tech to deliver meaningful learning outcomes.',
            'detailed_overview' => "Our platforms are designed to be intuitive for all ages and accessible across all bandwidths. We focus on low-latency video streaming, offline access modes, and mobile-first interfaces to ensure learning never stops.\n\nWhether you're a university looking to go digital or a startup building the next big learning app, we provide the technical expertise to make it a reality."
        ],
        'highlights' => [
            'Gamified Learning Paths',
            'Real-Time Virtual Classrooms',
            'SCORM/xAPI Compatibility',
            'Robust Student Data Protection',
            'Multilingual Support',
            'Automated Certification Systems'
        ],
        'advantages' => [
            ['title' => 'Accessibility', 'description' => 'Ensure your content reaches students on any device.'],
            ['title' => 'Engagement', 'description' => 'Use interactive elements to keep learners focused.'],
            ['title' => 'Scalability', 'description' => 'Support thousands of simultaneous learners.'],
            ['title' => 'Data-Driven', 'description' => 'Understand student behavior to improve content.']
        ],
        'faqs' => [
            ['question' => 'How do you handle large volumes of video content?', 'answer' => 'We use optimized streaming protocols and CDN integrations to ensure smooth, high-quality video playback even on slower connections.'],
            ['question' => 'Are your platforms accessible for students with disabilities?', 'answer' => 'Yes, we follow WCAG 2.1 guidelines to ensure our platforms are usable by everyone.']
        ],
        'cta' => [
            'title' => 'Transform Your Educational Vision into Reality',
            'subtitle' => 'Let\'s build a platform that empowers the next generation of learners.',
            'button' => 'Contact Our EdTech Team'
        ]
    ],
    'food-restaurant' => [
        'banner' => [
            'title' => 'Digital Solutions for the Modern Kitchen',
            'subtitle' => 'From online ordering to automated kitchen management, we build the tech that fuels restaurant growth.',
            'badge' => 'RESTAURANT TECH EXPERTS',
        ],
        'statistics' => [
            ['title' => '50%', 'description' => 'Increase in Online Orders', 'icon' => 'fa-solid fa-utensils'],
            ['title' => '30%', 'description' => 'Waste Reduction', 'icon' => 'fa-solid fa-trash-can-arrow-up'],
            ['title' => '2k+', 'description' => 'Restaurants Powered', 'icon' => 'fa-solid fa-shop']
        ],
        'solutions' => [
            ['title' => 'Online Ordering Systems', 'description' => 'Commission-free web and app ordering that keeps your profits.', 'icon' => 'fa-solid fa-mobile-button'],
            ['title' => 'Kitchen Display (KDS)', 'description' => 'Eliminate paper tickets with high-efficiency digital kitchen management.', 'icon' => 'fa-solid fa-tv'],
            ['title' => 'Inventory Management', 'description' => 'Real-time stock tracking with automated supplier alerts.', 'icon' => 'fa-solid fa-box-open'],
            ['title' => 'Loyalty & CRM', 'description' => 'Keep customers coming back with personalized rewards and promos.', 'icon' => 'fa-solid fa-star']
        ],
        'intro' => [
            'title' => 'Cooking Up Digital Success',
            'description' => "The food industry is no longer just about the food—it's about the experience. We help restaurants, dark kitchens, and chains automate their operations and reach more customers through branded digital platforms.\n\nOur tech stack focuses on speed and reliability, ensuring that orders flow smoothly from the customer's phone to the chef's screen without a hitch."
        ],
        'about' => [
            'title' => 'Tech for Every Taste',
            'description' => 'We build tools that simplify the complex world of restaurant management.',
            'detailed_overview' => "We understand the fast-paced nature of the food business. Our systems are designed for high-stress environments where every second counts. We integrate seamlessly with popular payment gateways, delivery partners, and accounting software to provide a truly unified management experience."
        ],
        'highlights' => [
            'Real-Time Order Tracking',
            'Dynamic Menu Management',
            'Multi-Location Central Control',
            'Third-Party Delivery Sync',
            'Contactless In-Store Ordering',
            'Advanced Sales Analytics'
        ],
        'advantages' => [
            ['title' => 'Lower Commissions', 'description' => 'Stop giving 30% to third parties; take direct orders.'],
            ['title' => 'Better Efficiency', 'description' => 'Reduce mistakes in the kitchen and the dining room.'],
            ['title' => 'Customer Insights', 'description' => 'Know what your customers love and when they buy it.'],
            ['title' => 'Higher Revenue', 'description' => 'Upsell automatically through your digital menu.']
        ],
        'faqs' => [
            ['question' => 'Can you sync with our existing POS?', 'answer' => 'Yes, we have experience integrating with major POS systems like Toast, Square, and Revel.'],
            ['question' => 'How do you handle delivery management?', 'answer' => 'We can build custom driver apps or integrate with delivery services like DoorDash or UberEats for fulfillment.']
        ],
        'cta' => [
            'title' => 'Ready to Modernize Your Restaurant?',
            'subtitle' => 'Let\'s build the technology that grows your brand.',
            'button' => 'Talk to Our FoodTech Team'
        ]
    ],
    'retail-ecommerce' => [
        'banner' => [
            'title' => 'Omnichannel Retail Transformation',
            'subtitle' => 'Bridging the gap between physical stores and digital experiences for a truly unified retail journey.',
            'badge' => 'THE FUTURE OF RETAIL',
        ],
        'statistics' => [
            ['title' => '35%', 'description' => 'Omnichannel Revenue Growth', 'icon' => 'fa-solid fa-shop-lock'],
            ['title' => '100%', 'description' => 'Inventory Accuracy', 'icon' => 'fa-solid fa-clipboard-check'],
            ['title' => '25%', 'description' => 'Higher Customer Retention', 'icon' => 'fa-solid fa-heart-circle-check']
        ],
        'solutions' => [
            ['title' => 'Unified Commerce', 'description' => 'Single platform for inventory, customers, and orders across all channels.', 'icon' => 'fa-solid fa-arrows-to-circle'],
            ['title' => 'In-Store Experience', 'description' => 'Digital kiosks, smart mirrors, and mobile POS for your physical locations.', 'icon' => 'fa-solid fa-tablet-screen-button'],
            ['title' => 'Retail Analytics', 'description' => 'Predictive stock management and store performance heatmaps.', 'icon' => 'fa-solid fa-chart-column'],
            ['title' => 'Supply Chain Tech', 'description' => 'End-to-end visibility from the warehouse to the customer\'s door.', 'icon' => 'fa-solid fa-truck-ramp-box']
        ],
        'intro' => [
            'title' => 'Connecting Every Touchpoint',
            'description' => "Modern retail happens everywhere. Your customers expect to buy online and pick up in-store, or return in-store what they bought on their phone. We build the infrastructure that makes these complex journeys seamless.\n\nOur retail solutions focus on real-time data synchronization, ensuring that your inventory is always accurate and your customer data is always unified, no matter where the interaction happens."
        ],
        'about' => [
            'title' => 'Intelligence in Every Interaction',
            'description' => 'We help retailers move from siloed operations to a truly connected digital ecosystem.',
            'detailed_overview' => "Our team specializes in complex integrations—connecting your ERP, your POS, and your online store into a single source of truth. We prioritize data integrity and system reliability, ensuring your retail machine runs smoothly 24/7."
        ],
        'highlights' => [
            'Click & Collect (BOPIS) Ready',
            'End-to-End Inventory Visibility',
            'Personalized In-Store Digital Aids',
            'Robust POS Integrations',
            'Cross-Channel Loyalty Programs',
            'Real-Time Warehouse Sync'
        ],
        'advantages' => [
            ['title' => 'Zero Stock-Outs', 'description' => 'Predictive alerts tell you when to restock before you run out.'],
            ['title' => 'Unified Customer View', 'description' => 'Recognize your customers whether they are online or in-store.'],
            ['title' => 'Faster Fulfillment', 'description' => 'Ship from the store or the warehouse with equal ease.'],
            ['title' => 'Better Margins', 'description' => 'Optimize pricing and inventory to protect your bottom line.']
        ],
        'faqs' => [
            ['question' => 'How long does a full omnichannel transformation take?', 'answer' => 'It depends on your current stack, but we typically implement phased rollouts over 3 to 6 months.'],
            ['question' => 'Can you work with our existing ERP?', 'answer' => 'Yes, we are experts at integrating with SAP, Oracle, NetSuite, and Microsoft Dynamics.']
        ],
        'cta' => [
            'title' => 'Ready to Unify Your Retail Brand?',
            'subtitle' => 'Let\'s build the omnichannel future together.',
            'button' => 'Contact Our Retail Experts'
        ]
    ]
];

foreach ($industries as $slug => $data) {
    $industry = Industry::where('slug', $slug)->first();
    if ($industry) {
        // Merge with existing meta if needed, but here we overwrite for maximum premium quality
        $industry->update(['content_data' => $data]);
        echo "Successfully updated Industry with deep content: {$slug}\n";
    } else {
        echo "Warning: Industry with slug '{$slug}' not found.\n";
    }
}

echo "Done! All industries have been updated with rich, professional, and data-driven content.\n";
