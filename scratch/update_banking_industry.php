<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Industry;

$slug = 'banking-finance';
$industry = Industry::where('slug', $slug)->first();

$content_data = [
    'banner' => [
        'title' => 'Secure Banking & Fintech Solutions',
        'subtitle' => 'Drive digital transformation in financial services with enterprise-grade software.',
    ],
    'highlights' => [
        'Custom Fintech Applications',
        'Secure Payment Gateways',
        'Biometric & Two-Factor Authentication',
        'Blockchain & Smart Contracts',
    ],
    'features_title' => 'Security & Innovation',
    'features' => [
        ['title' => 'Bank-Grade Security', 'description' => 'End-to-end encryption and compliance with PCI-DSS.'],
        ['title' => 'Real-time Processing', 'description' => 'Instant transaction processing and updates.'],
        ['title' => 'AI Fraud Detection', 'description' => 'Identify and prevent suspicious activities automatically.'],
    ],
    'solutions_title' => 'Financial Technology Solutions',
    'solutions' => [
        ['title' => 'Mobile Banking Apps', 'description' => 'Intuitive apps for users to manage their finances.'],
        ['title' => 'Payment Gateways', 'description' => 'Custom integrations for seamless payments.'],
        ['title' => 'Investment Platforms', 'description' => 'Tools for trading and wealth management.'],
    ],
    'process_title' => 'Our Secure Process',
    'process' => [
        ['title' => 'Compliance Check', 'description' => 'Ensuring all regulations are met.'],
        ['title' => 'Secure Dev', 'description' => 'Writing clean, audited code.'],
        ['title' => 'Penetration Testing', 'description' => 'Rigorous security testing before launch.'],
    ],
    'frameworks_title' => 'Robust Technologies',
    'frameworks' => [
        ['title' => 'Java', 'description' => 'For enterprise-level security and stability.'],
        ['title' => 'Python', 'description' => 'For AI and fraud detection algorithms.'],
        ['title' => 'AWS Cloud', 'description' => 'For secure and compliant hosting.'],
    ],
];

if ($industry) {
    $industry->update([
        'content_data' => $content_data,
    ]);
    echo "Updated: " . $industry->title . "\n";
} else {
    echo "Not found: " . $slug . "\n";
}
