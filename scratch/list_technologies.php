<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Technology;

$technologies = Technology::all();
echo "Total technologies: " . $technologies->count() . "\n";
foreach ($technologies as $tech) {
    echo "ID: " . $tech->id . " | Name: " . $tech->name . " | Category: " . $tech->category . "\n";
}
