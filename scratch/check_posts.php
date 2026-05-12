<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Post;

$posts = Post::all();
echo "Total posts: " . $posts->count() . "\n";
foreach ($posts as $post) {
    echo "ID: " . $post->id . " | Title: " . $post->title . " | Status: " . $post->status . "\n";
}
