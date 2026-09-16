<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f4f8; line-height: 1.6; color: #333; }
        .wrapper { max-width: 620px; margin: 30px auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #1d4ed8, #3b82f6); padding: 36px 40px; text-align: center; }
        .header h1 { color: #fff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
        .header p { color: rgba(255,255,255,0.8); font-size: 14px; margin-top: 6px; }
        .badge { display: inline-block; background: rgba(255,255,255,0.2); color: #fff; font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 20px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px; }
        .content { padding: 40px; }
        .section-label { font-size: 11px; font-weight: 700; color: #3b82f6; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 16px; }
        .info-grid { display: grid; gap: 12px; }
        .info-row { display: flex; align-items: flex-start; gap: 12px; background: #f8fafc; border-radius: 10px; padding: 14px 16px; border-left: 3px solid #3b82f6; }
        .info-label { font-size: 12px; font-weight: 700; color: #64748b; min-width: 70px; padding-top: 1px; }
        .info-value { font-size: 14px; color: #1e293b; font-weight: 500; word-break: break-all; }
        .message-box { margin-top: 24px; background: #f8fafc; border-radius: 10px; padding: 20px; border-left: 3px solid #3b82f6; }
        .message-box p { font-size: 14px; color: #1e293b; white-space: pre-line; line-height: 1.7; }
        .divider { height: 1px; background: #e2e8f0; margin: 28px 0; }
        .cta { text-align: center; margin-top: 28px; }
        .btn { display: inline-block; background: linear-gradient(135deg, #1d4ed8, #3b82f6); color: #fff; text-decoration: none; padding: 14px 32px; border-radius: 10px; font-weight: 700; font-size: 14px; letter-spacing: 0.3px; }
        .footer { background: #f8fafc; padding: 24px 40px; text-align: center; }
        .footer p { font-size: 12px; color: #94a3b8; }
        .footer strong { color: #64748b; }
        .timestamp { font-size: 12px; color: #94a3b8; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="badge">New Inquiry</div>
            <h1>New Contact Form Submission</h1>
            <p>Someone just reached out through your website</p>
        </div>

        <div class="content">
            <p class="section-label">Sender Details</p>
            <div class="info-grid">
                <div class="info-row">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $email }}</span>
                </div>
                @if(!empty($phone))
                <div class="info-row">
                    <span class="info-label">Phone</span>
                    <span class="info-value">{{ $phone }}</span>
                </div>
                @endif
                @if(!empty($subject))
                <div class="info-row">
                    <span class="info-label">Subject</span>
                    <span class="info-value">{{ $subject }}</span>
                </div>
                @endif
            </div>

            <div class="divider"></div>

            <p class="section-label">Message</p>
            <div class="message-box">
                <p>{{ $message }}</p>
            </div>

            <div class="cta">
                <a href="https://deventtechnology.com/admin/inquiries" class="btn">View in Admin Panel →</a>
            </div>
        </div>

        <div class="footer">
            <p><strong>{{ $siteName }}</strong></p>
            <p class="timestamp">Received on {{ now()->format('D, M d, Y \a\t h:i A') }}</p>
            <p style="margin-top:8px;">This is an automated notification from your website contact form.</p>
        </div>
    </div>
</body>
</html>
