<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Industry;

$industries = Industry::all();
echo "Total industries: " . $industries->count() . "\n";
foreach ($industries as $ind) {
    echo "ID: " . $ind->id . " | Title: " . $ind->title . " | Slug: " . $ind->slug . "\n";
}
