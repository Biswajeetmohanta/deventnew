<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Service;

$services = Service::all();
echo "Total services: " . $services->count() . "\n";
foreach ($services as $srv) {
    echo "ID: " . $srv->id . " | Title: " . $srv->title . "\n";
}
