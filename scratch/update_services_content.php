<?php

use App\Models\Service;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$updates = [
    'custom-software-development' => [
        'summary' => 'Tailored software solutions designed to solve complex business challenges and drive operational efficiency.',
        'content_data' => [
            'banner' => [
                'title' => 'Bespoke Software Solutions for Modern Enterprises',
                'subtitle' => 'We engineer scalable, secure, and high-performance custom software that transforms your business vision into a competitive advantage.',
                'badge' => 'ENTERPRISE READY',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ],
            'highlights' => ['Scalable Architecture', 'Agile Methodology', 'Cloud-Native Design', 'Enterprise Security'],
            'statistics' => [
                ['title' => '98%', 'description' => 'Client Satisfaction', 'icon' => 'fa-solid fa-face-smile'],
                ['title' => '500+', 'description' => 'Projects Delivered', 'icon' => 'fa-solid fa-rocket'],
                ['title' => '24/7', 'description' => 'Support Available', 'icon' => 'fa-solid fa-headset'],
                ['title' => '15+', 'description' => 'Years Experience', 'icon' => 'fa-solid fa-award']
            ],
            'features_title' => 'Comprehensive Development Expertise',
            'features' => [
                ['title' => 'Enterprise Applications', 'description' => 'Robust systems built to handle large-scale operations and complex data workflows.', 'icon' => 'fa-solid fa-layer-group'],
                ['title' => 'Cloud Solutions', 'description' => 'Modernizing your infrastructure with scalable cloud-native architectures.', 'icon' => 'fa-solid fa-cloud'],
                ['title' => 'Legacy Modernization', 'description' => 'Upgrading outdated systems to modern technologies without disrupting your business.', 'icon' => 'fa-solid fa-microchip']
            ],
            'approach' => [
                'title' => 'Our Strategic Development Lifecycle',
                'description' => "We don't just write code; we build solutions. Our approach begins with a deep dive into your business processes to identify bottlenecks and opportunities for automation.",
                'description2' => 'By combining agile development with rigorous quality assurance, we ensure that every deployment is stable, secure, and perfectly aligned with your goals.'
            ],
            'solutions' => [
                ['title' => 'SaaS Platforms', 'description' => 'Scalable multi-tenant architectures for your next big product.'],
                ['title' => 'CRM & ERP Systems', 'description' => 'Customized internal tools to streamline your operations.'],
                ['title' => 'API Integrations', 'description' => 'Connecting your ecosystem for seamless data flow.']
            ],
            'achievements' => [
                ['title' => '150+', 'description' => 'Enterprise Clients'],
                ['title' => '10M+', 'description' => 'Lines of Code'],
                ['title' => 'Zero', 'description' => 'Security Breaches'],
                ['title' => '5.0', 'description' => 'Average Rating']
            ],
            'why_choose' => [
                'title' => 'Why Partner with Devent for Software?',
                'description' => 'We bring a unique blend of technical excellence and business acumen to every project, ensuring your software is not just a tool, but a growth engine.'
            ],
            'why_choose_points' => ['Expert Senior Developers', 'Transparency at Every Step', 'Post-Launch Excellence', 'Cost-Effective Scaling'],
            'process' => [
                ['title' => 'Discovery', 'description' => 'Analyzing requirements and planning architecture.'],
                ['title' => 'Development', 'description' => 'Iterative coding with regular feedback loops.'],
                ['title' => 'QA & Testing', 'description' => 'Rigorous automated and manual testing.'],
                ['title' => 'Deployment', 'description' => 'Smooth rollout and infrastructure setup.'],
                ['title' => 'Maintenance', 'description' => 'Ongoing support and continuous improvement.']
            ],
            'frameworks' => [
                ['title' => 'Laravel', 'description' => 'The world\'s best PHP framework for enterprise apps.'],
                ['title' => 'Node.js', 'description' => 'High-performance real-time backend systems.'],
                ['title' => 'Python', 'description' => 'Scaleable data-driven and AI solutions.'],
                ['title' => 'React', 'description' => 'Rich, interactive user interfaces.']
            ],
            'faqs' => [
                ['question' => 'How long does a typical project take?', 'answer' => 'Timelines vary based on complexity, but most enterprise solutions take 3-6 months.'],
                ['question' => 'Do you provide maintenance after launch?', 'answer' => 'Yes, we offer comprehensive support and maintenance packages.']
            ],
            'cta' => ['title' => 'Ready to Build Your Custom Solution?', 'button' => 'Start Your Project'],
            'cta2' => ['title' => 'Let\'s Redefine Your Business with Software', 'button' => 'Get a Free Quote']
        ]
    ],
    'mobile-app-development' => [
        'summary' => 'Creating high-performance iOS and Android applications that provide seamless user experiences and drive engagement.',
        'content_data' => [
            'banner' => [
                'title' => 'Next-Generation Mobile Applications',
                'subtitle' => 'From concept to App Store, we build mobile experiences that users love and businesses rely on.',
                'badge' => 'MOBILE FIRST',
            ],
            'statistics' => [
                ['title' => '2M+', 'description' => 'App Downloads', 'icon' => 'fa-solid fa-download'],
                ['title' => '4.8', 'description' => 'Average Rating', 'icon' => 'fa-solid fa-star'],
                ['title' => '100%', 'description' => 'App Store Success', 'icon' => 'fa-brands fa-app-store'],
                ['title' => '50+', 'description' => 'Expert Developers', 'icon' => 'fa-solid fa-users-gear']
            ],
            'highlights' => ['Native Performance', 'Intuitive UI/UX', 'Offline Capabilities', 'Real-time Sync'],
            'features' => [
                ['title' => 'iOS Development', 'description' => 'Premium Swift and SwiftUI apps for the Apple ecosystem.', 'icon' => 'fa-brands fa-apple'],
                ['title' => 'Android Development', 'description' => 'High-performance Kotlin apps for all Android devices.', 'icon' => 'fa-brands fa-android'],
                ['title' => 'Cross-Platform', 'description' => 'Efficient Flutter and React Native solutions for dual-platform reach.', 'icon' => 'fa-solid fa-mobile-screen']
            ],
            'approach' => [
                'title' => 'A User-Centric Mobile Strategy',
                'description' => 'We focus on the "thumb-friendly" experience. Every tap, swipe, and transition is designed to feel natural and responsive.',
                'description2' => 'Our development process prioritizes battery efficiency and low-latency performance to ensure high user retention.'
            ],
            'solutions' => [
                ['title' => 'E-commerce Apps', 'description' => 'Mobile shopping experiences that convert browsers into buyers.'],
                ['title' => 'Social Networking', 'description' => 'Scalable platforms for community engagement.'],
                ['title' => 'Fintech Solutions', 'description' => 'Secure and compliant mobile banking and payment apps.']
            ],
            'achievements' => [
                ['title' => '2M+', 'description' => 'App Downloads'],
                ['title' => '4.8', 'description' => 'App Store Rating'],
                ['title' => '50+', 'description' => 'Successful Launches'],
                ['title' => '10ms', 'description' => 'Average Latency']
            ],
            'why_choose' => [
                'title' => 'Why Choose Devent for Mobile?',
                'description' => 'We combine technical mastery with a deep understanding of mobile user behavior to deliver apps that stand out in a crowded market.'
            ],
            'why_choose_points' => ['Stunning Visual Design', 'Robust Offline Support', 'Scalable Backend API', 'App Store Optimization'],
            'process' => [
                ['title' => 'UI/UX Design', 'description' => 'Creating interactive prototypes and high-fidelity mockups.'],
                ['title' => 'App Development', 'description' => 'Coding the frontend and integrating backend APIs.'],
                ['title' => 'Testing', 'description' => 'Testing on real devices for performance and usability.'],
                ['title' => 'App Store Submission', 'description' => 'Handling the complex review and approval process.'],
                ['title' => 'Post-Launch', 'description' => 'Monitoring analytics and iterative updates.']
            ],
            'frameworks' => [
                ['title' => 'Flutter', 'description' => 'Fast, expressive cross-platform apps.'],
                ['title' => 'React Native', 'description' => 'Native apps using the power of React.'],
                ['title' => 'Swift', 'description' => 'High-performance iOS native apps.'],
                ['title' => 'Kotlin', 'description' => 'Modern, secure Android native development.']
            ],
            'faqs' => [
                ['question' => 'Do you build for both iOS and Android?', 'answer' => 'Yes, we specialize in both native and cross-platform development.'],
                ['question' => 'Can you help with App Store submission?', 'answer' => 'Absolutely, we handle the entire process from submission to approval.']
            ],
            'cta' => ['title' => 'Have a Groundbreaking App Idea?', 'button' => 'Talk to Our Experts'],
            'cta2' => ['title' => 'Launch Your Mobile Presence Today', 'button' => 'Start Your App']
        ]
    ],
    'digital-marketing' => [
        'summary' => 'Accelerating your brand growth through data-driven digital marketing strategies and creative campaigns.',
        'content_data' => [
            'banner' => [
                'title' => 'Growth-Focused Digital Marketing',
                'subtitle' => 'We combine creativity with data science to deliver marketing campaigns that generate ROI and build brand loyalty.',
                'badge' => 'ROI DRIVEN',
            ],
            'statistics' => [
                ['title' => '300%', 'description' => 'Average ROI', 'icon' => 'fa-solid fa-chart-line'],
                ['title' => '1M+', 'description' => 'Leads Generated', 'icon' => 'fa-solid fa-users-viewfinder'],
                ['title' => '200+', 'description' => 'Global Brands', 'icon' => 'fa-solid fa-globe'],
                ['title' => '50M+', 'description' => 'Ad Reach', 'icon' => 'fa-solid fa-eye']
            ],
            'highlights' => ['Performance Marketing', 'Brand Strategy', 'Content Creation', 'Data Analytics'],
            'features' => [
                ['title' => 'Social Media Marketing', 'description' => 'Engaging your audience where they spend their time.', 'icon' => 'fa-brands fa-instagram'],
                ['title' => 'PPC Campaigns', 'description' => 'High-conversion Google and Meta ad strategies.', 'icon' => 'fa-solid fa-bullhorn'],
                ['title' => 'Email Marketing', 'description' => 'Automated funnels that nurture and convert leads.', 'icon' => 'fa-solid fa-envelope-open-text']
            ],
            'approach' => [
                'title' => 'A Data-First Marketing Philosophy',
                'description' => 'We don\'t believe in guesswork. Every campaign we run is backed by rigorous market research and competitor analysis.',
                'description2' => 'By constantly monitoring KPIs and A/B testing creative assets, we ensure your marketing budget is spent effectively.'
            ],
            'solutions' => [
                ['title' => 'Lead Generation', 'description' => 'Filling your sales pipeline with high-quality prospects.'],
                ['title' => 'Brand Identity', 'description' => 'Crafting a unique voice and visual style for your business.'],
                ['title' => 'Influencer Marketing', 'description' => 'Leveraging key voices to amplify your brand message.']
            ],
            'achievements' => [
                ['title' => '300%', 'description' => 'Average ROI Increase'],
                ['title' => '1M+', 'description' => 'Leads Generated'],
                ['title' => '200+', 'description' => 'Brands Scaled'],
                ['title' => '50M+', 'description' => 'Ad Impressions']
            ],
            'why_choose' => [
                'title' => 'Why Partner with Devent for Growth?',
                'description' => 'We act as your extended marketing department, deeply invested in your success and focused on sustainable long-term growth.'
            ],
            'why_choose_points' => ['Transparent Reporting', 'Omnichannel Strategy', 'Creative Excellence', 'Conversion Optimization'],
            'process' => [
                ['title' => 'Audit', 'description' => 'Analyzing your current presence and competitors.'],
                ['title' => 'Strategy', 'description' => 'Defining goals, target audience, and channel mix.'],
                ['title' => 'Execution', 'description' => 'Launching campaigns and creating content.'],
                ['title' => 'Optimization', 'description' => 'Daily monitoring and performance tuning.'],
                ['title' => 'Reporting', 'description' => 'Bi-weekly deep dives into ROI and results.']
            ],
            'frameworks' => [
                ['title' => 'Google Ads', 'description' => 'Precision-targeted paid search.'],
                ['title' => 'Meta Ads', 'description' => 'Engaging social media advertising.'],
                ['title' => 'HubSpot', 'description' => 'Inbound marketing and sales automation.'],
                ['title' => 'Mailchimp', 'description' => 'Advanced email marketing funnels.']
            ],
            'faqs' => [
                ['question' => 'How soon can I expect results?', 'answer' => 'PPC can show results immediately, while brand building and SEO-driven marketing take 3-6 months.'],
                ['question' => 'Do you handle creative content?', 'answer' => 'Yes, our in-house design and content teams handle all creative requirements.']
            ],
            'cta' => ['title' => 'Want to Scale Your Revenue?', 'button' => 'Get a Free Audit'],
            'cta2' => ['title' => 'Stop Guessing, Start Growing', 'button' => 'Consult Our Strategists']
        ]
    ],
    'graphics-design' => [
        'summary' => 'Crafting stunning visual identities and digital assets that captivate your audience and communicate your brand values.',
        'content_data' => [
            'banner' => [
                'title' => 'Visual Storytelling Through Design',
                'subtitle' => 'We create high-impact graphics and brand identities that leave a lasting impression and set you apart from the competition.',
                'badge' => 'CREATIVE HUB',
            ],
            'statistics' => [
                ['title' => '100%', 'description' => 'Original Concepts', 'icon' => 'fa-solid fa-lightbulb'],
                ['title' => '500+', 'description' => 'Logos Created', 'icon' => 'fa-solid fa-pen-nib'],
                ['title' => '24h', 'description' => 'Average Turnaround', 'icon' => 'fa-solid fa-clock'],
                ['title' => '15+', 'description' => 'Design Awards', 'icon' => 'fa-solid fa-trophy']
            ],
            'highlights' => ['Brand Identity', 'UI/UX Design', 'Marketing Collateral', 'Motion Graphics'],
            'features' => [
                ['title' => 'Logo & Branding', 'description' => 'Creating the face of your company with unique visual systems.', 'icon' => 'fa-solid fa-pen-nib'],
                ['title' => 'UI/UX Design', 'description' => 'User-friendly interfaces for web and mobile platforms.', 'icon' => 'fa-solid fa-wand-magic-sparkles'],
                ['title' => 'Print Media', 'description' => 'Professional brochures, business cards, and packaging.', 'icon' => 'fa-solid fa-print']
            ],
            'approach' => [
                'title' => 'Design with Purpose',
                'description' => 'Design is more than just looking good; it\'s about communication. We start by understanding your brand values and target demographic.',
                'description2' => 'Our iterative design process involves mood boards, sketching, and refining until the visual language perfectly matches your intent.'
            ],
            'solutions' => [
                ['title' => 'Brand Style Guides', 'description' => 'Ensuring consistency across all your touchpoints.'],
                ['title' => 'Social Media Assets', 'description' => 'Eye-catching posts and banners for digital engagement.'],
                ['title' => 'Illustration & Iconography', 'description' => 'Custom-drawn elements that add personality to your brand.']
            ],
            'achievements' => [
                ['title' => '500+', 'description' => 'Logos Designed'],
                ['title' => '100+', 'description' => 'Brand Identities'],
                ['title' => '1k+', 'description' => 'UI Screens Designed'],
                ['title' => '10+', 'description' => 'Design Awards']
            ],
            'why_choose' => [
                'title' => 'Why Choose Devent Creative?',
                'description' => 'We don\'t use templates. Every design we produce is handcrafted to tell your unique story and connect with your audience.'
            ],
            'why_choose_points' => ['Unlimited Revisions', 'Original Concepts', 'Fast Turnaround', 'Versatile Styles'],
            'process' => [
                ['title' => 'Briefing', 'description' => 'Understanding your vision and style preferences.'],
                ['title' => 'Mood Boarding', 'description' => 'Defining the color palette and typography.'],
                ['title' => 'Concept Design', 'description' => 'Presenting initial ideas and directions.'],
                ['title' => 'Refinement', 'description' => 'Polishing the chosen direction based on feedback.'],
                ['title' => 'Delivery', 'description' => 'Providing all necessary file formats and guidelines.']
            ],
            'frameworks' => [
                ['title' => 'Figma', 'description' => 'Leading collaborative interface design.'],
                ['title' => 'Illustrator', 'description' => 'Vector graphics and brand design.'],
                ['title' => 'Photoshop', 'description' => 'Rich image editing and composition.'],
                ['title' => 'After Effects', 'description' => 'High-end motion and video graphics.']
            ],
            'faqs' => [
                ['question' => 'Who owns the copyright to the designs?', 'answer' => 'You do. Once the project is complete and paid for, you own full rights to all deliverables.'],
                ['question' => 'Can you work with my existing brand guidelines?', 'answer' => 'Yes, we are experts at adapting to and extending existing brand systems.']
            ],
            'cta' => ['title' => 'Need a Visual Refresh?', 'button' => 'View Our Portfolio'],
            'cta2' => ['title' => 'Design Your Future with Us', 'button' => 'Start a Design Project']
        ]
    ],
    'seo-services' => [
        'summary' => 'Optimizing your online visibility to drive organic traffic and achieve higher rankings on search engine results pages.',
        'content_data' => [
            'banner' => [
                'title' => 'Dominate Search Results',
                'subtitle' => 'Our data-driven SEO strategies help you climb the rankings, capture high-intent traffic, and outshine your competition.',
                'badge' => 'ORGANIC GROWTH',
            ],
            'statistics' => [
                ['title' => '10x', 'description' => 'Traffic Growth', 'icon' => 'fa-solid fa-arrow-up-right-dots'],
                ['title' => '5k+', 'description' => 'Keywords on Page 1', 'icon' => 'fa-solid fa-list-ol'],
                ['title' => '95%', 'description' => 'Success Rate', 'icon' => 'fa-solid fa-check-double'],
                ['title' => '0', 'description' => 'Penalty History', 'icon' => 'fa-solid fa-shield-heart']
            ],
            'highlights' => ['Technical SEO', 'Keyword Research', 'Link Building', 'Content Optimization'],
            'features' => [
                ['title' => 'On-Page SEO', 'description' => 'Optimizing your content and meta tags for maximum relevance.', 'icon' => 'fa-solid fa-magnifying-glass-chart'],
                ['title' => 'Technical Audits', 'description' => 'Fixing crawl errors, site speed, and mobile responsiveness.', 'icon' => 'fa-solid fa-code'],
                ['title' => 'Off-Page SEO', 'description' => 'Building authority through high-quality backlinks and PR.', 'icon' => 'fa-solid fa-link']
            ],
            'approach' => [
                'title' => 'Sustainable SEO Strategy',
                'description' => 'We focus on "white-hat" SEO techniques that build long-term authority. No shortcuts, just consistent performance.',
                'description2' => 'By aligning your technical infrastructure with Google\'s E-E-A-T guidelines, we ensure your rankings are stable and resilient.'
            ],
            'solutions' => [
                ['title' => 'Local SEO', 'description' => 'Getting your business found in local search and Maps.'],
                ['title' => 'E-commerce SEO', 'description' => 'Driving sales through product page optimization.'],
                ['title' => 'Content Strategy', 'description' => 'Creating blogs and landing pages that answer user intent.']
            ],
            'achievements' => [
                ['title' => '10x', 'description' => 'Traffic Growth'],
                ['title' => '5k+', 'description' => 'Keywords on Page 1'],
                ['title' => '200%', 'description' => 'Conversion Increase'],
                ['title' => '90+', 'description' => 'Average Domain Authority']
            ],
            'why_choose' => [
                'title' => 'Why Partner with Our SEO Experts?',
                'description' => 'We provide complete transparency with monthly reports and focus on metrics that matter: leads and revenue, not just rankings.'
            ],
            'why_choose_points' => ['No Hidden Techniques', 'Data-Driven Keyword Selection', 'Industry-Leading Backlinks', 'Weekly Performance Monitoring'],
            'process' => [
                ['title' => 'Site Audit', 'description' => 'Deep dive into technical and on-page issues.'],
                ['title' => 'Keyword Research', 'description' => 'Identifying high-volume, low-competition opportunities.'],
                ['title' => 'Implementation', 'description' => 'Optimizing code and publishing new content.'],
                ['title' => 'Link Building', 'description' => 'Earning mentions from authoritative websites.'],
                ['title' => 'Analysis', 'description' => 'Monitoring growth and refining the strategy.']
            ],
            'frameworks' => [
                ['title' => 'Ahrefs', 'description' => 'Premier tool for backlink and competitor analysis.'],
                ['title' => 'SEMrush', 'description' => 'Comprehensive SEO and PPC research.'],
                ['title' => 'Google Console', 'description' => 'Official site health and search data.'],
                ['title' => 'Screaming Frog', 'description' => 'Advanced technical site auditing.']
            ],
            'faqs' => [
                ['question' => 'How long until I see results?', 'answer' => 'SEO is a marathon. Typically, significant growth is seen within 3-6 months.'],
                ['question' => 'Do you guarantee Page 1 rankings?', 'answer' => 'No reputable SEO agency can guarantee specific rankings, but we guarantee improved visibility and traffic.']
            ],
            'cta' => ['title' => 'Is Your Website Invisible?', 'button' => 'Get a Free SEO Audit'],
            'cta2' => ['title' => 'Claim Your Top Spot Today', 'button' => 'Start Your SEO Journey']
        ]
    ],
    'domain-hosting' => [
        'summary' => 'Reliable domain registration and ultra-fast cloud hosting solutions to keep your website online and performing at its best.',
        'content_data' => [
            'banner' => [
                'title' => 'Fast, Secure & Reliable Hosting',
                'subtitle' => 'The foundation of your digital presence. We provide high-performance cloud infrastructure and seamless domain management.',
                'badge' => '99.9% UPTIME',
            ],
            'statistics' => [
                ['title' => '99.9%', 'description' => 'Uptime Guarantee', 'icon' => 'fa-solid fa-server'],
                ['title' => '200ms', 'description' => 'Avg. Server Response', 'icon' => 'fa-solid fa-bolt-lightning'],
                ['title' => 'Free', 'description' => 'SSL & Migration', 'icon' => 'fa-solid fa-unlock-keyhole'],
                ['title' => '24/7', 'description' => 'Expert Support', 'icon' => 'fa-solid fa-user-tie']
            ],
            'highlights' => ['SSD Storage', 'Free SSL Certificates', 'Daily Backups', 'Global CDN'],
            'features' => [
                ['title' => 'Cloud Hosting', 'description' => 'Scalable resources that grow with your traffic.', 'icon' => 'fa-solid fa-server'],
                ['title' => 'Domain Registration', 'description' => 'Secure your perfect brand name with ease.', 'icon' => 'fa-solid fa-globe'],
                ['title' => 'Managed Security', 'description' => 'DDoS protection and malware scanning included.', 'icon' => 'fa-solid fa-shield-virus']
            ],
            'approach' => [
                'title' => 'Infrastructure Excellence',
                'description' => 'We utilize Tier-4 data centers and LiteSpeed web servers to ensure your site loads in under a second.',
                'description2' => 'Our proactive monitoring team ensures that potential issues are identified and resolved before they affect your users.'
            ],
            'solutions' => [
                ['title' => 'WordPress Hosting', 'description' => 'Optimized for speed and security for WP sites.'],
                ['title' => 'VPS Hosting', 'description' => 'Dedicated resources for high-traffic applications.'],
                ['title' => 'Email Hosting', 'description' => 'Professional @yourbrand.com mailboxes.']
            ],
            'achievements' => [
                ['title' => '99.99%', 'description' => 'Actual Uptime'],
                ['title' => '200ms', 'description' => 'Average TTFB'],
                ['title' => '10k+', 'description' => 'Active Domains'],
                ['title' => '24/7', 'description' => 'Human Support']
            ],
            'why_choose' => [
                'title' => 'Why Host with Devent?',
                'description' => 'We don\'t just sell space; we provide a managed environment where performance and security are the top priorities.'
            ],
            'why_choose_points' => ['One-Click Installs', 'Free Website Migration', 'Advanced Caching', 'Staging Environments'],
            'process' => [
                ['title' => 'Selection', 'description' => 'Choosing the right plan for your traffic needs.'],
                ['title' => 'Setup', 'description' => 'Provisioning your server and configuring SSL.'],
                ['title' => 'Migration', 'description' => 'Moving your existing site with zero downtime.'],
                ['title' => 'Optimization', 'description' => 'Fine-tuning settings for maximum speed.'],
                ['title' => 'Monitoring', 'description' => 'Continuous health and security checks.']
            ],
            'frameworks' => [
                ['title' => 'AWS', 'description' => 'Global cloud infrastructure leader.'],
                ['title' => 'LiteSpeed', 'description' => 'Ultra-fast web server technology.'],
                ['title' => 'Cloudflare', 'description' => 'Premium CDN and security edge.'],
                ['title' => 'cPanel', 'description' => 'Industry-standard hosting management.']
            ],
            'faqs' => [
                ['question' => 'Do you offer free migrations?', 'answer' => 'Yes, our team handles the entire move from your old host for free.'],
                ['question' => 'Is SSL included?', 'answer' => 'Yes, we provide free Let\'s Encrypt SSL certificates for all domains.']
            ],
            'cta' => ['title' => 'Need a Faster Website?', 'button' => 'Explore Hosting Plans'],
            'cta2' => ['title' => 'Your Site Deserves Better Speed', 'button' => 'Migrate to Devent']
        ]
    ],
    'software-development-consulting' => [
        'summary' => 'Expert technical guidance and strategic consulting to help you navigate complex technology decisions and optimize your development workflows.',
        'content_data' => [
            'banner' => [
                'title' => 'Strategic Technology Consulting',
                'subtitle' => 'Bridge the gap between business goals and technical execution with our expert-led software consultancy.',
                'badge' => 'EXPERT ADVISORY',
            ],
            'statistics' => [
                ['title' => '20+', 'description' => 'Years Experience', 'icon' => 'fa-solid fa-calendar-check'],
                ['title' => '100+', 'description' => 'Consulting Projects', 'icon' => 'fa-solid fa-diagram-project'],
                ['title' => '30%', 'description' => 'Avg. Cost Saving', 'icon' => 'fa-solid fa-piggy-bank'],
                ['title' => 'Elite', 'description' => 'Advisory Team', 'icon' => 'fa-solid fa-user-graduate']
            ],
            'highlights' => ['Tech Stack Selection', 'Code Audits', 'Digital Roadmap', 'Team Training'],
            'features' => [
                ['title' => 'Digital Transformation', 'description' => 'Modernizing your business model for the digital age.', 'icon' => 'fa-solid fa-arrows-spin'],
                ['title' => 'Architecture Review', 'description' => 'Identifying bottlenecks in your current technical setup.', 'icon' => 'fa-solid fa-sitemap'],
                ['title' => 'Process Optimization', 'description' => 'Implementing Agile/DevOps best practices.', 'icon' => 'fa-solid fa-gauge-high']
            ],
            'approach' => [
                'title' => 'A Holistic Technical View',
                'description' => 'We don\'t just look at the code; we look at the culture and the business objectives. Our goal is to make your tech work for you.',
                'description2' => 'Our consultants bring decades of experience across diverse industries to help you avoid common pitfalls and expensive mistakes.'
            ],
            'solutions' => [
                ['title' => 'CTO-as-a-Service', 'description' => 'Executive-level technical leadership for startups.'],
                ['title' => 'Cloud Migration Roadmap', 'description' => 'Step-by-step plans for moving to AWS/Azure.'],
                ['title' => 'Cybersecurity Strategy', 'description' => 'Protecting your digital assets and user data.']
            ],
            'achievements' => [
                ['title' => '20+', 'description' => 'Years Experience'],
                ['title' => '100+', 'description' => 'Consulting Projects'],
                ['title' => '30%', 'description' => 'Average Cost Saving'],
                ['title' => '50+', 'description' => 'Tech Stacks Mastered']
            ],
            'why_choose' => [
                'title' => 'Why Trust Our Consultants?',
                'description' => 'We offer unbiased, expert advice focused on finding the most efficient and sustainable path to your business goals.'
            ],
            'why_choose_points' => ['Vendor Neutral Advice', 'Actionable Insights', 'Hands-on Support', 'Long-term Partnership'],
            'process' => [
                ['title' => 'Discovery', 'description' => 'Interviewing stakeholders and reviewing systems.'],
                ['title' => 'Analysis', 'description' => 'Identifying gaps and performance issues.'],
                ['title' => 'Roadmap', 'description' => 'Presenting a prioritized plan of action.'],
                ['title' => 'Execution Support', 'description' => 'Helping your team implement changes.'],
                ['title' => 'Review', 'description' => 'Measuring impact and adjusting strategy.']
            ],
            'frameworks' => [
                ['title' => 'Docker', 'description' => 'Reliable containerization workflows.'],
                ['title' => 'Kubernetes', 'description' => 'Scalable container orchestration.'],
                ['title' => 'Terraform', 'description' => 'Infrastructure as code excellence.'],
                ['title' => 'GitLab', 'description' => 'Modern CI/CD and source control.']
            ],
            'faqs' => [
                ['question' => 'Do you provide temporary CTO services?', 'answer' => 'Yes, we offer fractional CTO services for startups and growing companies.'],
                ['question' => 'Can you help train our internal team?', 'answer' => 'Yes, we provide custom workshops on modern tech stacks and agile processes.']
            ],
            'cta' => ['title' => 'Struggling with Tech Decisions?', 'button' => 'Book a Strategy Call'],
            'cta2' => ['title' => 'Optimize Your Tech Engine Today', 'button' => 'Consult Our Experts']
        ]
    ],
    'retail-e-commerce-software-development' => [
        'summary' => 'Building feature-rich e-commerce platforms and retail software that drive sales, enhance customer loyalty, and streamline inventory management.',
        'content_data' => [
            'banner' => [
                'title' => 'The Future of Retail is Digital',
                'subtitle' => 'We build omnichannel e-commerce experiences that connect brands with customers wherever they shop.',
                'badge' => 'E-COMMERCE PRO',
            ],
            'statistics' => [
                ['title' => '$100M+', 'description' => 'Revenue Processed', 'icon' => 'fa-solid fa-cart-shopping'],
                ['title' => '1M+', 'description' => 'SKUs Managed', 'icon' => 'fa-solid fa-boxes-stacked'],
                ['title' => '40%', 'description' => 'Conversion Uplift', 'icon' => 'fa-solid fa-arrow-up-right-dots'],
                ['title' => '3x', 'description' => 'Fast Checkout', 'icon' => 'fa-solid fa-gauge-high']
            ],
            'highlights' => ['Conversion Focused', 'Inventory Sync', 'Mobile-First UI', 'Secure Payments'],
            'features' => [
                ['title' => 'Custom E-stores', 'description' => 'Fully tailored shopping experiences built from scratch.', 'icon' => 'fa-solid fa-cart-shopping'],
                ['title' => 'POS Integration', 'description' => 'Connecting your physical stores with your online presence.', 'icon' => 'fa-solid fa-cash-register'],
                ['title' => 'Logistics Automation', 'description' => 'Streamlining shipping and order fulfillment.', 'icon' => 'fa-solid fa-truck-fast']
            ],
            'approach' => [
                'title' => 'Sales-Driven Development',
                'description' => 'Every pixel is designed to drive the user toward the "Checkout" button. We focus on removing friction from the shopping journey.',
                'description2' => 'Our platforms are built to handle massive traffic spikes during seasonal sales without compromising performance or security.'
            ],
            'solutions' => [
                ['title' => 'Marketplace Platforms', 'description' => 'Multi-vendor solutions like Amazon or Etsy.'],
                ['title' => 'B2B E-commerce', 'description' => 'Bulk ordering and wholesale management systems.'],
                ['title' => 'Subscription Models', 'description' => 'Recurring revenue platforms and member areas.']
            ],
            'achievements' => [
                ['title' => '$100M+', 'description' => 'GMV Processed'],
                ['title' => '1M+', 'description' => 'SKUs Managed'],
                ['title' => '40%', 'description' => 'Checkout Conversion'],
                ['title' => 'Zero', 'description' => 'Downtime on Black Friday']
            ],
            'why_choose' => [
                'title' => 'Why Partner with Devent for Retail?',
                'description' => 'We understand the retail landscape and build solutions that don\'t just sell products, but build lasting customer relationships.'
            ],
            'why_choose_points' => ['Seamless Payment Gateways', 'Advanced Analytics', 'Global Tax Compliance', 'AI Product Recommendations'],
            'process' => [
                ['title' => 'Store Planning', 'description' => 'User flow mapping and product architecture.'],
                ['title' => 'Design', 'description' => 'Creating a brand-consistent shopping experience.'],
                ['title' => 'Development', 'description' => 'Building the engine and integrating gateways.'],
                ['title' => 'Testing', 'description' => 'Stress testing and checkout validation.'],
                ['title' => 'Scaling', 'description' => 'Optimizing for growth and new markets.']
            ],
            'frameworks' => [
                ['title' => 'Magento', 'description' => 'The gold standard for enterprise commerce.'],
                ['title' => 'Shopify', 'description' => 'Fast and reliable cloud commerce.'],
                ['title' => 'WooCommerce', 'description' => 'Flexible commerce built on WordPress.'],
                ['title' => 'BigCommerce', 'description' => 'Scalable SaaS commerce for growth.']
            ],
            'faqs' => [
                ['question' => 'Can you migrate my store from Shopify to a custom solution?', 'answer' => 'Yes, we specialize in high-stakes migrations with full data integrity.'],
                ['question' => 'Do you integrate with local payment gateways?', 'answer' => 'Yes, we have experience integrating global and local gateways worldwide.']
            ],
            'cta' => ['title' => 'Ready to Skyrocket Your Sales?', 'button' => 'Launch Your Store'],
            'cta2' => ['title' => 'Your Retail Future Starts Here', 'button' => 'Get a Free Consultation']
        ]
    ]
];

foreach ($updates as $slug => $data) {
    $service = Service::where('slug', $slug)->first();
    if ($service) {
        $service->update([
            'summary' => $data['summary'],
            'content_data' => $data['content_data']
        ]);
        echo "Updated: {$slug}\n";
    } else {
        echo "NOT FOUND: {$slug}\n";
    }
}
