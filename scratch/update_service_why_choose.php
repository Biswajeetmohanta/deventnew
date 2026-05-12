<?php

use App\Models\Service;

// Ensure we are running in Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$service = Service::where('slug', 'software-development-consulting')->first();

if ($service) {
    $cd = $service->content_data;
    
    $cd['why_choose'] = [
        'title' => 'Why Choose Moon Technolabs As Your Software Consulting Partner?',
        'description' => 'By choosing Moon Technolabs as your software consulting partner, you invest in in-depth expertise, diverse skill sets, advanced knowledge, and innovative software solutions. Our team was founded on a commitment to quality and the drive to deliver success. Using efficient workflows, effective timeline-tracking tools, and seamless integration strategies, we deliver future-proof solutions with long-term support.',
    ];
    
    $cd['why_choose_points'] = [
        'Caters to diverse industries and business types',
        'Adept with DevOps, CI/CD, and automation',
        'Reliable and transparent project management systems',
        'Agile methodology for accelerated development',
    ];
    
    $service->content_data = $cd;
    $service->save();
    
    echo "Service updated with Why Choose Us content.\n";
} else {
    echo "Service not found.\n";
}
