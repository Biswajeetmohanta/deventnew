<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Technology;

$slug = 'react-native'; // We don't have slug in technologies, we use ID or name.
// Let's find by name or create.
$tech = Technology::where('name', 'React Native')->first();

$content_data = [
    'banner' => [
        'title' => 'React Native App Development Company',
        'subtitle' => 'Build high-performance, cross-platform mobile apps with a single codebase.',
    ],
    'breadcrumb_title' => 'React Native Development',
    'highlights' => [
        'Cross-Platform Excellence',
        'Fast Refresh & Rapid Dev',
        'Native Performance',
        'Cost-Effective Solutions',
    ],
    'intro' => [
        'title' => 'Why Choose React Native for Your Next Project?',
        'description' => 'React Native allows you to build mobile apps using only JavaScript. It uses the same design as React, letting you compose a rich mobile UI from declarative components.',
    ],
    'about' => [
        'title' => 'About React Native Development',
        'description' => 'React Native combines the best parts of native development with React, a best-in-class JavaScript library for building user interfaces.',
    ],
    'solutions_title' => 'Our React Native Solutions',
    'solutions' => [
        ['title' => 'Custom App Development', 'description' => 'Tailored apps built from scratch.'],
        ['title' => 'App Migration', 'description' => 'Migrate your existing app to React Native.'],
        ['title' => 'UI/UX Design', 'description' => 'Beautiful and intuitive mobile interfaces.'],
    ],
    'features_title' => 'Benefits of React Native',
    'features' => [
        ['title' => 'Code Reusability', 'description' => 'Up to 90% code shared between iOS and Android.'],
        ['title' => 'Live Reloading', 'description' => 'See changes instantly without rebuilding.'],
        ['title' => 'Strong Community', 'description' => 'Backed by Facebook and a huge community.'],
    ],
    'process_title' => 'Our Development Process',
    'process' => [
        ['title' => 'Discovery', 'description' => 'We define requirements and scope.'],
        ['title' => 'Design', 'description' => 'Wireframes and high-fidelity designs.'],
        ['title' => 'Development', 'description' => 'Sprints and regular builds.'],
        ['title' => 'QA & Testing', 'description' => 'Rigorous testing on real devices.'],
    ],
    'why_choose' => [
        'title' => 'Why Devent for React Native?',
        'description' => 'We have a team of expert React Native developers who have delivered successful apps across various industries.',
    ],
    'industries_served' => [
        ['title' => 'E-commerce', 'description' => 'fa-solid fa-cart-shopping'],
        ['title' => 'Healthcare', 'description' => 'fa-solid fa-heart-pulse'],
        ['title' => 'Education', 'description' => 'fa-solid fa-graduation-cap'],
    ],
    'engagement_models' => [
        ['title' => 'Fixed Price', 'description' => 'Best for projects with clear scope.'],
        ['title' => 'Time & Material', 'description' => 'Flexible for evolving projects.'],
        ['title' => 'Dedicated Team', 'description' => 'An extension of your in-house team.'],
    ],
    'hiring' => [
        'title' => 'Hire Dedicated React Native Developers',
        'description' => 'Scale your team quickly with our experienced developers.',
    ],
    'statistics' => [
        ['title' => '50+', 'description' => 'Apps Delivered'],
        ['title' => '98%', 'description' => 'Client Satisfaction'],
        ['title' => '5M+', 'description' => 'App Downloads'],
    ],
    'tech_stack' => [
        ['title' => 'Redux', 'description' => 'State Management'],
        ['title' => 'Axios', 'description' => 'API Communication'],
        ['title' => 'Firebase', 'description' => 'Push Notifications & Auth'],
    ],
    'faqs' => [
        ['title' => 'Is React Native good for large apps?', 'description' => 'Yes, many large apps like Facebook and Instagram use it.'],
        ['title' => 'Can we use native code?', 'description' => 'Yes, React Native allows bridging to native code when needed.'],
    ],
    'testimonials' => [
        ['title' => 'Alice Smith', 'subtitle' => 'CTO, TechStart', 'description' => 'Devent delivered our app on time and it performs beautifully. Highly recommended!'],
    ],
    'cta' => [
        'title' => 'Ready to Build Your Cross-Platform App?',
        'subtitle' => 'Get in touch with our experts today.',
        'button' => 'Get a Free Quote',
    ],
    'seo' => [
        'meta_title' => 'React Native App Development | Devent',
        'meta_description' => 'Top-rated React Native app development services by Devent Technology.',
        'meta_keywords' => 'react native, app development, cross-platform apps',
    ],
];

if ($tech) {
    $tech->update([
        'content_data' => $content_data,
        'description' => 'We leverage the power of React Native to build robust, scalable, and high-performance solutions tailored to your business needs.',
    ]);
    echo "Updated existing technology: " . $tech->name . "\n";
} else {
    $tech = Technology::create([
        'name' => 'React Native',
        'category' => 'Mobile',
        'is_active' => true,
        'description' => 'We leverage the power of React Native to build robust, scalable, and high-performance solutions tailored to your business needs.',
        'content_data' => $content_data,
    ]);
    echo "Created new technology: " . $tech->name . "\n";
}
