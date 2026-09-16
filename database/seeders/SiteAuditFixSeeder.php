<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Client;
use App\Models\Technology;

class SiteAuditFixSeeder extends Seeder
{
    /**
     * Run SAFE, non-destructive audit updates.
     * Does NOT touch, truncate, or wipe existing live data.
     */
    public function run(): void
    {
        // 1. Phone number & default stats in settings table
        Setting::updateOrCreate(
            ['key' => 'contact_phone'],
            ['value' => '+91 92746 88925']
        );

        if (!Setting::where('key', 'hero_stats_count')->exists()) {
            Setting::create(['key' => 'hero_stats_count', 'value' => '100+']);
        }
        if (!Setting::where('key', 'hero_stats_text')->exists()) {
            Setting::create(['key' => 'hero_stats_text', 'value' => 'Projects Delivered']);
        }

        // 2. Portfolio third-person copy update for the 3 specified clients
        $portfolioUpdates = [
            'Pushpraj Construction' => 'Devent Technology built and maintains the corporate website for Pushpraj Construction, a Gujarat-based civil and infrastructure company with 17+ years of experience delivering industrial projects, highways, bridges, and EPC contracts.',
            'mitoenrg' => 'Devent Technology designed and developed the website for MITO ENRG, a wellness and recovery brand offering SoftWave acoustic therapy, PEMF, red light, and cold exposure treatments to help clients optimize cellular energy and recovery.',
            'MITO ENRG' => 'Devent Technology designed and developed the website for MITO ENRG, a wellness and recovery brand offering SoftWave acoustic therapy, PEMF, red light, and cold exposure treatments to help clients optimize cellular energy and recovery.',
            'Serenity Bodywork Therapeutics' => 'Devent Technology built the booking and service platform for Serenity Bodywork Therapeutics, a licensed mobile massage-therapy service offering personalized, in-home wellness treatments.',
            'Serenity Bodywork' => 'Devent Technology built the booking and service platform for Serenity Bodywork Therapeutics, a licensed mobile massage-therapy service offering personalized, in-home wellness treatments.',
        ];

        foreach ($portfolioUpdates as $clientName => $description) {
            $client = Client::where('name', 'LIKE', '%' . $clientName . '%')->first();
            if ($client) {
                $client->description = $description;
                $client->save();
            }
        }

        // Also ensure sample records exist if none found (so local dev matches live)
        if (!Client::where('name', 'LIKE', '%Pushpraj%')->exists()) {
            Client::create([
                'name' => 'Pushpraj Construction',
                'logo' => 'clients/pushpraj.png',
                'description' => 'Devent Technology built and maintains the corporate website for Pushpraj Construction, a Gujarat-based civil and infrastructure company with 17+ years of experience delivering industrial projects, highways, bridges, and EPC contracts.',
                'website_url' => 'https://pushprajconstruction.com',
                'sort_order' => 5,
                'status' => true,
            ]);
        }

        if (!Client::where('name', 'LIKE', '%mitoenrg%')->exists() && !Client::where('name', 'LIKE', '%MITO%')->exists()) {
            Client::create([
                'name' => 'mitoenrg',
                'logo' => 'clients/mitoenrg.png',
                'description' => 'Devent Technology designed and developed the website for MITO ENRG, a wellness and recovery brand offering SoftWave acoustic therapy, PEMF, red light, and cold exposure treatments to help clients optimize cellular energy and recovery.',
                'website_url' => 'https://mitoenrg.com',
                'sort_order' => 6,
                'status' => true,
            ]);
        }

        if (!Client::where('name', 'LIKE', '%Serenity%')->exists()) {
            Client::create([
                'name' => 'Serenity Bodywork Therapeutics',
                'logo' => 'clients/serenity.png',
                'description' => 'Devent Technology built the booking and service platform for Serenity Bodywork Therapeutics, a licensed mobile massage-therapy service offering personalized, in-home wellness treatments.',
                'website_url' => 'https://serenitybodywork.com',
                'sort_order' => 7,
                'status' => true,
            ]);
        }

        // 3. Fix missing technology icons
        $techLogos = [
            'Solidity' => 'technologies/solidity.svg',
            'Ethereum' => 'technologies/ethereum.svg',
            'Next.js' => 'technologies/nextjs.svg',
            'Flutter' => 'technologies/flutter.svg',
            'Shopify' => 'technologies/shopify.svg',
            'WordPress' => 'technologies/wordpress.svg',
            'iOS' => 'technologies/ios.svg',
            'Android' => 'technologies/android.svg',
        ];

        foreach ($techLogos as $name => $logoPath) {
            $tech = Technology::where('name', $name)->first();
            if ($tech) {
                if (empty($tech->logo)) {
                    $tech->logo = $logoPath;
                    $tech->save();
                }
            }
        }
    }
}
