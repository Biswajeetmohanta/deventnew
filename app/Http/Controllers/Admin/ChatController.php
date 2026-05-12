<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * List all chat sessions.
     */
    public function index()
    {
        $chats = ChatSession::withCount(['unreadMessages'])
            ->with('latestMessage')
            ->orderByDesc('last_message_at')
            ->get();

        return view('admin.chats.index', compact('chats'));
    }

    /**
     * Show a specific chat conversation.
     */
    public function show($id)
    {
        $chat = ChatSession::with(['messages' => function ($q) {
            $q->orderBy('created_at', 'asc');
        }])->findOrFail($id);

        // Mark all visitor messages as read
        $chat->messages()->where('sender', 'visitor')->where('is_read', false)->update(['is_read' => true]);
        $chat->update(['is_read' => true]);

        return view('admin.chats.show', compact('chat'));
    }

    /**
     * Admin sends a reply.
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $chat = ChatSession::findOrFail($id);

        $msg = ChatMessage::create([
            'chat_session_id' => $chat->id,
            'message' => $request->input('message'),
            'sender' => 'admin',
            'is_read' => false,
        ]);

        $chat->update(['last_message_at' => now()]);

        return response()->json([
            'id' => $msg->id,
            'message' => $msg->message,
            'sender' => $msg->sender,
            'time' => $msg->created_at->format('h:i A'),
        ]);
    }

    /**
     * Poll for new visitor messages (admin side).
     */
    public function getNewMessages(Request $request, $id)
    {
        $lastId = $request->input('last_id', 0);
        $chat = ChatSession::findOrFail($id);

        $messages = $chat->messages()
            ->where('id', '>', $lastId)
            ->where('sender', 'visitor')
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

        // Mark as read
        if ($messages->count() > 0) {
            $chat->messages()->where('sender', 'visitor')->where('is_read', false)->update(['is_read' => true]);
            $chat->update(['is_read' => true]);
        }

        return response()->json(['messages' => $messages]);
    }

    /**
     * Close a chat session.
     */
    public function close($id)
    {
        $chat = ChatSession::findOrFail($id);
        $chat->update(['status' => 'closed']);
        return redirect()->route('admin.chats.index')->with('success', 'Chat closed successfully.');
    }

    /**
     * Get total unread chat count for admin badge.
     */
    public function getUnreadCount()
    {
        $count = ChatSession::where('is_read', false)->active()->count();
        return response()->json(['count' => $count]);
    }
}
