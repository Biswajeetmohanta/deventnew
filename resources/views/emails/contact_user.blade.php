<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We received your message</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f4f8; line-height: 1.6; color: #333; }
        .wrapper { max-width: 620px; margin: 30px auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #1d4ed8, #3b82f6); padding: 36px 40px; text-align: center; }
        .header .icon { font-size: 40px; margin-bottom: 12px; }
        .header h1 { color: #fff; font-size: 24px; font-weight: 700; letter-spacing: -0.3px; }
        .header p { color: rgba(255,255,255,0.85); font-size: 15px; margin-top: 8px; }
        .content { padding: 40px; }
        .greeting { font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 12px; }
        .body-text { font-size: 15px; color: #475569; margin-bottom: 24px; line-height: 1.7; }
        .summary-box { background: #f8fafc; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; margin: 24px 0; }
        .summary-title { font-size: 12px; font-weight: 700; color: #3b82f6; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 16px; }
        .summary-row { display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f1f5f9; align-items: flex-start; }
        .summary-row:last-child { border-bottom: none; padding-bottom: 0; }
        .summary-label { font-size: 12px; font-weight: 700; color: #94a3b8; min-width: 70px; padding-top: 1px; }
        .summary-value { font-size: 14px; color: #1e293b; font-weight: 500; word-break: break-word; }
        .divider { height: 1px; background: #e2e8f0; margin: 28px 0; }
        .promise-box { background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 12px; padding: 20px 24px; border-left: 4px solid #3b82f6; }
        .promise-box p { font-size: 14px; color: #1d4ed8; font-weight: 600; }
        .promise-box span { font-size: 13px; color: #3b82f6; font-weight: 400; display: block; margin-top: 4px; }
        .contact-section { margin-top: 28px; }
        .contact-section p { font-size: 14px; color: #475569; margin-bottom: 16px; }
        .contact-links { display: flex; gap: 12px; flex-wrap: wrap; }
        .contact-link { display: inline-flex; align-items: center; gap: 6px; background: #f8fafc; border: 1px solid #e2e8f0; color: #1d4ed8; text-decoration: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; }
        .footer { background: #f8fafc; padding: 28px 40px; text-align: center; }
        .footer p { font-size: 12px; color: #94a3b8; line-height: 1.8; }
        .footer strong { color: #475569; font-size: 14px; display: block; margin-bottom: 6px; }
        .social-text { margin-top: 12px; font-size: 12px; color: #cbd5e1; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="icon">✅</div>
            <h1>Message Received!</h1>
            <p>Thank you for reaching out to us. We'll get back to you soon.</p>
        </div>

        <div class="content">
            <p class="greeting">Hi {{ $name }},</p>
            <p class="body-text">
                Thank you for contacting <strong>{{ $siteName }}</strong>! We have successfully received your message and our team will review it shortly. You can expect to hear from us within <strong>24 hours</strong>.
            </p>

            <div class="summary-box">
                <p class="summary-title">Your Submission Summary</p>
                <div class="summary-row">
                    <span class="summary-label">Name</span>
                    <span class="summary-value">{{ $name }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Email</span>
                    <span class="summary-value">{{ $email }}</span>
                </div>
                @if(!empty($subject))
                <div class="summary-row">
                    <span class="summary-label">Subject</span>
                    <span class="summary-value">{{ $subject }}</span>
                </div>
                @endif
                <div class="summary-row">
                    <span class="summary-label">Message</span>
                    <span class="summary-value">{{ Str::limit($message, 200) }}</span>
                </div>
            </div>

            <div class="promise-box">
                <p>⏱ We typically respond within 24 hours</p>
                <span>Our team will review your inquiry and get back to you with the best solution.</span>
            </div>

            @if(!empty($contactEmail) || !empty($contactPhone))
            <div class="contact-section">
                <p>In the meantime, feel free to reach us directly:</p>
                <div class="contact-links">
                    @if(!empty($contactEmail))
                    <a href="mailto:{{ $contactEmail }}" class="contact-link">
                        📧 {{ $contactEmail }}
                    </a>
                    @endif
                    @if(!empty($contactPhone))
                    <a href="tel:{{ $contactPhone }}" class="contact-link">
                        📞 {{ $contactPhone }}
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="footer">
            <strong>{{ $siteName }}</strong>
            <p>You're receiving this because you submitted a contact form on our website.</p>
            <p>If you did not submit this form, please ignore this email.</p>
        </div>
    </div>
</body>
</html>
