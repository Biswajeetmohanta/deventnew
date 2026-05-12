<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB;

$posts = DB::table('posts')->get();
echo "Total posts (DB): " . $posts->count() . "\n";
foreach ($posts as $post) {
    echo "ID: " . $post->id . " | Title: " . $post->title . " | Status: " . $post->status . " | Slug: " . $post->slug . "\n";
}
