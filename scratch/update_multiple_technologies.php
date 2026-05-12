<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Technology;

$data = [
    'Laravel' => [
        'banner' => [
            'title' => 'Custom Laravel Development Services',
            'subtitle' => 'Build secure, scalable, and high-performance web applications with Laravel.',
        ],
        'breadcrumb_title' => 'Laravel Development',
        'highlights' => ['MVC Architecture', 'Eloquent ORM', 'Robust Security', 'Restful APIs'],
        'intro' => ['title' => 'Why Choose Laravel?', 'description' => 'Laravel is the go-to PHP framework for building modern web applications. It offers a clean and elegant syntax.'],
        'about' => ['title' => 'About Laravel', 'description' => 'Laravel is a web application framework with expressive, elegant syntax. We value joy in coding.'],
        'solutions_title' => 'Our Laravel Solutions',
        'solutions' => [
            ['title' => 'Custom Web Apps', 'description' => 'Tailored solutions for your business.'],
            ['title' => 'E-commerce Sites', 'description' => 'Scalable online stores.'],
            ['title' => 'API Development', 'description' => 'Secure and fast RESTful APIs.'],
        ],
        'features_title' => 'Features of Laravel',
        'features' => [
            ['title' => 'Blade Templating', 'description' => 'Powerful and lightweight templating engine.'],
            ['title' => 'Artisan CLI', 'description' => 'Command-line tool to automate tasks.'],
            ['title' => 'Migrations', 'description' => 'Version control for your database.'],
        ],
    ],
    'PHP' => [
        'banner' => [
            'title' => 'Expert PHP Development Services',
            'subtitle' => 'Leverage the power of the web\'s most popular server-side language.',
        ],
        'breadcrumb_title' => 'PHP Development',
        'highlights' => ['Fast Execution', 'Platform Independent', 'Database Flexibility', 'Large Community'],
        'intro' => ['title' => 'Why PHP?', 'description' => 'PHP powers a huge percentage of the web. It is fast, flexible, and has a massive ecosystem.'],
        'about' => ['title' => 'About PHP', 'description' => 'PHP is a popular general-purpose scripting language that is especially suited to web development.'],
        'solutions_title' => 'Our PHP Solutions',
        'solutions' => [
            ['title' => 'Dynamic Websites', 'description' => 'Content-rich and interactive sites.'],
            ['title' => 'Web Portals', 'description' => 'Secure portals for users.'],
            ['title' => 'CMS Customization', 'description' => 'Customizing WordPress, etc.'],
        ],
        'features_title' => 'Core PHP Features',
        'features' => [
            ['title' => 'Open Source', 'description' => 'Free to use and modify.'],
            ['title' => 'Fast Load Times', 'description' => 'Optimized for web delivery.'],
            ['title' => 'Secure', 'description' => 'Built-in tools to prevent attacks.'],
        ],
    ],
    'Node.js' => [
        'banner' => [
            'title' => 'Scalable Node.js Development',
            'subtitle' => 'Build fast and scalable network applications with JavaScript.',
        ],
        'breadcrumb_title' => 'Node.js Development',
        'highlights' => ['Event-Driven', 'Non-Blocking I/O', 'Fast Execution', 'NPM Ecosystem'],
        'intro' => ['title' => 'Why Node.js?', 'description' => 'Node.js is perfect for real-time applications and building fast, scalable APIs.'],
        'about' => ['title' => 'About Node.js', 'description' => 'Node.js is an open-source, cross-platform JavaScript runtime environment.'],
        'solutions_title' => 'Our Node.js Solutions',
        'solutions' => [
            ['title' => 'Real-Time Apps', 'description' => 'Chat apps, live updates, etc.'],
            ['title' => 'Microservices', 'description' => 'Building independent services.'],
            ['title' => 'REST APIs', 'description' => 'Fast and lightweight APIs.'],
        ],
        'features_title' => 'Node.js Advantages',
        'features' => [
            ['title' => 'Single Threaded', 'description' => 'Highly scalable for concurrent connections.'],
            ['title' => 'V8 Engine', 'description' => 'Powered by Google Chrome\'s fast engine.'],
            ['title' => 'JSON Support', 'description' => 'Seamless data handling.'],
        ],
    ],
    'React' => [
        'banner' => [
            'title' => 'Modern React.js Development',
            'subtitle' => 'Build interactive and dynamic user interfaces with React.',
        ],
        'breadcrumb_title' => 'React Development',
        'highlights' => ['Component-Based', 'Virtual DOM', 'Declarative UI', 'SEO Friendly'],
        'intro' => ['title' => 'Why React?', 'description' => 'React makes it painless to create interactive UIs. Design simple views for each state.'],
        'about' => ['title' => 'About React', 'description' => 'A JavaScript library for building user interfaces.'],
        'solutions_title' => 'Our React Solutions',
        'solutions' => [
            ['title' => 'Single Page Apps', 'description' => 'Fast and seamless user experience.'],
            ['title' => 'Custom UI Components', 'description' => 'Reusable and interactive elements.'],
            ['title' => 'Progressive Web Apps', 'description' => 'App-like experience in the browser.'],
        ],
        'features_title' => 'React Features',
        'features' => [
            ['title' => 'Virtual DOM', 'description' => 'Updates only what changes, making it fast.'],
            ['title' => 'JSX', 'description' => 'Write HTML-like code in JavaScript.'],
            ['title' => 'Hooks', 'description' => 'Use state without writing classes.'],
        ],
    ],
    'Tailwind CSS' => [
        'banner' => [
            'title' => 'Tailwind CSS UI Design',
            'subtitle' => 'Build modern and responsive designs rapidly with utility classes.',
        ],
        'breadcrumb_title' => 'Tailwind CSS Development',
        'highlights' => ['Utility-First', 'Highly Customizable', 'Fast Styling', 'Small Bundle Size'],
        'intro' => ['title' => 'Why Tailwind CSS?', 'description' => 'Tailwind lets you build custom designs without ever leaving your HTML.'],
        'about' => ['title' => 'About Tailwind CSS', 'description' => 'A utility-first CSS framework packed with classes.'],
        'solutions_title' => 'Our Tailwind Solutions',
        'solutions' => [
            ['title' => 'Custom UI Design', 'description' => 'Unique designs tailored to your brand.'],
            ['title' => 'Responsive Layouts', 'description' => 'Looks great on any device.'],
            ['title' => 'Theme Customization', 'description' => 'Dark mode and custom color palettes.'],
        ],
        'features_title' => 'Tailwind Features',
        'features' => [
            ['title' => 'Utility Classes', 'description' => 'Compose designs directly in HTML.'],
            ['title' => 'PurgeCSS', 'description' => 'Removes unused CSS for small file sizes.'],
            ['title' => 'Responsive Modifiers', 'description' => 'Easy mobile-first design.'],
        ],
    ],
    'MySQL' => [
        'banner' => [
            'title' => 'Reliable MySQL Database Solutions',
            'subtitle' => 'Store and manage your data securely with the world\'s most popular database.',
        ],
        'breadcrumb_title' => 'MySQL Development',
        'highlights' => ['Relational Data', 'High Security', 'Scalable', 'Acid Compliant'],
        'intro' => ['title' => 'Why MySQL?', 'description' => 'MySQL is the open-source relational database of choice for many web applications.'],
        'about' => ['title' => 'About MySQL', 'description' => 'MySQL is an open-source relational database management system.'],
        'solutions_title' => 'Our MySQL Solutions',
        'solutions' => [
            ['title' => 'Database Design', 'description' => 'Structured and optimized schemas.'],
            ['title' => 'Query Optimization', 'description' => 'Making your database faster.'],
            ['title' => 'Data Migration', 'description' => 'Securely moving your data.'],
        ],
        'features_title' => 'MySQL Features',
        'features' => [
            ['title' => 'Secure', 'description' => 'Robust data protection.'],
            ['title' => 'High Performance', 'description' => 'Fast query execution.'],
            ['title' => 'Reliable', 'description' => 'Proven track record for uptime.'],
        ],
    ],
];

foreach ($data as $name => $content) {
    $tech = Technology::where('name', $name)->first();
    if ($tech) {
        // Add default structures for missing sections to make it rich
        $content['why_choose'] = [
            'title' => 'Why Devent for ' . $name . '?',
            'description' => 'We have a proven track record of delivering successful projects using ' . $name . '.',
        ];
        $content['statistics'] = [
            ['title' => '100+', 'description' => 'Projects Delivered'],
            ['title' => '10+', 'description' => 'Years Experience'],
        ];
        $content['faqs'] = [
            ['title' => 'Is ' . $name . ' good for my project?', 'description' => 'It depends on your specific needs, but it is a top choice for many.'],
        ];
        
        $tech->update([
            'content_data' => $content,
        ]);
        echo "Updated: " . $tech->name . "\n";
    } else {
        echo "Not found: " . $name . "\n";
    }
}
