<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatAutoReply;
use Illuminate\Http\Request;

class ChatAutoReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $replies = ChatAutoReply::orderBy('created_at', 'desc')->get();
        return view('admin.chat_auto_replies.index', compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chat_auto_replies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
            'reply' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        ChatAutoReply::create([
            'keyword' => $request->keyword,
            'reply' => $request->reply,
            'is_active' => $request->has('is_active') ? $request->is_active : true,
        ]);

        return redirect()->route('admin.chat-auto-replies.index')->with('success', 'Auto-reply created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reply = ChatAutoReply::findOrFail($id);
        return view('admin.chat_auto_replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
            'reply' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $reply = ChatAutoReply::findOrFail($id);
        $reply->update([
            'keyword' => $request->keyword,
            'reply' => $request->reply,
            'is_active' => $request->has('is_active') ? $request->is_active : false,
        ]);

        return redirect()->route('admin.chat-auto-replies.index')->with('success', 'Auto-reply updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reply = ChatAutoReply::findOrFail($id);
        $reply->delete();

        return redirect()->route('admin.chat-auto-replies.index')->with('success', 'Auto-reply deleted successfully.');
    }
}
