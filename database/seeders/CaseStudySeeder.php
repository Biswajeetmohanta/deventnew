<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseStudy;
use App\Models\Industry;
use App\Models\Technology;
use Illuminate\Support\Str;

class CaseStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create or Find Industries
        $industryFintech = Industry::firstOrCreate(
            ['slug' => 'fintech-blockchain'],
            [
                'title' => 'Fintech & Blockchain',
                'description' => 'Decentralized platforms, digital wallets, smart contracts, and secure banking applications.',
                'icon' => 'fa-solid fa-bitcoin-sign',
            ]
        );

        $industryHealthcare = Industry::firstOrCreate(
            ['slug' => 'healthcare-lifesciences'],
            [
                'title' => 'Healthcare & Lifesciences',
                'description' => 'HIPAA-compliant CRM portals, diagnostics booking systems, and electronic health record integrations.',
                'icon' => 'fa-solid fa-house-medical',
            ]
        );

        $industryManufacturing = Industry::firstOrCreate(
            ['slug' => 'industrial-manufacturing'],
            [
                'title' => 'Industrial & Manufacturing',
                'description' => 'Resource planners, supply chain schedulers, and IoT maintenance log dashboards.',
                'icon' => 'fa-solid fa-industry',
            ]
        );

        $industryEcommerce = Industry::firstOrCreate(
            ['slug' => 'ecommerce-retail'],
            [
                'title' => 'E-Commerce & Retail',
                'description' => 'Headless B2B wholesale platforms, catalog searches, and multi-currency checkouts.',
                'icon' => 'fa-solid fa-cart-shopping',
            ]
        );

        // 2. Create or Find Technologies
        $techSolidity = Technology::firstOrCreate(['slug' => 'solidity'], ['name' => 'Solidity', 'category' => 'Blockchain', 'is_active' => true]);
        $techEthereum = Technology::firstOrCreate(['slug' => 'ethereum'], ['name' => 'Ethereum', 'category' => 'Blockchain', 'is_active' => true]);
        $techLaravel = Technology::firstOrCreate(['slug' => 'laravel'], ['name' => 'Laravel', 'category' => 'Backend', 'is_active' => true]);
        $techReact = Technology::firstOrCreate(['slug' => 'react'], ['name' => 'React', 'category' => 'Frontend', 'is_active' => true]);
        $techMySQL = Technology::firstOrCreate(['slug' => 'mysql'], ['name' => 'MySQL', 'category' => 'Database', 'is_active' => true]);
        $techPython = Technology::firstOrCreate(['slug' => 'python'], ['name' => 'Python', 'category' => 'Backend', 'is_active' => true]);
        $techNextjs = Technology::firstOrCreate(['slug' => 'nextjs'], ['name' => 'Next.js', 'category' => 'Frontend', 'is_active' => true]);
        $techTailwind = Technology::firstOrCreate(['slug' => 'tailwind-css'], ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'is_active' => true]);

        // 3. Clear existing case studies to avoid duplicates if re-run
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        CaseStudy::truncate();
        \DB::table('case_study_technology')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // -------------------------------------------------------------
        // Case Study 1: Blockchain
        // -------------------------------------------------------------
        $blockchainStudy = CaseStudy::create([
            'title' => 'Decentralized Smart Contract Escrow & Settlement Protocol',
            'slug' => 'blockchain-escrow-settlement-protocol',
            'client' => 'VeriTrust Labs Inc.',
            'description' => 'An automated, cryptographically secure smart contract platform for high-value real estate and intellectual property escrows.',
            'image' => null,
            'link' => 'https://veritrustlabs.example.com',
            'industry_id' => $industryFintech->id,
            'order' => 1,
            'is_active' => true,
            'content_data' => [
                'banner' => [
                    'badge' => 'BLOCKCHAIN & DEFI',
                    'title' => 'Decentralized Escrow and Smart Contract Settlement Engine',
                    'subtitle' => 'We developed an automated smart contract system handling over $45M in transactions with zero-trust escrow and decentralized arbitration.'
                ],
                'highlights' => [
                    'Multi-signature smart contract verification',
                    'Sub-second gas-optimized state triggers',
                    'Integrates ERC-20, ERC-721, and ERC-1155 tokens',
                    'Certified audit with zero vulnerability reports'
                ],
                'overview' => [
                    'title' => 'Overview',
                    'description' => "VeriTrust Labs wanted to eliminate traditional middleman escrow services for high-value asset acquisitions. We built a customized dApp combining Solidity smart contracts, a React-based interactive web dashboard, and decentralized oracle integration (Chainlink) for automated asset transfers."
                ],
                'challenge' => [
                    'title' => 'The Escrow Trust Deficit',
                    'description' => "Traditional escrows require exorbitant fees and manual processing times taking up to 14 days. Creating an automated alternative required solving security vulnerabilities, high gas costs, and trustless arbitration if contract disputes arose."
                ],
                'solution' => [
                    'title' => 'Automated Multi-Sig Escrow Protocol',
                    'description' => "We architected an Ethereum-compatible protocol using Solidity. Contracts are locked using decentralized multi-sig schemes. Integration of oracle nodes automatically triggers settlements upon off-chain real-world API events. Arbitration is handled via decentralized community votes using governance tokens."
                ],
                'features_title' => 'Key Features & Capabilities',
                'features' => [
                    [
                        'title' => 'Dynamic Smart Escrow Locking',
                        'description' => 'Assets are locked securely inside smart contracts without third-party exposure, automatically released on programmatic triggers.'
                    ],
                    [
                        'title' => 'Chainlink Oracle Integration',
                        'description' => 'Utilized decentralized oracles to feed off-chain validation data to the smart contracts, validating real-world events.'
                    ],
                    [
                        'title' => 'Gas Optimization Engine',
                        'description' => 'Custom solidity refactoring and state packaging reduced gas costs by 42% compared to standard escrow contract templates.'
                    ]
                ],
                'approach' => [
                    'title' => 'Security First Architecture',
                    'description' => 'We focused on a security-first methodology using formal mathematical verification of smart contracts, followed by unit testing across 250 test vectors.',
                    'description2' => 'Every line of Solidity code was audited by CertiK and verified on testnet before deployment.'
                ],
                'process_title' => 'Delivery Process',
                'process_subtitle' => 'How we structured the execution cycle of this project.',
                'process' => [
                    [
                        'title' => 'Phase 1: Cryptographic Modeling',
                        'description' => 'Designed the state machine and defined multi-sig escrow transitions.'
                    ],
                    [
                        'title' => 'Phase 2: Contract Development',
                        'description' => 'Authored Solidity smart contracts and conducted local test suite runs.'
                    ],
                    [
                        'title' => 'Phase 3: Security Audits & Optimizations',
                        'description' => 'Conducted formal audits and applied gas-reduction optimizations.'
                    ],
                    [
                        'title' => 'Phase 4: dApp Dashboard Integration',
                        'description' => 'Built the React frontend and integrated Ethers.js for wallet connections.'
                    ]
                ],
                'achievements' => [
                    [
                        'title' => '$45M+',
                        'description' => 'Transaction Volume Secured'
                    ],
                    [
                        'title' => '42%',
                        'description' => 'Gas Cost Reduction'
                    ],
                    [
                        'title' => '0',
                        'description' => 'Security Incidents'
                    ],
                    [
                        'title' => '100%',
                        'description' => 'Automated Settlements'
                    ]
                ],
                'testimonials' => [
                    [
                        'title' => 'Ethan Sterling',
                        'role' => 'Chief Technology Officer at VeriTrust',
                        'description' => "Devent's blockchain engineering team delivered a flawlessly secure smart contract suite. Their gas optimization saved our clients millions in transaction fees."
                    ]
                ],
                'faqs' => [
                    [
                        'title' => 'Is this protocol compatible with EVM chains?',
                        'description' => 'Yes, the smart contracts are written in Solidity and compiled for compilation on Ethereum, Polygon, BSC, and Arbitrum.'
                    ],
                    [
                        'title' => 'How are disputes resolved?',
                        'description' => 'Disputes trigger a multi-sig lockup and activate decentralized oracle-voting to verify dispute conditions based on structured off-chain proofs.'
                    ]
                ],
                'cta' => [
                    'title' => 'Need a custom Blockchain solution?',
                    'subtitle' => "Consult with Devent Technology's decentralized application engineers to audit, design, and launch a compliant dApp.",
                    'button' => 'Connect With Us Today'
                ]
            ]
        ]);
        $blockchainStudy->technologies()->attach([$techSolidity->id, $techEthereum->id, $techReact->id]);

        // -------------------------------------------------------------
        // Case Study 2: CRM
        // -------------------------------------------------------------
        $crmStudy = CaseStudy::create([
            'title' => 'Cloud-Native Enterprise Healthcare CRM Platform',
            'slug' => 'healthcare-crm-platform',
            'client' => 'OmniHealth Providers Corp',
            'description' => 'A HIPAA-compliant patient relationship manager that unifies electronic health records, automated follow-ups, and AI diagnostic booking.',
            'image' => null,
            'link' => 'https://omnihealth.example.com',
            'industry_id' => $industryHealthcare->id,
            'order' => 2,
            'is_active' => true,
            'content_data' => [
                'banner' => [
                    'badge' => 'ENTERPRISE CRM',
                    'title' => 'HIPAA-Compliant Patient Relationship CRM',
                    'subtitle' => 'Designed and built an enterprise healthcare CRM that consolidated patient records and streamlined doctor-patient coordination for 12,000+ medical staff.'
                ],
                'highlights' => [
                    'HIPAA and SOC 2 Type II Compliant security',
                    'HL7 FHIR database integration',
                    'Real-time doctor schedule synchronization',
                    'AI-based patient queue optimization'
                ],
                'overview' => [
                    'title' => 'Overview',
                    'description' => "OmniHealth needed a modern CRM platform to unify patient interactions across 45 regional hospitals. Our solution replaced fragmented legacy databases with a modern cloud application featuring customized patient pipelines, automated SMS/email reminders, and HL7-compliant patient file access."
                ],
                'challenge' => [
                    'title' => 'Data Silos & Security Risks',
                    'description' => "Patient records were isolated in distinct databases, causing booking conflicts and delays. Additionally, any solution had to adhere to stringent HIPAA regulations, meaning data encryption at rest and in transit was a primary bottleneck."
                ],
                'solution' => [
                    'title' => 'Unified HL7 FHIR CRM',
                    'description' => "We built a web application using Laravel and React, utilizing a microservices architecture. The system communicates via encrypted HL7 FHIR APIs to securely fetch health records. Doctor schedules are managed via a high-performance Redis cache to eliminate booking double-takes."
                ],
                'features_title' => 'Key Features & Capabilities',
                'features' => [
                    [
                        'title' => 'HIPAA Compliant Vault',
                        'description' => 'Encrypted database layers with automatic access auditing logs, securing sensitive health records (PHI).'
                    ],
                    [
                        'title' => 'Interactive Doctor Calendars',
                        'description' => 'Real-time calendar interface built on React, allowing instant booking, scheduling overrides, and patient notes access.'
                    ],
                    [
                        'title' => 'Automated Communications Pipeline',
                        'description' => 'Integrated Twilio API for sending automated follow-up instructions, prescription refill notifications, and appointment reminders.'
                    ]
                ],
                'approach' => [
                    'title' => 'User-Centric Healthcare Workflows',
                    'description' => 'We spent 60+ hours shadow-observing hospital front desk staff and doctors to design an optimized booking flow that minimizes clicks.',
                    'description2' => 'The final interface reduced patient check-in times by 35% across all facilities.'
                ],
                'process_title' => 'Delivery Process',
                'process_subtitle' => 'How we structured the execution cycle of this project.',
                'process' => [
                    [
                        'title' => 'Phase 1: HIPAA Design Audit',
                        'description' => 'Conducted compliance profiling and established secure AWS server environments.'
                    ],
                    [
                        'title' => 'Phase 2: Database Harmonization',
                        'description' => 'Migrated legacy patient profiles into a unified HL7-compliant database structure.'
                    ],
                    [
                        'title' => 'Phase 3: Module Implementation',
                        'description' => 'Built the scheduling engines, pipeline dashboards, and communications interface.'
                    ],
                    [
                        'title' => 'Phase 4: Penetration Testing',
                        'description' => 'Conducted security testing to ensure Zero-Trust access controls worked correctly.'
                    ]
                ],
                'achievements' => [
                    [
                        'title' => '1.2M+',
                        'description' => 'Active Patient Portals'
                    ],
                    [
                        'title' => '35%',
                        'description' => 'Check-in Time Reduction'
                    ],
                    [
                        'title' => '100%',
                        'description' => 'HIPAA Audit Compliance'
                    ],
                    [
                        'title' => '4.9/5',
                        'description' => 'Staff Satisfaction Rating'
                    ]
                ],
                'testimonials' => [
                    [
                        'title' => 'Dr. Sarah Jenkins',
                        'role' => 'Chief Medical Officer at OmniHealth',
                        'description' => "Devent's CRM transformed how our clinical staff interacts with patients. The unified view of patient histories has significantly elevated our standard of care."
                    ]
                ],
                'faqs' => [
                    [
                        'title' => 'Is patient data encrypted?',
                        'description' => 'Absolutely. All patient health information (PHI) is encrypted at rest using AES-256 and in transit using TLS 1.3.'
                    ],
                    [
                        'title' => 'Can this integrate with Epic or Cerner EHRs?',
                        'description' => 'Yes, the system is designed on HL7 FHIR standards, allowing standard API integration with major EHR providers.'
                    ]
                ],
                'cta' => [
                    'title' => 'Want to build a compliant CRM?',
                    'subtitle' => "Discuss your compliance and client management requirements with Devent's enterprise CRM architects.",
                    'button' => 'Connect With Us Today'
                ]
            ]
        ]);
        $crmStudy->technologies()->attach([$techLaravel->id, $techReact->id, $techMySQL->id]);

        // -------------------------------------------------------------
        // Case Study 3: ERP
        // -------------------------------------------------------------
        $erpStudy = CaseStudy::create([
            'title' => 'Next-Gen Manufacturing ERP & Resource Scheduler',
            'slug' => 'manufacturing-erp-scheduler',
            'client' => 'AeroParts Global Ltd.',
            'description' => 'An industrial ERP platform managing supply chains, assembly schedules, and predictive maintenance for global aerospace parts manufacturing.',
            'image' => null,
            'link' => 'https://aeroparts.example.com',
            'industry_id' => $industryManufacturing->id,
            'order' => 3,
            'is_active' => true,
            'content_data' => [
                'banner' => [
                    'badge' => 'ENTERPRISE ERP',
                    'title' => 'Industrial Manufacturing ERP & Supply Chain Engine',
                    'subtitle' => 'We engineered an enterprise-grade ERP system to manage multi-site assembly operations, raw material procurement, and predictive maintenance schedules.'
                ],
                'highlights' => [
                    'Predictive supply chain forecasting',
                    'Multi-warehouse inventory tracking',
                    'Automated invoice and purchase order generation',
                    'IoT assembly line sensory tracking'
                ],
                'overview' => [
                    'title' => 'Overview',
                    'description' => "AeroParts Global is a key supplier of aerospace components. Their legacy ERP system failed to scale with their expansion into 5 global assembly sites. We designed and built a highly customizable cloud ERP to orchestrate resources, materials, and machinery logs."
                ],
                'challenge' => [
                    'title' => 'Supply Chain Blind Spots',
                    'description' => "Inaccurate inventory logs caused frequent machine downtime due to missing raw components. Furthermore, managing custom invoices across multiple international currencies led to bookkeeping bottlenecks."
                ],
                'solution' => [
                    'title' => 'Predictive Cloud ERP System',
                    'description' => "We built a secure ERP system utilizing Laravel, React, and Python data engines. The system integrates machine IoT sensors to track assembly metrics in real-time, predicting raw material depletion up to 3 days in advance."
                ],
                'features_title' => 'Key Features & Capabilities',
                'features' => [
                    [
                        'title' => 'Real-Time Resource Scheduler',
                        'description' => 'An interactive Gantt-based resource scheduler allowing drag-and-drop planning of assembly runs, personnel shifts, and machinery checks.'
                    ],
                    [
                        'title' => 'IoT Maintenance Analytics',
                        'description' => 'Monitors machinery sensors, automatically scheduling preventive maintenance before breakdowns occur.'
                    ],
                    [
                        'title' => 'Global Inventory Synchronization',
                        'description' => 'Uses a distributed database architecture to synchronize stock changes across 5 international warehouses within 2 seconds.'
                    ]
                ],
                'approach' => [
                    'title' => 'High Reliability Architecture',
                    'description' => 'For manufacturing, system downtime translates directly to loss. We engineered the ERP on a highly redundant AWS server stack, boasting 99.99% uptime.',
                    'description2' => 'Integrated fallbacks ensure local offline tracking in case of temporary network dropouts.'
                ],
                'process_title' => 'Delivery Process',
                'process_subtitle' => 'How we structured the execution cycle of this project.',
                'process' => [
                    [
                        'title' => 'Phase 1: Workflow Auditing',
                        'description' => 'Mapped assembly-line processes and inventory stages across warehouses.'
                    ],
                    [
                        'title' => 'Phase 2: ERP Core Construction',
                        'description' => 'Developed database relationships, inventory tables, and invoicing APIs.'
                    ],
                    [
                        'title' => 'Phase 3: IoT Sensor Integration',
                        'description' => 'Configured sensor data endpoints and analytical triggers.'
                    ],
                    [
                        'title' => 'Phase 4: Load Testing',
                        'description' => 'Simulated high concurrent database traffic across global networks.'
                    ]
                ],
                'achievements' => [
                    [
                        'title' => '28%',
                        'description' => 'Inventory Waste Reduction'
                    ],
                    [
                        'title' => '99.99%',
                        'description' => 'ERP System Uptime'
                    ],
                    [
                        'title' => '14 Days',
                        'description' => 'Average Cycle Time Saved'
                    ],
                    [
                        'title' => '$1.8M',
                        'description' => 'Saved in Maintenance Costs'
                    ]
                ],
                'testimonials' => [
                    [
                        'title' => 'Marcus Vane',
                        'role' => 'VP of Global Operations at AeroParts',
                        'description' => "Devent's custom ERP solved our inventory forecasting issues overnight. We have achieved record-breaking assembly throughput with zero supply delays."
                    ]
                ],
                'faqs' => [
                    [
                        'title' => 'Does the ERP support international taxation?',
                        'description' => 'Yes, the billing and invoicing module automatically calculates VAT, GST, and customized export duties based on shipping destinations.'
                    ],
                    [
                        'title' => 'Is there a mobile app for factory staff?',
                        'description' => 'Yes, we developed an optimized progressive web app (PWA) allowing floor workers to scan barcodes and log item status in real-time.'
                    ]
                ],
                'cta' => [
                    'title' => 'Ready to build your custom ERP solution?',
                    'subtitle' => 'Connect with our system architects to build a highly optimized enterprise scheduling platform.',
                    'button' => 'Connect With Us Today'
                ]
            ]
        ]);
        $erpStudy->technologies()->attach([$techLaravel->id, $techReact->id, $techPython->id]);

        // -------------------------------------------------------------
        // Case Study 4: E-Commerce Website
        // -------------------------------------------------------------
        $ecommerceStudy = CaseStudy::create([
            'title' => 'Scalable B2B Electronics Commerce Portal',
            'slug' => 'b2b-electronics-commerce-portal',
            'client' => 'ElectraSupply Global',
            'description' => 'A high-performance B2B e-commerce platform processing bulk orders, wholesale tiered pricing, and automated ERP dispatch.',
            'image' => null,
            'link' => 'https://electrasupply.example.com',
            'industry_id' => $industryEcommerce->id,
            'order' => 4,
            'is_active' => true,
            'content_data' => [
                'banner' => [
                    'badge' => 'E-COMMERCE WEB',
                    'title' => 'High-Performance B2B Electronics Commerce Portal',
                    'subtitle' => 'We built a headless B2B e-commerce website designed to handle massive wholesale catalogs, volume-tiered pricing, and instant quotes.'
                ],
                'highlights' => [
                    'Headless Next.js storefront with Laravel API backend',
                    'Dynamic bulk-pricing calculations',
                    'Integrated tax and custom duties APIs',
                    'Seamless payment gateway integration (Stripe/Adyen)'
                ],
                'overview' => [
                    'title' => 'Overview',
                    'description' => "ElectraSupply Global wanted to digitize their wholesale distribution system. They required a fast, SEO-optimized web interface that allows buyers to customize product specifications, get instant bulk pricing discounts, and place tax-compliant international purchase orders."
                ],
                'challenge' => [
                    'title' => 'Slow Speeds & Complex Pricing',
                    'description' => "With over 120,000 product variants, their existing e-commerce site took up to 6 seconds to load, resulting in lost sales. Calculating custom pricing tiers for individual corporate partners in real-time was also causing database lockups."
                ],
                'solution' => [
                    'title' => 'Headless B2B Commerce Architecture',
                    'description' => "We implemented a headless commerce solution. The frontend is built on Next.js/Tailwind CSS, generating static pages compiled via incremental static regeneration. The backend is a robust Laravel REST API. Database reads for pricing catalogs are cached in Redis, resulting in sub-100ms response times."
                ],
                'features_title' => 'Key Features & Capabilities',
                'features' => [
                    [
                        'title' => 'Tiered Price Generator',
                        'description' => 'A dynamic price matrix calculating bulk discounts, corporate-specific tax breaks, and shipping tariffs in real-time.'
                    ],
                    [
                        'title' => 'Instant Quote Request',
                        'description' => 'Allows buyers to download PDF quotes for approval before checkouts.'
                    ],
                    [
                        'title' => 'Headless Search Integration',
                        'description' => 'Integrated Algolia search engine, delivering instant auto-suggestions and facet filtering across 120,000 catalog variants.'
                    ]
                ],
                'approach' => [
                    'title' => 'Speed-Optimized UX',
                    'description' => 'A 1-second delay in page load for e-commerce can reduce conversions by 7%. We focused on static compilation and asset lazy-loading.',
                    'description2' => 'The final web platform achieved a 98/100 Mobile Speed rating on Google PageSpeed Insights.'
                ],
                'process_title' => 'Delivery Process',
                'process_subtitle' => 'How we structured the execution cycle of this project.',
                'process' => [
                    [
                        'title' => 'Phase 1: Catalog Taxonomy',
                        'description' => 'Structured the massive electronic component variants database.'
                    ],
                    [
                        'title' => 'Phase 2: Backend API Development',
                        'description' => 'Programmed REST endpoints, bulk discount tables, and ERP dispatch triggers.'
                    ],
                    [
                        'title' => 'Phase 3: Headless Storefront UI',
                        'description' => 'Engineered the Next.js frontend with Tailwind CSS styling.'
                    ],
                    [
                        'title' => 'Phase 4: Payment Gateway Configuration',
                        'description' => 'Integrated multi-currency payment gates and security protocols.'
                    ]
                ],
                'achievements' => [
                    [
                        'title' => '98/100',
                        'description' => 'PageSpeed Performance Score'
                    ],
                    [
                        'title' => '+164%',
                        'description' => 'Wholesale Order Conversions'
                    ],
                    [
                        'title' => '<100ms',
                        'description' => 'Search Result Delivery'
                    ],
                    [
                        'title' => '$24M',
                        'description' => 'Online Revenue Generated'
                    ]
                ],
                'testimonials' => [
                    [
                        'title' => 'Regina Vance',
                        'role' => 'Head of Sales at ElectraSupply',
                        'description' => "The speed of our new portal has blown our buyers away. Ordering thousands of components now takes minutes rather than back-and-forth emails."
                    ]
                ],
                'faqs' => [
                    [
                        'title' => 'How are corporate customer accounts managed?',
                        'description' => 'Corporate buyers can create master accounts, permitting sub-accounts with specific monthly spend limits and buying authorizations.'
                    ],
                    [
                        'title' => 'Does this connect directly to dispatch centers?',
                        'description' => 'Yes, completed payments automatically trigger dispatch orders in their shipping and logistics systems.'
                    ]
                ],
                'cta' => [
                    'title' => 'Ready to build a high-converting web store?',
                    'subtitle' => 'We design lightning-fast headless e-commerce solutions suited for both B2B bulk orders and B2C conversions.',
                    'button' => 'Connect With Us Today'
                ]
            ]
        ]);
        $ecommerceStudy->technologies()->attach([$techNextjs->id, $techTailwind->id, $techLaravel->id]);
    }
}
