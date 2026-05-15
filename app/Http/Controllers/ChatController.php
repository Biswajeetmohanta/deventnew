<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Start or resume a chat session.
     */
    public function startSession(Request $request)
    {
        $sessionId = $request->cookie('chat_session_id');

        if ($sessionId) {
            $session = ChatSession::where('session_id', $sessionId)->first();
        }

        if (!isset($session) || !$session) {
            $sessionId = Str::uuid()->toString();
            $session = ChatSession::create([
                'session_id' => $sessionId,
                'visitor_name' => 'Visitor',
                'status' => 'active',
            ]);

            // We no longer create an automatic message here so that the frontend shows the lead form.

            $session->update(['last_message_at' => now()]);
        }

        $messages = $session->messages()->orderBy('created_at', 'asc')->get()->map(function ($msg) {
            return [
                'id' => $msg->id,
                'message' => $msg->message,
                'sender' => $msg->sender,
                'time' => $msg->created_at->format('h:i A'),
                'date' => $msg->created_at->format('M d'),
            ];
        });

        return response()->json([
            'session_id' => $sessionId,
            'messages' => $messages,
            'status' => $session->status,
        ])->cookie('chat_session_id', $sessionId, 60 * 24 * 30); // 30 days
    }

    /**
     * Visitor sends a message.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $sessionId = $request->cookie('chat_session_id') ?? $request->input('session_id');

        if (!$sessionId) {
            return response()->json(['error' => 'No active session'], 400);
        }

        $session = ChatSession::where('session_id', $sessionId)->first();
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        // Rate limiting
        $lastMessage = $session->messages()->where('sender', 'visitor')->latest()->first();
        if ($lastMessage && $lastMessage->created_at->diffInSeconds(now()) < 1) {
            return response()->json(['error' => 'Please wait before sending another message'], 429);
        }

        $msg = ChatMessage::create([
            'chat_session_id' => $session->id,
            'message' => strip_tags($request->input('message')),
            'sender' => 'visitor',
            'is_read' => false,
        ]);

        $session->update([
            'last_message_at' => now(),
            'is_read' => false,
            'status' => 'active',
        ]);

        $responseData = [
            'id' => $msg->id,
            'message' => $msg->message,
            'sender' => $msg->sender,
            'time' => $msg->created_at->format('h:i A'),
        ];

        // Process background tasks (Auto-reply and Email)
        if (function_exists('fastcgi_finish_request')) {
            response()->json($responseData)->send();
            fastcgi_finish_request();
            $this->processBackgroundTasks($msg, $session);
            exit;
        }

        // Synchronous fallback
        $this->processBackgroundTasks($msg, $session);
        return response()->json($responseData);
    }

    /**
     * Handles everything that happens after the user message is saved.
     */
    private function processBackgroundTasks($msg, $session)
    {
        // 1. Send Email Notification (Always send this for every visitor message)
        $this->sendEmailNotification($msg, $session);

        // 2. Prevent duplicate auto-replies (Debounce check)
        $lastAdminMsg = ChatMessage::where('chat_session_id', $session->id)
            ->where('sender', 'admin')
            ->latest()
            ->first();
            
        if ($lastAdminMsg && $lastAdminMsg->created_at->diffInSeconds(now()) < 5) {
            return;
        }

        // 3. Auto-reply logic
        $aiEnabled = \App\Models\Setting::where('key', 'chatbot_ai_enabled')->value('value');
        $apiKey = \App\Models\Setting::where('key', 'gemini_api_key')->value('value');
        $autoReplySent = false;
        $message = strtolower($msg->message);
        $reply = '';

        // Dynamic Data
        if (stripos($message, 'service') !== false) {
            $items = \App\Models\Service::where('is_active', true)->pluck('title')->toArray();
            if (!empty($items)) {
                $reply = "We offer the following services:\n• " . implode("\n• ", $items) . "\n\nWhich one would you like to know more about?";
                $autoReplySent = true;
            }
        }
        
        if (!$autoReplySent && (stripos($message, 'technolog') !== false || stripos($message, 'stack') !== false)) {
            $items = \App\Models\Technology::pluck('name')->toArray();
            if (!empty($items)) {
                $reply = "We work with a wide range of technologies, including:\n• " . implode("\n• ", $items) . "\n\nDo you have a specific stack in mind for your project?";
                $autoReplySent = true;
            }
        }

        if (!$autoReplySent && (stripos($message, 'industr') !== false || stripos($message, 'sector') !== false)) {
            $items = \App\Models\Industry::pluck('name')->toArray();
            if (!empty($items)) {
                $reply = "We have expertise in several industries, such as:\n• " . implode("\n• ", $items) . "\n\nHow can we help in your specific industry?";
                $autoReplySent = true;
            }
        }

        if (!$autoReplySent && (stripos($message, 'project') !== false || stripos($message, 'portfolio') !== false || stripos($message, 'work') !== false)) {
            $items = \App\Models\Portfolio::latest()->take(5)->pluck('title')->toArray();
            if (!empty($items)) {
                $reply = "Here are some of our recent projects:\n• " . implode("\n• ", $items) . "\n\nYou can view our full portfolio on our website!";
                $autoReplySent = true;
            }
        }

        if (!$autoReplySent && (stripos($message, 'blog') !== false || stripos($message, 'news') !== false || stripos($message, 'article') !== false)) {
            $items = \App\Models\Post::latest()->take(3)->pluck('title')->toArray();
            if (!empty($items)) {
                $reply = "Check out our latest blog posts:\n• " . implode("\n• ", $items) . "\n\nStay updated with the latest in tech!";
                $autoReplySent = true;
            }
        }

        if ($autoReplySent) {
            ChatMessage::create([
                'chat_session_id' => $session->id,
                'message' => $reply,
                'sender' => 'admin',
                'is_read' => false,
            ]);
        } else {
            // Keyword Replies - Sort by length descending to match longest phrases first
            $keywords = \App\Models\ChatAutoReply::where('is_active', true)
                ->orderByRaw('LENGTH(keyword) DESC')
                ->get();
            foreach ($keywords as $keyword) {
                // Use regex word boundary to prevent "hi" matching inside "this" or "white"
                if (preg_match('/\b' . preg_quote($keyword->keyword, '/') . '\b/i', $msg->message) || stripos($msg->message, $keyword->keyword) !== false) {
                    ChatMessage::create([
                        'chat_session_id' => $session->id,
                        'message' => $keyword->reply,
                        'sender' => 'admin',
                        'is_read' => false,
                    ]);
                    $autoReplySent = true;
                    break;
                }
            }
        }

        // Gemini AI Fallback
        if (!$autoReplySent && $aiEnabled && $apiKey) {
            $aiResponse = $this->getGeminiResponse($msg->message, $apiKey);
            if ($aiResponse) {
                ChatMessage::create([
                    'chat_session_id' => $session->id,
                    'message' => $aiResponse,
                    'sender' => 'admin',
                    'is_read' => false,
                ]);
            }
        }
    }

    private function sendEmailNotification($msg, $session)
    {
        try {
            $notifyEmail = \App\Models\Setting::where('key', 'chatbot_notification_email')->value('value');
            if ($notifyEmail) {
                // Send Email Notification via Brevo API

                $fromAddress = \App\Models\Setting::where('key', 'mail_from_address')->value('value') ?? 'perfectpicels@gmail.com';
                $siteName = \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Devent Chatbot';

                $apiKey = \App\Models\Setting::where('key', 'brevo_api_key')->value('value');

                $htmlContent = view('emails.chat_notification', [
                    'chatMessage' => $msg,
                    'chatSession' => $session
                ])->render();

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'api-key' => $apiKey,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])->post('https://api.brevo.com/v3/smtp/email', [
                    'sender' => [
                        'name' => $siteName,
                        'email' => $fromAddress,
                    ],
                    'to' => [
                        [
                            'email' => $notifyEmail,
                            'name' => 'Admin'
                        ]
                    ],
                    'subject' => 'New Message from Website Chatbot',
                    'htmlContent' => $htmlContent,
                ]);

                if (!$response->successful()) {
                    \Illuminate\Support\Facades\Log::error('Brevo Email API Error: ' . $response->body());
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Chatbot Email Error: ' . $e->getMessage());
        }
    }

    private function getGeminiResponse($prompt, $apiKey)
    {
        try {
            $context = "You are a helpful customer support assistant for Devent Technology, an IT company. Keep your answers short, professional, and friendly. If you don't know the answer, tell them a human agent will contact them soon. The user asks: ";

            $response = \Illuminate\Support\Facades\Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=" . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $context . $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                \Illuminate\Support\Facades\Log::info('Gemini Response Data', ['data' => $data]);
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            } else {
                \Illuminate\Support\Facades\Log::error('Gemini API Error: ' . $response->body());
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gemini Exception: ' . $e->getMessage());
        }

        return null;
    }

    public function getMessages(Request $request)
    {
        $sessionId = $request->cookie('chat_session_id') ?? $request->input('session_id');
        $lastId = $request->input('last_id', 0);

        if (!$sessionId) {
            return response()->json(['messages' => []]);
        }

        $session = ChatSession::where('session_id', $sessionId)->first();
        if (!$session) {
            return response()->json(['messages' => []]);
        }

        $messages = $session->messages()
            ->where('id', '>', $lastId)
            ->where('sender', 'admin')
            ->where('is_read', false)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'sender' => $msg->sender,
                    'time' => $msg->created_at->format('h:i A'),
                ];
            });

        if ($messages->count() > 0) {
            $session->messages()
                ->where('sender', 'admin')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json(['messages' => $messages]);
    }

    public function submitDetails(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'requirement' => 'required|string|max:1000',
        ]);

        $sessionId = $request->cookie('chat_session_id') ?? $request->input('session_id');

        if (!$sessionId) {
            return response()->json(['error' => 'No active session'], 400);
        }

        $session = ChatSession::where('session_id', $sessionId)->first();
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $name = $request->input('name') ? strip_tags($request->input('name')) : 'Visitor';
        $email = $request->input('email') ? strip_tags($request->input('email')) : null;

        $session->update([
            'visitor_name' => $name,
            'visitor_email' => $email,
            'last_message_at' => now(),
            'status' => 'active',
        ]);

        // Create the user message containing the details
        $detailsMessage = "Name: " . ($request->input('name') ? strip_tags($request->input('name')) : 'Not provided') . "\n";
        $detailsMessage .= "Email: " . ($request->input('email') ? strip_tags($request->input('email')) : 'Not provided') . "\n";
        $detailsMessage .= "Phone: " . ($request->input('phone') ? strip_tags($request->input('phone')) : 'Not provided') . "\n";
        $detailsMessage .= "Requirement: " . ($request->input('requirement') ? strip_tags($request->input('requirement')) : 'Not provided');

        $msg = ChatMessage::create([
            'chat_session_id' => $session->id,
            'message' => $detailsMessage,
            'sender' => 'visitor',
            'is_read' => false,
        ]);

        // Send Email Notification
        $this->sendEmailNotification($msg, $session);

        // Auto reply
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'message' => 'Thank you for sharing your details. Our executive will connect with you shortly.',
            'sender' => 'admin',
            'is_read' => false,
        ]);

        return response()->json([
            'session_id' => $sessionId,
            'success' => true
        ])->cookie('chat_session_id', $sessionId, 60 * 24 * 30);
    }
}
