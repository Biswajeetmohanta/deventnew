<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $mailConfig = [
        'transport' => 'smtp',
        'host' => 'smtp.gmail.com',
        'port' => 465,
        'encryption' => 'ssl',
        'username' => 'perfectpicels@gmail.com',
        'password' => 'ewshzqepcqlzhwrk',
        'timeout' => null,
    ];
    config(['mail.default' => 'smtp', 'mail.mailers.smtp' => $mailConfig, 'mail.from.address' => 'perfectpicels@gmail.com', 'mail.from.name' => 'Devent Chatbot']);
    app('mail.manager')->purge('smtp');
    \Illuminate\Support\Facades\Mail::raw('Test email from script', function ($msg) {
        $msg->to('biswajeetmohanta123@gmail.com')->subject('Test Email');
    });
    echo "Email sent successfully!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
