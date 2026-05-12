<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Setting;

$counters = [
    'counter_1_value' => '6+',
    'counter_1_label' => 'CORE SERVICES',
    'counter_1_icon' => 'fa-solid fa-layer-group',
    
    'counter_2_value' => '100+',
    'counter_2_label' => 'PROJECTS DELIVERED',
    'counter_2_icon' => 'fa-solid fa-check-double',
    
    'counter_3_value' => '360°',
    'counter_3_label' => 'DIGITAL SUPPORT',
    'counter_3_icon' => 'fa-solid fa-headset',
    
    'counter_4_value' => '24h',
    'counter_4_label' => 'RESPONSE GOAL',
    'counter_4_icon' => 'fa-solid fa-clock',
];

foreach ($counters as $key => $value) {
    Setting::updateOrCreate(
        ['key' => $key],
        ['value' => $value]
    );
}

echo "Home counters set successfully.\n";
