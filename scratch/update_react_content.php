<?php
use App\Models\Technology;

$react = Technology::find(2);
if (!$react) {
    echo "React technology not found!";
    exit;
}

$content_data = [
    'banner' => [
        'title' => 'Award-Winning React.js Development Agency',
        'subtitle' => 'Build high-performance, SEO-friendly, and incredibly smooth user interfaces with the world\'s leading frontend library.',
        'badge' => '⚛️ Top-Tier React.js Development Excellence',
        'video_url' => 'https://www.youtube.com/watch?v=hQAHSlTtcmY'
    ],
    'statistics' => [
        ['title' => '200+', 'description' => 'React Web Apps'],
        ['title' => '60fps', 'description' => 'Smooth UI Performance'],
        ['title' => '50+', 'description' => 'Senior React Devs'],
        ['title' => '100%', 'description' => 'Component Reusability']
    ],
    'intro' => [
        'title' => 'Crafting Immersive Digital Experiences',
        'description' => 'React is more than just a library; it\'s a standard for modern web development. We help you leverage its power to build applications that feel like native apps in the browser.'
    ],
    'about' => [
        'title' => 'State-of-the-Art Frontend Engineering',
        'description' => 'React allows us to build complex user interfaces out of small, isolated pieces called components. This approach significantly reduces development time and long-term maintenance costs.',
        'detailed_overview' => 'At Devent, we don\'t just use React; we master it. From complex state management with Redux and Zustand to high-performance rendering with Next.js, we ensure every pixel is optimized for speed and user experience. We specialize in building Atomic Design systems that allow your brand to scale consistently across all digital touchpoints.'
    ],
    'highlights' => [
        'Declarative UI Design',
        'Component-Based Architecture',
        'Virtual DOM Efficiency',
        'Strong Ecosystem & Tooling',
        'React Native for Mobile',
        'Advanced State Management'
    ],
    'solutions_label' => 'FRONTEND SERVICES',
    'solutions_title' => 'Expert React.js Development Expertise',
    'solutions' => [
        ['title' => 'Custom SPA Development', 'description' => 'Fast and interactive Single Page Applications using modern React hooks.'],
        ['title' => 'Next.js (SSR & SSG)', 'description' => 'SEO-optimized, lightning-fast web apps with Server-Side Rendering.'],
        ['title' => 'UI/UX to React Conversion', 'description' => 'Pixel-perfect transformation of Figma/Adobe XD designs into React code.'],
        ['title' => 'React Native Mobile Apps', 'description' => 'High-quality iOS and Android apps using a single codebase.'],
        ['title' => 'Enterprise Component Libraries', 'description' => 'Building scalable, reusable UI systems for large organizations.'],
        ['title' => 'React Migration Services', 'description' => 'Modernizing legacy jQuery or Angular apps to a robust React stack.']
    ],
    'features_title' => 'Why React.js Dominates the Modern Web',
    'features' => [
        ['title' => 'Unmatched Speed', 'description' => 'Virtual DOM minimizes expensive browser operations for fluid interactions.'],
        ['title' => 'Developer-Friendly', 'description' => 'Intuitive syntax and world-class debugging tools like React DevTools.'],
        ['title' => 'Massive Community', 'description' => 'Infinite plugins, components, and solutions available at your fingertips.'],
        ['title' => 'SEO Compatibility', 'description' => 'Combined with Next.js, React delivers excellent search engine rankings.'],
        ['title' => 'Proven Stability', 'description' => 'Maintained by Meta and used by giants like Netflix, Airbnb, and Facebook.'],
        ['title' => 'Backward Compatibility', 'description' => 'Reliable upgrade paths ensure your application stays modern for years.']
    ],
    'advantages' => [
        ['title' => 'Superior Performance', 'description' => 'Fast rendering even with complex data sets.'],
        ['title' => 'Fast Development', 'description' => 'Reusable components drastically cut down coding time.'],
        ['title' => 'Flexible Integration', 'description' => 'Works seamlessly with any backend or third-party service.'],
        ['title' => 'Talent Availability', 'description' => 'Vast pool of skilled developers worldwide.']
    ],
    'process_title' => 'Our Scientific React Development Process',
    'process' => [
        ['title' => 'Technical Discovery', 'description' => 'Defining component structure, state flow, and routing strategy.'],
        ['title' => 'UI/UX Blueprinting', 'description' => 'Creating interactive prototypes and design-to-code mapping.'],
        ['title' => 'Component Development', 'description' => 'Writing modular, unit-tested functional components with TypeScript.'],
        ['title' => 'State & Logic Integration', 'description' => 'Implementing efficient global and local state management solutions.'],
        ['title' => 'Performance Optimization', 'description' => 'Code splitting, lazy loading, and bundle size minimization.'],
        ['title' => 'Deployment & Monitoring', 'description' => 'Vercel/AWS deployment with real-user monitoring and analytics.']
    ],
    'why_choose' => [
        'title' => 'Why Devent is Your Best React Partner',
        'description' => 'We combine creative design with engineering rigour to build React apps that win awards and drive revenue.'
    ],
    'industries_title' => 'Industries We Power with React',
    'industries_served' => [
        ['title' => 'SaaS Platforms', 'description' => 'fa-solid fa-cloud-bolt'],
        ['title' => 'E-Commerce', 'description' => 'fa-solid fa-bag-shopping'],
        ['title' => 'Social Media', 'description' => 'fa-solid fa-hashtag'],
        ['title' => 'EdTech', 'description' => 'fa-solid fa-user-graduate']
    ],
    'engagement_title' => 'Collaboration Models',
    'engagement_models' => [
        ['title' => 'Project-Based', 'description' => 'Fixed price for clearly defined software requirements.'],
        ['title' => 'Staff Augmentation', 'description' => 'Integrating our senior React devs into your existing team.'],
        ['title' => 'MVP Development', 'description' => 'Rapid development to get your product to market fast.']
    ],
    'hiring' => [
        'title' => 'Build Your Dream React Team',
        'description' => 'Scale your engineering capacity with our pre-vetted senior React and Next.js developers.'
    ],
    'tech_stack_title' => 'Our React Ecosystem & Tools',
    'tech_stack' => [
        ['title' => 'Frameworks', 'description' => 'Next.js, Vite, Create React App'],
        ['title' => 'State', 'description' => 'Redux Toolkit, Zustand, Context API, Recoil'],
        ['title' => 'Styling', 'description' => 'Tailwind CSS, Styled Components, Framer Motion'],
        ['title' => 'Testing', 'description' => 'Jest, React Testing Library, Cypress, Playwright']
    ],
    'faqs_title' => 'React.js Development FAQ',
    'faqs' => [
        ['title' => 'Why should I choose React over Angular or Vue?', 'description' => 'React offers more flexibility, a larger ecosystem, and is generally easier to scale for complex, high-performance UIs.'],
        ['title' => 'Is React good for SEO?', 'description' => 'Yes, when used with Next.js for server-side rendering, React applications are perfectly indexable by Google.'],
        ['title' => 'How long does it take to build a React application?', 'description' => 'An MVP can take 4-8 weeks, while complex enterprise platforms may take 3-6 months.']
    ],
    'testimonials_title' => 'Client Success with Devent & React',
    'testimonials' => [
        ['title' => 'Alex Rivera', 'subtitle' => 'Founder, NexaFlow', 'description' => 'The UI Devent built for us is so fast it feels like magic. Our conversion rate increased by 25% after the launch.'],
        ['title' => 'Emily Chen', 'subtitle' => 'Product Manager, ShopSwift', 'description' => 'Their mastery of Next.js helped us achieve a perfect Lighthouse score. Highly recommended for any serious startup.']
    ],
    'expert_consultation' => [
        'title' => 'Not Sure if Your Current React Setup is Optimal?',
        'description' => 'Get a comprehensive audit of your codebase, performance, and security by our React experts.',
        'button' => 'Request React Audit'
    ],
    'cta' => [
        'title' => 'Elevate Your User Experience Today',
        'subtitle' => 'Transform your vision into a stunning React-powered reality. Let\'s talk about your project.',
        'button' => 'Launch Your React Project'
    ],
    'seo' => [
        'meta_title' => 'Leading React.js Development Company | Devent',
        'meta_description' => 'Premium React.js development services for modern web applications. Expert Next.js, Redux, and React Native solutions.',
        'meta_keywords' => 'react development, frontend agency, next.js development, react native experts'
    ]
];

$react->content_data = $content_data;
$react->save();

echo "React content updated successfully!";
