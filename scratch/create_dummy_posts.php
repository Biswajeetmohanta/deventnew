<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Post;
use Illuminate\Support\Str;

$posts = [
    [
        'title' => 'Wearable App Development Explained: Features, Cost & Process',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'status' => 'published',
    ],
    [
        'title' => 'How IoT in Retail Improves Customer Experience and Operations?',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'status' => 'published',
    ],
    [
        'title' => 'An Ultimate Guide to Retail Software Development',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'status' => 'published',
    ],
];

foreach ($posts as $p) {
    Post::create([
        'title' => $p['title'],
        'slug' => Str::slug($p['title']),
        'content' => $p['content'],
        'status' => $p['status'],
    ]);
}

echo "Created 3 dummy posts.\n";
