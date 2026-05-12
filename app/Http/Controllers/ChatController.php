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

        // Rate limiting: 1 message per second
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

        return response()->json([
            'id' => $msg->id,
            'message' => $msg->message,
            'sender' => $msg->sender,
            'time' => $msg->created_at->format('h:i A'),
        ]);
    }

    /**
     * Poll for new messages (visitor side).
     */
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

        // Mark admin messages as read
        if ($messages->count() > 0) {
            $session->messages()
                ->where('sender', 'admin')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json(['messages' => $messages]);
    }
}
