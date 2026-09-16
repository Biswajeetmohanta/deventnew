<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;
use App\Models\Industry;
use Illuminate\Support\Str;

class SeoMetadataSeeder extends Seeder
{
    /**
     * Run the database seeds for SEO Meta Titles, Descriptions, and Keywords.
     */
    public function run(): void
    {
        // 1. Technologies SEO Metadata
        $technologies = [
            'Solidity' => [
                'category' => 'Blockchain',
                'title' => 'Solidity Development Company | Devent Technology',
                'description' => "Build secure smart contracts and blockchain applications with Devent Technology's Solidity developers, integrations and scalable Web3 engineering.",
                'keywords' => 'solidity development, smart contract development, solidity developers, web3 development, dApp development, blockchain engineering, ethereum smart contracts, solidity audit',
            ],
            'Ethereum' => [
                'category' => 'Blockchain',
                'title' => 'Ethereum Development Company | Devent Technology',
                'description' => "Build secure Ethereum applications, smart contracts and Web3 platforms with Devent Technology's blockchain engineers and integration specialists.",
                'keywords' => 'ethereum development, ethereum app development, smart contract developers, evm development, dApp developers, web3 platform development, ethereum blockchain solutions',
            ],
            'Next.js' => [
                'category' => 'Frontend',
                'title' => 'Next.js Development Company | Devent Technology',
                'description' => "Launch fast, scalable and SEO-ready web applications with Devent Technology's Next.js developers, modern architecture and performance expertise.",
                'keywords' => 'nextjs development, next.js developers, react framework, server side rendering, ssr web development, full stack nextjs, high performance web apps',
            ],
            'Shopify' => [
                'category' => 'Web',
                'title' => 'Shopify Development Company | Devent Technology',
                'description' => 'Grow your online store with custom Shopify development, theme engineering, app integrations, migration and performance optimization from Devent Technology.',
                'keywords' => 'shopify development, custom shopify theme, shopify app integration, ecommerce development, shopify store design, shopify migration, woocommerce to shopify',
            ],
            'WordPress' => [
                'category' => 'Web',
                'title' => 'WordPress Development Company | Devent Technology',
                'description' => 'Build secure, responsive WordPress websites with custom themes, plugins, WooCommerce, migration and performance optimization from Devent Technology.',
                'keywords' => 'wordpress development, custom wordpress themes, wordpress plugin development, woocommerce development, responsive wordpress websites, cms development',
            ],
            'iOS' => [
                'category' => 'Mobile',
                'title' => 'iOS App Development Company | Devent Technology',
                'description' => "Create secure, scalable iPhone and iPad applications with Devent Technology's iOS developers, product design, integrations and App Store delivery.",
                'keywords' => 'ios app development, iphone app development, swift developers, ipad application development, native ios apps, apple app store submission',
            ],
            'Android' => [
                'category' => 'Mobile',
                'title' => 'Android App Development Company | Devent Technology',
                'description' => "Build secure, high-performance Android applications with Devent Technology's Kotlin developers, product design, integrations and Play Store delivery.",
                'keywords' => 'android app development, kotlin developers, custom android apps, native android development, google play store apps, mobile app solutions',
            ],
            'Flutter' => [
                'category' => 'Mobile',
                'title' => 'Flutter App Development Company | Devent Technology',
                'description' => "Launch scalable cross-platform mobile apps with Devent Technology's Flutter developers, unified design, backend integrations and reliable delivery.",
                'keywords' => 'flutter app development, cross platform app development, flutter developers, dart development, hybrid mobile apps, multi platform mobile apps',
            ],
            'Python' => [
                'category' => 'AI',
                'title' => 'Python Development Company | Devent Technology',
                'description' => "Build scalable web, data and AI solutions with Devent Technology's Python developers, API engineering, automation and cloud-ready architecture.",
                'keywords' => 'python development company, python developers, django development, fastapi backend, ai python solutions, machine learning, data engineering, python api development',
            ],
            'React Native' => [
                'category' => 'Mobile',
                'title' => 'React Native App Development | Devent Technology',
                'description' => "Create high-performance cross-platform mobile apps with Devent Technology's React Native developers, native integrations and scalable architecture.",
                'keywords' => 'react native development, react native developers, cross platform mobile apps, hybrid app development, mobile app agency, ios and android app',
            ],
            'Laravel' => [
                'category' => 'Web',
                'title' => 'Laravel Development Company | Devent Technology',
                'description' => "Build secure, scalable web applications and APIs with Devent Technology's Laravel developers, clean architecture and enterprise integrations.",
                'keywords' => 'laravel development company, laravel developers, php laravel framework, api development, enterprise web application, custom laravel portal',
            ],
            'React' => [
                'category' => 'Web',
                'title' => 'React Development Company | Devent Technology',
                'description' => "Create fast, accessible and scalable web interfaces with Devent Technology's React developers, component engineering and API integrations.",
                'keywords' => 'react development company, react js developers, react frontend development, single page application, component architecture, modern ui development',
            ],
            'PHP' => [
                'category' => 'Web',
                'title' => 'PHP Development Company | Devent Technology',
                'description' => "Build secure, maintainable web applications with Devent Technology's PHP developers, modern frameworks, API integrations and performance tuning.",
                'keywords' => 'php development company, custom php development, core php, backend development, php web applications, php maintenance and migration',
            ],
            'Node.js' => [
                'category' => 'Web',
                'title' => 'Node.js Development Company | Devent Technology',
                'description' => "Build scalable APIs, real-time platforms and backend systems with Devent Technology's Node.js developers and cloud-ready architecture.",
                'keywords' => 'nodejs development company, node js developers, express js, backend api development, real-time applications, microservices architecture',
            ],
            'MySQL' => [
                'category' => 'Web',
                'title' => 'MySQL Development Services | Devent Technology',
                'description' => 'Improve application data performance with MySQL database design, optimization, migration, security and integration services from Devent Technology.',
                'keywords' => 'mysql development services, database design, mysql query optimization, database migration, database administration, relational database solutions',
            ],
            'Tailwind CSS' => [
                'category' => 'Web',
                'title' => 'Tailwind CSS Development | Devent Technology',
                'description' => "Create responsive, accessible and consistent interfaces with Devent Technology's Tailwind CSS development and reusable design-system expertise.",
                'keywords' => 'tailwind css development, responsive ui design, custom tailwind components, front end design system, utility first css, modern web interfaces',
            ],
        ];

        foreach ($technologies as $name => $data) {
            $slug = Str::slug($name);
            if ($name === 'Node.js') {
                $slug = 'nodejs';
            } elseif ($name === 'Next.js') {
                $slug = 'nextjs';
            }

            // Find existing technology by name or slug
            $tech = Technology::where('name', $name)
                ->orWhere('slug', $slug)
                ->first();

            if (!$tech) {
                $tech = new Technology();
                $tech->name = $name;
                $tech->slug = $slug;
            }

            $tech->category = $data['category'];
            $tech->is_active = true;
            $tech->description = $data['description'];

            $contentData = $tech->content_data ?? [];
            $contentData['seo'] = [
                'meta_title' => $data['title'],
                'meta_description' => $data['description'],
                'meta_keywords' => $data['keywords'],
                'canonical_url' => 'https://deventtechnology.com/technology/' . $slug,
            ];

            // Cleanup for Android if any "Process Image Prompt" exists
            if (strtolower($name) === 'android' && isset($contentData['process']) && is_array($contentData['process'])) {
                $contentData['process'] = array_values(array_filter($contentData['process'], function ($step) {
                    $stepTitle = is_array($step) ? ($step['title'] ?? '') : '';
                    $stepDesc = is_array($step) ? ($step['description'] ?? '') : '';
                    return !str_contains(strtolower($stepTitle), 'process image prompt') &&
                           !str_contains(strtolower($stepDesc), 'process image prompt');
                }));
            }

            $tech->content_data = $contentData;
            $tech->save();
        }

        // 2. Industries SEO Metadata
        $industries = [
            'Fintech & Blockchain' => [
                'slug' => 'fintech-blockchain',
                'title' => 'Fintech & Blockchain Software | Devent Technology',
                'description' => 'Build secure fintech and blockchain platforms with Devent Technology, including digital wallets, payments, smart contracts and compliance-ready systems.',
                'keywords' => 'fintech software development, blockchain development, digital wallet app, payment gateway integration, smart contracts, crypto exchange development, defi solutions',
            ],
            'Healthcare & Lifesciences' => [
                'slug' => 'healthcare-lifesciences',
                'title' => 'Healthcare & Lifesciences Software | Devent Technology',
                'description' => 'Build secure healthcare and lifesciences software with patient portals, clinical workflows, data integrations and scalable platforms from Devent Technology.',
                'keywords' => 'healthcare software development, ehr emr integration, telemedicine app development, patient portal, hipaa compliant software, clinical workflow systems',
            ],
            'Industrial & Manufacturing' => [
                'slug' => 'industrial-manufacturing',
                'title' => 'Manufacturing Software Solutions | Devent Technology',
                'description' => "Modernize manufacturing with Devent Technology's production planning, IoT monitoring, quality, maintenance and supply-chain software solutions.",
                'keywords' => 'manufacturing software solutions, production planning system, iot industrial monitoring, supply chain management, plant maintenance software, smart factory solutions',
            ],
            'E-Commerce & Retail' => [
                'slug' => 'ecommerce-retail',
                'title' => 'Retail & E-Commerce Software | Devent Technology',
                'description' => 'Build scalable retail and e-commerce platforms with Devent Technology, including storefronts, inventory, payments, analytics and omnichannel integrations.',
                'keywords' => 'ecommerce software development, online retail solutions, pos integration, headless commerce, multi vendor marketplace, omnichannel retail software',
            ],
            'Travel and Hospitality' => [
                'slug' => 'travel-hospitality',
                'title' => 'Travel & Hospitality Software | Devent Technology',
                'description' => "Create booking, hotel management, guest engagement and travel operations platforms with Devent Technology's scalable software development services.",
                'keywords' => 'travel software development, hotel booking engine, hospitality management software, flight booking platform, tour operator software, guest engagement app',
            ],
            'Digital & Marketing Agencies' => [
                'slug' => 'digital-marketing-agencies',
                'title' => 'Marketing Agency Software | Devent Technology',
                'description' => "Scale agency operations with Devent Technology's campaign management, client portals, marketing automation, analytics and CRM integrations.",
                'keywords' => 'marketing agency software, campaign management platform, client portal development, marketing automation software, crm integrations, analytics dashboard',
            ],
            'Logistics & Transportation' => [
                'slug' => 'logistics-transportation',
                'title' => 'Logistics Software Development | Devent Technology',
                'description' => "Improve logistics with Devent Technology's fleet, warehouse, shipment tracking, route optimization and transportation management software.",
                'keywords' => 'logistics software development, fleet management system, warehouse management software, route optimization, shipment tracking app, freight management platform',
            ],
            'Healthcare' => [
                'slug' => 'healthcare',
                'title' => 'Healthcare Software Development | Devent Technology',
                'description' => 'Build secure healthcare software with Devent Technology, including EHR integrations, telemedicine, patient portals and hospital management systems.',
                'keywords' => 'healthcare application development, medical clinic software, hospital management system, doctor appointment app, pharmacy management, healthcare web solutions',
            ],
            'Retail & E-commerce' => [
                'slug' => 'retail-e-commerce',
                'title' => 'Retail & E-Commerce Development | Devent Technology',
                'description' => 'Create scalable retail and e-commerce solutions with online stores, POS, inventory, payments, mobile commerce and analytics from Devent Technology.',
                'keywords' => 'retail software development, retail store management, inventory management software, mobile ecommerce app, retail pos solutions, shopping cart development',
            ],
            'Food & Restaurant' => [
                'slug' => 'food-restaurant',
                'title' => 'Restaurant Software Development | Devent Technology',
                'description' => "Digitize restaurant operations with Devent Technology's ordering, delivery, POS, reservations, kitchen workflows and customer engagement software.",
                'keywords' => 'restaurant software development, online food ordering system, restaurant pos system, food delivery app, kitchen display system, table reservation software',
            ],
            'Education & E-learning' => [
                'slug' => 'education-e-learning',
                'title' => 'EdTech & E-Learning Software | Devent Technology',
                'description' => 'Build engaging EdTech and e-learning platforms with LMS, virtual classrooms, assessments, mobile learning and analytics from Devent Technology.',
                'keywords' => 'edtech software development, elearning platform development, lms learning management system, virtual classroom software, student portal, online exam portal',
            ],
            'Automotive' => [
                'slug' => 'automotive',
                'title' => 'Automotive Software Development | Devent Technology',
                'description' => "Build connected vehicle, fleet, dealership, telematics and EV management software with Devent Technology's automotive engineering expertise.",
                'keywords' => 'automotive software development, connected vehicle solutions, dealership management system, telematics software, ev charging station app, fleet tracking software',
            ],
            'Real Estate' => [
                'slug' => 'real-estate',
                'title' => 'Real Estate Software Development | Devent Technology',
                'description' => "Create property management, marketplace, CRM, tenant and virtual-tour platforms with Devent Technology's PropTech development services.",
                'keywords' => 'real estate software development, proptech solutions, property management software, real estate marketplace, virtual tour platform, tenant management portal',
            ],
            'Banking & Finance' => [
                'slug' => 'banking-finance',
                'title' => 'Banking & Finance Software | Devent Technology',
                'description' => 'Build secure banking and finance software with Devent Technology, including digital platforms, payments, investment tools and data integrations.',
                'keywords' => 'banking software development, financial software solutions, core banking integration, investment management app, loan management system, secure fintech software',
            ],
        ];

        foreach ($industries as $name => $data) {
            $slug = $data['slug'] ?? Str::slug($name);

            // Find existing industry by title or slug
            $industry = Industry::where('title', $name)
                ->orWhere('slug', $slug)
                ->first();

            if (!$industry) {
                $industry = new Industry();
                $industry->title = $name;
                $industry->slug = $slug;
            }

            $industry->description = $data['description'];

            $contentData = $industry->content_data ?? [];
            $contentData['seo'] = [
                'meta_title' => $data['title'],
                'meta_description' => $data['description'],
                'meta_keywords' => $data['keywords'],
                'canonical_url' => 'https://deventtechnology.com/industry/' . $slug,
            ];

            $industry->content_data = $contentData;
            $industry->save();
        }

        $this->command->info('SEO Meta Titles, Descriptions, Keywords, and Canonical URLs updated successfully for Technologies and Industries.');
    }
}
