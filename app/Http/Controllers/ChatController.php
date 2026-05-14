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

            // Send welcome message
            ChatMessage::create([
                'chat_session_id' => $session->id,
                'message' => 'Hi! Welcome to Devent Technology. How can we help you today?',
                'sender' => 'admin',
                'is_read' => false,
            ]);

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
        $recentAdminMsg = ChatMessage::where('chat_session_id', $session->id)
            ->where('sender', 'admin')
            ->where('created_at', '>=', now()->subSeconds(2))
            ->exists();
            
        if ($recentAdminMsg) {
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
                if (stripos($msg->message, $keyword->keyword) !== false) {
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
                $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = \App\Models\Setting::where('key', 'mail_host')->value('value') ?? 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = \App\Models\Setting::where('key', 'mail_username')->value('value') ?? 'perfectpicels@gmail.com';
                $mail->Password   = \App\Models\Setting::where('key', 'mail_password')->value('value') ?? 'ewshzqepcqlzhwrk';
                $mail->SMTPSecure = \App\Models\Setting::where('key', 'mail_encryption')->value('value') ?? 'ssl';
                $mail->Port       = \App\Models\Setting::where('key', 'mail_port')->value('value') ?? 465;

                $fromAddress = \App\Models\Setting::where('key', 'mail_from_address')->value('value') ?? 'perfectpicels@gmail.com';
                $siteName = \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Devent Chatbot';
                $mail->setFrom($fromAddress, $siteName);
                $mail->addAddress($notifyEmail);

                $mail->isHTML(true);
                $mail->Subject = 'New Message from Website Chatbot';
                $html = view('emails.chat_notification', ['chatMessage' => $msg, 'chatSession' => $session])->render();
                $mail->Body = $html;
                $mail->send();
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Chatbot PHPMailer Error: ' . $e->getMessage());
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
}
