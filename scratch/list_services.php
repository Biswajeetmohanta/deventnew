<?php

use App\Models\Service;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$services = Service::all(['id', 'title', 'slug']);
foreach ($services as $service) {
    echo "ID: {$service->id} | Title: {$service->title} | Slug: {$service->slug}\n";
}
