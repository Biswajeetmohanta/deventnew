<?php

use App\Models\Industry;

$industry = Industry::where('slug', 'banking-finance')->first();

if ($industry) {
    $contentData = [
        'banner' => [
            'title' => 'Banking & Finance Software Development',
            'subtitle' => 'Secure, scalable, and compliant fintech solutions designed to modernize financial institutions and enhance customer trust.',
            'badge' => '⚡ FINTECH EXCELLENCE',
        ],
        'statistics' => [
            ['title' => '99.9%', 'description' => 'System Uptime'],
            ['title' => 'ISO', 'description' => 'Certified Security'],
            ['title' => '50M+', 'description' => 'Daily Transactions'],
            ['title' => '24/7', 'description' => 'Expert Support'],
        ],
        'solutions_label' => 'OUR FINTECH SOLUTIONS',
        'solutions_title' => 'Future-Ready Financial Ecosystems',
        'solutions_subtitle' => 'From core banking systems to digital wallets and investment platforms, we build the infrastructure of modern finance.',
        'solutions' => [
            ['title' => 'Digital Banking Apps', 'description' => 'Seamless mobile and web banking experiences with advanced transaction features.'],
            ['title' => 'Payment Gateways', 'description' => 'Secure, multi-currency payment processing systems with real-time settlement.'],
            ['title' => 'Wealth Management', 'description' => 'AI-driven investment platforms and portfolio management tools for advisors.'],
            ['title' => 'Regulatory Compliance', 'description' => 'Automated KYC/AML and reporting tools to ensure strict adherence to global standards.'],
        ],
        'about' => [
            'title' => 'Strategic Digital Transformation in Finance',
            'description' => 'The financial landscape is evolving rapidly. We help traditional banks and agile fintech startups navigate this change with technology that prioritizes security and performance.',
            'detailed_overview' => 'Our deep expertise in blockchain, cloud computing, and cybersecurity allows us to build financial systems that are not only efficient but also resilient against modern threats. We focus on creating user-centric designs that make complex financial tasks simple and intuitive.',
        ],
        'highlights' => [
            'PCI-DSS Compliance',
            'Biometric Authentication',
            'Real-time Data Analytics',
            'Blockchain Integration',
            'Smart Contract Automation',
            'Microservices Architecture',
        ],
        'features_title' => 'Core Capabilities for Modern Finance',
        'features' => [
            ['title' => 'Enterprise Security', 'description' => 'Military-grade encryption and multi-factor authentication to protect sensitive financial data.'],
            ['title' => 'API Orchestration', 'description' => 'Seamlessly connect with third-party providers, credit bureaus, and regulatory bodies.'],
            ['title' => 'Big Data Analysis', 'description' => 'Leverage transaction data to gain insights into customer behavior and market trends.'],
        ],
        'process_title' => 'Our Fintech Development Lifecycle',
        'process' => [
            ['title' => 'Discovery & Compliance', 'description' => 'We define requirements and ensure regulatory alignment from day one.'],
            ['title' => 'Architecture & Security', 'description' => 'Building a rock-solid foundation with security as the primary focus.'],
            ['title' => 'Agile Development', 'description' => 'Iterative building with regular testing and security audits.'],
            ['title' => 'Deployment & Monitoring', 'description' => 'Seamless launch with 24/7 performance and security monitoring.'],
        ],
        'advantages' => [
            ['title' => 'Regulatory Expertise', 'description' => 'We speak the language of finance and compliance.'],
            ['title' => 'Scalable Growth', 'description' => 'Systems built to handle millions of users and transactions.'],
            ['title' => 'Cost Efficiency', 'description' => 'Optimizing operations through automation and cloud tech.'],
            ['title' => 'User Trust', 'description' => 'Building interfaces that foster long-term customer loyalty.'],
        ],
        'why_choose' => [
            'title' => 'Why Partner with Devent for Fintech?',
            'description' => 'We combine technical mastery with deep financial domain knowledge to deliver results that matter.',
        ],
        'tech_stack_title' => 'Our Fintech Technology Stack',
        'tech_stack' => [
            ['title' => 'Backend', 'description' => 'Java, Node.js, Python, Go'],
            ['title' => 'Frontend', 'description' => 'React, Vue.js, Angular'],
            ['title' => 'Mobile', 'description' => 'React Native, Flutter, Swift'],
            ['title' => 'Database', 'description' => 'PostgreSQL, MongoDB, Redis'],
        ],
        'faqs_title' => 'Banking & Finance FAQs',
        'faqs' => [
            ['title' => 'How do you ensure data security?', 'description' => 'We implement end-to-end encryption, regular penetration testing, and comply with standards like PCI-DSS and GDPR.'],
            ['title' => 'Can you integrate with legacy banking systems?', 'description' => 'Yes, we specialize in building modern API layers over legacy infrastructure to enable digital transformation.'],
        ],
        'expert_consultation' => [
            'title' => 'Consult with our Fintech Experts',
            'description' => 'Bring your financial vision to life with a team that understands the complexities of the industry.',
            'button' => 'Schedule a Free Fintech Consultation',
        ],
        'cta' => [
            'title' => 'Ready to build the future of finance?',
            'subtitle' => 'Join the digital revolution with custom solutions built for security and scale.',
            'button' => 'Contact Our Finance Team',
        ],
        'testimonials_title' => 'Success Stories in Finance',
        'testimonials' => [
            ['title' => 'NeoBank Global', 'subtitle' => 'CEO', 'description' => 'Devent Technology helped us launch our digital bank in record time while maintaining the highest security standards.'],
            ['title' => 'InvestWise', 'subtitle' => 'CTO', 'description' => 'The investment platform built by Devent has scaled seamlessly as our user base grew by 500% in one year.'],
        ],
        'seo' => [
            'meta_title' => 'Banking & Finance Software Development | Devent Technology',
            'meta_description' => 'Expert fintech software development services. We build secure, scalable banking apps, payment gateways, and wealth management platforms.',
        ],
    ];

    $industry->content_data = $contentData;
    $industry->save();
    echo "Banking & Finance industry updated with premium content.\n";
} else {
    echo "Banking & Finance industry not found.\n";
}
