<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Service;
use App\Models\Technology;
use Illuminate\Support\Str;

class InitialContentSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Web Development',
                'summary' => 'Custom websites and web applications built with the latest technologies.',
                'description' => '<p>We provide full-stack web development services, from simple landing pages to complex enterprise systems. Our team uses modern frameworks like Laravel and React to ensure performance and scalability.</p>',
            ],
            [
                'title' => 'Mobile App Development',
                'summary' => 'High-performance mobile apps for iOS and Android platforms.',
                'description' => '<p>We specialize in creating intuitive and powerful mobile applications using native and cross-platform technologies. Our apps are designed to provide a seamless user experience.</p>',
            ],
            [
                'title' => 'Digital Marketing',
                'summary' => 'Comprehensive digital strategies to grow your online presence.',
                'description' => '<p>Our digital marketing experts help you reach your target audience through SEO, social media marketing, and data-driven advertising campaigns.</p>',
            ],
            [
                'title' => 'Graphics Design',
                'summary' => 'Creative and professional design solutions for your brand identity.',
                'description' => '<p>We offer a wide range of graphic design services, including logo design, branding, and UI/UX design, to make your business stand out.</p>',
            ],
            [
                'title' => 'SEO Services',
                'summary' => 'Optimizing your website to rank higher on search engines.',
                'description' => '<p>Our SEO specialists use proven techniques to improve your search engine rankings and drive organic traffic to your website.</p>',
            ],
            [
                'title' => 'Domain & Hosting',
                'summary' => 'Reliable and secure hosting solutions for your business.',
                'description' => '<p>We provide secure and fast hosting services, along with domain registration, to ensure your website is always accessible to your customers.</p>',
            ],
        ];

        foreach ($services as $service) {
            Service::create([
                'title' => $service['title'],
                'slug' => Str::slug($service['title']),
                'summary' => $service['summary'],
                'description' => $service['description'],
                'is_active' => true,
            ]);
        }

        $techs = [
            ['name' => 'Laravel', 'category' => 'Backend'],
            ['name' => 'React', 'category' => 'Frontend'],
            ['name' => 'PHP', 'category' => 'Backend'],
            ['name' => 'Node.js', 'category' => 'Backend'],
            ['name' => 'MySQL', 'category' => 'Database'],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend'],
        ];

        foreach ($techs as $tech) {
            Technology::create($tech);
        }

        Setting::create(['key' => 'site_logo', 'value' => null, 'type' => 'image']);
        Setting::create(['key' => 'site_favicon', 'value' => null, 'type' => 'image']);
        Setting::create(['key' => 'site_name', 'value' => 'Devent Technology', 'type' => 'text']);
    }
}
