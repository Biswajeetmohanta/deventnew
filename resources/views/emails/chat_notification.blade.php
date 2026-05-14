<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #000; color: #fff; padding: 20px; border-radius: 10px 10px 0 0; text-align: center; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #888; text-align: center; padding: 20px; }
        .message-box { background: #f9f9f9; padding: 15px; border-left: 4px solid #000; margin: 20px 0; font-style: italic; }
        .btn { display: inline-block; padding: 10px 20px; background: #000; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Chat Message</h2>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>A visitor has sent a new message via the website chatbot.</p>
            
            <div class="message-box">
                "{{ $chatMessage->message }}"
            </div>
            
            <p><strong>Session ID:</strong> {{ $chatSession->session_id }}</p>
            <p><strong>Visitor:</strong> {{ $chatSession->visitor_name ?? 'Anonymous' }}</p>
            <p><strong>Time:</strong> {{ $chatMessage->created_at->format('M d, Y h:i A') }}</p>
            
            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/admin/chats') }}" class="btn">View Chat in Admin Panel</a>
            </p>
        </div>
        <div class="footer">
            This is an automated notification from your website Chatbot.
        </div>
    </div>
</body>
</html>
