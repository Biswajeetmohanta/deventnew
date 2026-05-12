<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Service;

$services = [
    'Custom Software Development' => ['image' => 'demo/tech_bg.png', 'icon' => 'fa-solid fa-globe'],
    'Mobile App Development' => ['image' => 'demo/code_bg.png', 'icon' => 'fa-solid fa-mobile-screen'],
    'Digital Marketing' => ['image' => 'demo/industry_bg.png', 'icon' => 'fa-solid fa-bullhorn'],
];

foreach ($services as $name => $upd) {
    $service = Service::where('title', $name)->first();
    if ($service) {
        $service->update([
            'image' => $upd['image'],
            'icon' => $upd['icon'],
        ]);
        echo "Updated Service: " . $name . "\n";
    } else {
        echo "Not found: " . $name . "\n";
    }
}
