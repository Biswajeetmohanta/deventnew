<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Certificate;

class ClientAndCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clients
        $clients = [
            [
                'name' => 'Acme Corporation',
                'logo' => 'clients/acme.png',
                'website_url' => 'https://acme-demo.com',
                'description' => 'A leader in providing global solutions and consumer goods with highly innovative strategies.',
                'sort_order' => 1,
                'status' => true,
            ],
            [
                'name' => 'TechCorp Solutions',
                'logo' => 'clients/techcorp.png',
                'website_url' => 'https://techcorp-demo.com',
                'description' => 'Providing premium cloud infrastructure and full-stack software consulting services worldwide.',
                'sort_order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Global Logistics Inc.',
                'logo' => 'clients/logistics.png',
                'website_url' => 'https://globallogistics-demo.com',
                'description' => 'Next-gen supply chain management and automated sorting operations partner.',
                'sort_order' => 3,
                'status' => true,
            ],
            [
                'name' => 'Nexus Retail Group',
                'logo' => 'clients/nexus.png',
                'website_url' => 'https://nexusretail-demo.com',
                'description' => 'Innovative e-commerce and retail network utilizing Devent high-scale APIs.',
                'sort_order' => 4,
                'status' => true,
            ],
        ];

        foreach ($clients as $client) {
            Client::firstOrCreate(['name' => $client['name']], $client);
        }

        // Certificates
        $certificates = [
            [
                'title' => 'ISO 9001:2015 Quality Management System',
                'image_or_pdf' => 'certificates/iso9001.pdf',
                'issuer' => 'International Standards Registrars',
                'issue_date' => '2025-01-15',
                'description' => 'Certified quality standards compliance across all internal IT support and development divisions.',
                'sort_order' => 1,
                'status' => true,
            ],
            [
                'title' => 'ISO/IEC 27001:2022 Information Security Management',
                'image_or_pdf' => 'certificates/iso27001.png',
                'issuer' => 'Global Accreditations Forum',
                'issue_date' => '2025-03-22',
                'description' => 'Excellence in information security management systems, protecting corporate and client intellectual property.',
                'sort_order' => 2,
                'status' => true,
            ],
            [
                'title' => 'CMMI Level 3 Maturity Certification',
                'image_or_pdf' => 'certificates/cmmi.pdf',
                'issuer' => 'CMMI Institute',
                'issue_date' => '2024-09-10',
                'description' => 'Demonstrated process control, capability development, and software maturity across all engineering teams.',
                'sort_order' => 3,
                'status' => true,
            ],
        ];

        foreach ($certificates as $cert) {
            Certificate::firstOrCreate(['title' => $cert['title']], $cert);
        }
    }
}
