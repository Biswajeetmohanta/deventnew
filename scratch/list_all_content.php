<?php

use App\Models\Industry;
use App\Models\Technology;
use App\Models\TeamRole;
use App\Models\Testimonial;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== INDUSTRIES ===\n";
foreach (Industry::all(['id', 'title', 'slug']) as $i) {
    echo "ID: {$i->id} | {$i->title} | {$i->slug}\n";
}

echo "\n=== TECHNOLOGIES ===\n";
foreach (Technology::all(['id', 'name', 'category']) as $t) {
    echo "ID: {$t->id} | {$t->name} | {$t->category}\n";
}

echo "\n=== TEAM ROLES ===\n";
foreach (TeamRole::all(['id', 'title', 'slug']) as $tr) {
    echo "ID: {$tr->id} | {$tr->title} | {$tr->slug}\n";
}

echo "\n=== TESTIMONIALS ===\n";
foreach (Testimonial::all(['id', 'client_name', 'client_position', 'rating']) as $te) {
    echo "ID: {$te->id} | {$te->client_name} | {$te->client_position} | Rating: {$te->rating}\n";
}
