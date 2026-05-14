<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatAutoReply;
use App\Models\Setting;

class ChatbotDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Auto Replies
        $autoReplies = [
            ['keyword' => 'pricing', 'reply' => 'Our pricing depends on the specific requirements of your project. We offer competitive rates for high-quality development. Would you like to schedule a free consultation?'],
            ['keyword' => 'services', 'reply' => 'Devent Technology specializes in Web Development, Mobile App Development (iOS & Android), UI/UX Design, and Custom Software Solutions.'],
            ['keyword' => 'hello', 'reply' => 'Hello! Welcome to Devent Technology. How can we assist you today?'],
            ['keyword' => 'hi', 'reply' => 'Hi there! How can we help you today?'],
            ['keyword' => 'contact', 'reply' => 'You can reach us via email at contact@devent.com or call us at +91-XXXXXXXXXX. You can also use the contact form on our website.'],
            ['keyword' => 'career', 'reply' => 'We are always looking for talented individuals! Please check our Careers page for current openings or send your CV to careers@devent.com.'],
            ['keyword' => 'address', 'reply' => 'Our office is located in Bhubaneswar, Odisha, India. We work with clients all over the world!'],
        ];

        foreach ($autoReplies as $item) {
            ChatAutoReply::updateOrCreate(
                ['keyword' => $item['keyword']],
                ['reply' => $item['reply'], 'is_active' => true]
            );
        }

        // 2. Seed Settings
        $settings = [
            'chatbot_notification_email' => 'jyoti@deventtechnology.com',
            'mail_host' => 'smtp.gmail.com',
            'mail_port' => '465',
            'mail_encryption' => 'ssl',
            'mail_username' => 'perfectpicels@gmail.com',
            'mail_password' => 'ewshzqepcqlzhwrk',
            'mail_from_address' => 'perfectpicels@gmail.com',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
