<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (\App\Models\User::where('email', 'test@example.com')->doesntExist()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role' => 'admin',
            ]);
        }

        // Add demo admin
        if (\App\Models\User::where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                'name' => 'System Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        // Add demo client
        if (\App\Models\User::where('email', 'client@example.com')->doesntExist()) {
            $client = User::create([
                'name' => 'Acme Corporation',
                'email' => 'client@example.com',
                'password' => bcrypt('password'),
                'role' => 'client',
            ]);

            // Add demo project
            $project = \App\Models\Project::create([
                'user_id' => $client->id,
                'name' => 'Acme Enterprise SaaS Portal',
                'description' => 'A custom-built secure administration portal matching client operations.',
                'progress_percent' => 35,
                'status' => 'in_progress',
            ]);

            // Add demo milestones
            \App\Models\ProjectMilestone::create([
                'project_id' => $project->id,
                'title' => 'Project Kickoff & Scope Definition',
                'description' => 'Aligning deliverables, wireframes, and setting up repository foundations.',
                'status' => 'completed',
                'due_date' => now()->subDays(10),
            ]);

            \App\Models\ProjectMilestone::create([
                'project_id' => $project->id,
                'title' => 'High-Fidelity Figma UI Design',
                'description' => 'Delivery of complete desktop and mobile layouts for client review.',
                'status' => 'completed',
                'due_date' => now()->subDays(2),
            ]);

            \App\Models\ProjectMilestone::create([
                'project_id' => $project->id,
                'title' => 'Core Database & Backend API Development',
                'description' => 'Creating Eloquent models, controllers, and configuring system logic.',
                'status' => 'pending',
                'due_date' => now()->addDays(20),
            ]);

            // Add demo invoice
            \App\Models\ProjectInvoice::create([
                'project_id' => $project->id,
                'invoice_number' => 'INV-2026-001',
                'amount' => 4500.00,
                'due_date' => now()->addDays(5),
                'status' => 'unpaid',
            ]);
        }

        $this->call([
            CaseStudySeeder::class,
            ClientAndCertificateSeeder::class,
            CalculatorSettingsSeeder::class,
        ]);
    }
}
