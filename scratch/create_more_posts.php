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
    // Check if exists
    if (!Post::where('slug', Str::slug($p['title']))->exists()) {
        Post::create([
            'title' => $p['title'],
            'slug' => Str::slug($p['title']),
            'content' => $p['content'],
            'status' => $p['status'],
        ]);
        echo "Created: " . $p['title'] . "\n";
    } else {
        echo "Skipped: " . $p['title'] . "\n";
    }
}
