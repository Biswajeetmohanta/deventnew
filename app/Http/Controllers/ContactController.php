<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Inquiry;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create($validated);

        // Send dual emails via Brevo
        $this->sendContactEmails($validated);

        return back()->with('success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }

    /**
     * Send notification email to admin AND confirmation email to the user.
     */
    private function sendContactEmails(array $data): void
    {
        try {
            // Fetch dynamic settings
            $settings       = Setting::whereIn('key', [
                'chatbot_notification_email',
                'brevo_api_key',
                'mail_from_address',
                'site_name',
                'contact_email',
                'contact_phone',
            ])->pluck('value', 'key');

            $adminEmail  = $settings->get('chatbot_notification_email');
            $brevoApiKey = $settings->get('brevo_api_key');
            $fromAddress = $settings->get('mail_from_address') ?? 'no-reply@deventtechnology.com';
            $siteName    = $settings->get('site_name', 'Devent Technology');
            $contactEmail = $settings->get('contact_email');
            $contactPhone = $settings->get('contact_phone');

            // Bail if Brevo not configured
            if (!$brevoApiKey) {
                Log::warning('ContactController: Brevo API key not configured, skipping email.');
                return;
            }

            $sharedPayload = [
                'name'         => $data['name'],
                'email'        => $data['email'],
                'phone'        => $data['phone'] ?? null,
                'subject'      => $data['subject'] ?? null,
                'message'      => $data['message'],
                'siteName'     => $siteName,
                'contactEmail' => $contactEmail,
                'contactPhone' => $contactPhone,
            ];

            $headers = [
                'api-key'      => $brevoApiKey,
                'accept'       => 'application/json',
                'content-type' => 'application/json',
            ];

            $sender = [
                'name'  => $siteName,
                'email' => $fromAddress,
            ];

            // ─── 1. Admin notification email ──────────────────────────────────────
            if ($adminEmail) {
                $adminHtml = view('emails.contact_admin', $sharedPayload)->render();

                $adminResponse = Http::withHeaders($headers)->post('https://api.brevo.com/v3/smtp/email', [
                    'sender'      => $sender,
                    'to'          => [['email' => $adminEmail, 'name' => 'Admin']],
                    'subject'     => 'New Contact Form Submission – ' . ($data['subject'] ?? $data['name']),
                    'htmlContent' => $adminHtml,
                ]);

                if (!$adminResponse->successful()) {
                    Log::error('ContactController: Admin email failed – ' . $adminResponse->body());
                }
            }

            // ─── 2. User confirmation email ───────────────────────────────────────
            $userHtml = view('emails.contact_user', $sharedPayload)->render();

            $userResponse = Http::withHeaders($headers)->post('https://api.brevo.com/v3/smtp/email', [
                'sender'      => $sender,
                'to'          => [['email' => $data['email'], 'name' => $data['name']]],
                'subject'     => 'We received your message – ' . $siteName,
                'htmlContent' => $userHtml,
            ]);

            if (!$userResponse->successful()) {
                Log::error('ContactController: User confirmation email failed – ' . $userResponse->body());
            }

        } catch (\Throwable $e) {
            Log::error('ContactController: Email send exception – ' . $e->getMessage());
        }
    }
}
