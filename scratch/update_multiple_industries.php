<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Industry;
use Illuminate\Support\Str;

$data = [
    'business' => [
        'banner' => [
            'title' => 'Enterprise Business Software Solutions',
            'subtitle' => 'Streamline operations and drive growth with custom business applications.',
        ],
        'highlights' => [
            'Custom ERP & CRM Systems',
            'Workflow Automation',
            'Business Intelligence & Analytics',
            'Legacy System Modernization',
        ],
        'features_title' => 'Core Business Solutions',
        'features' => [
            ['title' => 'Process Automation', 'description' => 'Reduce manual tasks and human error.'],
            ['title' => 'Data Analytics', 'description' => 'Gain actionable insights from your data.'],
            ['title' => 'Cloud Integration', 'description' => 'Access your business tools from anywhere.'],
        ],
        'solutions_title' => 'Tailored Solutions for Your Business',
        'solutions' => [
            ['title' => 'Custom CRM', 'description' => 'Manage customer relationships effectively.'],
            ['title' => 'ERP Systems', 'description' => 'Integrate all core business processes.'],
            ['title' => 'HR Management', 'description' => 'Streamline employee onboarding and management.'],
        ],
        'process_title' => 'How We Build Your Solution',
        'process' => [
            ['title' => 'Consultation', 'description' => 'We understand your business goals.'],
            ['title' => 'Architecture', 'description' => 'Designing a scalable system.'],
            ['title' => 'Development', 'description' => 'Agile development with regular updates.'],
        ],
        'frameworks_title' => 'Technologies We Use',
        'frameworks' => [
            ['title' => 'Laravel', 'description' => 'For robust backend systems.'],
            ['title' => 'React', 'description' => 'For dynamic user interfaces.'],
            ['title' => 'AWS', 'description' => 'For secure cloud hosting.'],
        ],
    ],
    'ecommerce' => [
        'banner' => [
            'title' => 'Cutting-Edge E-commerce Development',
            'subtitle' => 'Build a high-converting online store with the latest tech.',
        ],
        'highlights' => [
            'Multi-Vendor Marketplaces',
            'Headless Commerce Solutions',
            'Mobile Commerce Apps',
            'AI-Powered Personalization',
        ],
        'features_title' => 'E-commerce Excellence',
        'features' => [
            ['title' => 'Mobile First', 'description' => 'Optimized for shopping on any device.'],
            ['title' => 'Speed Optimized', 'description' => 'Fast loading times to prevent cart abandonment.'],
            ['title' => 'SEO Ready', 'description' => 'Built-in tools to help you rank higher.'],
        ],
        'solutions_title' => 'Our E-commerce Expertise',
        'solutions' => [
            ['title' => 'B2C Stores', 'description' => 'Beautiful storefronts that sell.'],
            ['title' => 'B2B Platforms', 'description' => 'Complex wholesale ordering systems.'],
            ['title' => 'Marketplaces', 'description' => 'Connect multiple vendors and buyers.'],
        ],
        'process_title' => 'E-commerce Launch Process',
        'process' => [
            ['title' => 'Strategy', 'description' => 'Defining target audience and goals.'],
            ['title' => 'Design', 'description' => 'Creating a high-converting UI.'],
            ['title' => 'Build', 'description' => 'Developing the store and integrations.'],
        ],
        'frameworks_title' => 'Top Platforms We Support',
        'frameworks' => [
            ['title' => 'WooCommerce', 'description' => 'Flexible WordPress-based commerce.'],
            ['title' => 'Shopify Plus', 'description' => 'For high-volume merchants.'],
            ['title' => 'Custom Code', 'description' => 'For unique business models.'],
        ],
    ],
    'education' => [
        'banner' => [
            'title' => 'Innovative E-Learning Solutions',
            'subtitle' => 'Empower students and educators with custom learning platforms.',
        ],
        'highlights' => [
            'Learning Management Systems (LMS)',
            'Virtual Classrooms',
            'Student Information Systems',
            'Interactive Courseware',
        ],
        'features_title' => 'Smart Learning Features',
        'features' => [
            ['title' => 'Live Streaming', 'description' => 'Conduct real-time online classes.'],
            ['title' => 'Progress Tracking', 'description' => 'Monitor student performance and grades.'],
            ['title' => 'Gamification', 'description' => 'Increase engagement with badges and points.'],
        ],
        'solutions_title' => 'Education Tech Solutions',
        'solutions' => [
            ['title' => 'School LMS', 'description' => 'Manage curriculum and assignments.'],
            ['title' => 'Corporate Training', 'description' => 'Upskill your workforce online.'],
            ['title' => 'Tutoring Platforms', 'description' => 'Connect tutors and students.'],
        ],
        'process_title' => 'Building Your E-Learning Site',
        'process' => [
            ['title' => 'Needs Analysis', 'description' => 'Understanding the learning objectives.'],
            ['title' => 'Platform Design', 'description' => 'Designing an accessible interface.'],
            ['title' => 'Integration', 'description' => 'Adding video and assessment tools.'],
        ],
        'frameworks_title' => 'EdTech Tools',
        'frameworks' => [
            ['title' => 'Moodle', 'description' => 'Open-source LMS customization.'],
            ['title' => 'Node.js', 'description' => 'For real-time interactions.'],
            ['title' => 'Vue.js', 'description' => 'For smooth interactive components.'],
        ],
    ],
    'food-restaurant' => [
        'banner' => [
            'title' => 'Restaurant & Food Delivery Software',
            'subtitle' => 'Modern solutions for the food and hospitality industry.',
        ],
        'highlights' => [
            'Online Food Ordering Systems',
            'Custom Delivery Apps',
            'Digital Menu Management',
            'Table Reservation Systems',
        ],
        'features_title' => 'Restaurant Tech Features',
        'features' => [
            ['title' => 'Real-time Tracking', 'description' => 'Customers can track their orders live.'],
            ['title' => 'Kitchen Display', 'description' => 'Streamline communication with the kitchen.'],
            ['title' => 'Loyalty Programs', 'description' => 'Reward regular customers to increase retention.'],
        ],
        'solutions_title' => 'Solutions We Offer',
        'solutions' => [
            ['title' => 'Delivery Apps', 'description' => 'UberEats-style custom applications.'],
            ['title' => 'Ordering Portals', 'description' => 'Commission-free web ordering.'],
            ['title' => 'POS Integration', 'description' => 'Sync online orders with in-store systems.'],
        ],
        'process_title' => 'Our Approach',
        'process' => [
            ['title' => 'Discovery', 'description' => 'Mapping the customer journey.'],
            ['title' => 'Development', 'description' => 'Building secure and fast apps.'],
            ['title' => 'Testing', 'description' => 'Rigorous testing under load.'],
        ],
        'frameworks_title' => 'Preferred Tech Stack',
        'frameworks' => [
            ['title' => 'Flutter', 'description' => 'For cross-platform mobile apps.'],
            ['title' => 'Firebase', 'description' => 'For real-time order tracking.'],
            ['title' => 'PHP/Laravel', 'description' => 'For powerful admin panels.'],
        ],
    ],
];

foreach ($data as $slug => $content) {
    $industry = Industry::where('slug', $slug)->first();
    if ($industry) {
        $industry->update([
            'content_data' => $content,
        ]);
        echo "Updated: " . $industry->title . "\n";
    } else {
        echo "Not found: " . $slug . "\n";
    }
}
