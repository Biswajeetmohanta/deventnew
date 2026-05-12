@extends('admin.layouts.admin')

@section('title', 'Chat with ' . ($chat->visitor_name ?? 'Visitor'))
@section('page_title', 'Chat Conversation')

@section('content')
<style>
    .chat-container {
        height: calc(100vh - 260px);
        min-height: 400px;
        display: flex;
        flex-direction: column;
    }
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        scroll-behavior: smooth;
    }
    .chat-messages::-webkit-scrollbar {
        width: 4px;
    }
    .chat-messages::-webkit-scrollbar-track {
        background: transparent;
    }
    .chat-messages::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .msg-bubble {
        max-width: 75%;
        animation: msgSlideIn 0.3s ease;
    }
    @keyframes msgSlideIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .typing-indicator span {
        animation: typingBounce 1.4s infinite;
        display: inline-block;
        width: 6px;
        height: 6px;
        background: #94a3b8;
        border-radius: 50%;
        margin: 0 1px;
    }
    .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
    .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-5px); }
    }
</style>

<div class="space-y-4">
    <!-- Header Bar -->
    <div class="glass rounded-2xl p-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.chats.index') }}" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="relative">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    {{ strtoupper(substr($chat->visitor_name ?? 'V', 0, 1)) }}
                </div>
                @if($chat->status === 'active')
                    <div class="absolute -bottom-0.5 -right-0.5 w-4 h-4 bg-emerald-500 rounded-full border-2 border-white"></div>
                @endif
            </div>
            <div>
                <h3 class="text-sm font-bold text-slate-800">{{ $chat->visitor_name ?? 'Visitor' }}</h3>
                <p class="text-xs text-slate-400">
                    @if($chat->visitor_email)
                        {{ $chat->visitor_email }} · 
                    @endif
                    Session: {{ Str::limit($chat->session_id, 12) }} · 
                    <span class="inline-flex items-center gap-1">
                        @if($chat->status === 'active')
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Online
                        @else
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Closed
                        @endif
                    </span>
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            @if($chat->status === 'active')
                <form action="{{ route('admin.chats.close', $chat->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-red-500 bg-red-50 hover:bg-red-100 transition-all" onclick="return confirm('Close this conversation?')">
                        <i class="fa-solid fa-xmark mr-1"></i> Close Chat
                    </button>
                </form>
            @else
                <span class="px-4 py-2 rounded-xl text-xs font-bold text-slate-400 bg-slate-50">
                    <i class="fa-solid fa-lock mr-1"></i> Closed
                </span>
            @endif
        </div>
    </div>

    <!-- Chat Window -->
    <div class="glass rounded-2xl overflow-hidden chat-container">
        <!-- Messages Area -->
        <div class="chat-messages p-6 space-y-4" id="chatMessages">
            @foreach($chat->messages as $msg)
                <div class="flex {{ $msg->sender === 'admin' ? 'justify-end' : 'justify-start' }}">
                    <div class="msg-bubble {{ $msg->sender === 'admin' ? 'bg-blue-600 text-white rounded-2xl rounded-br-sm' : 'bg-slate-100 text-slate-800 rounded-2xl rounded-bl-sm' }} px-4 py-3 shadow-sm">
                        <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
                        <p class="text-[10px] mt-1.5 {{ $msg->sender === 'admin' ? 'text-blue-200' : 'text-slate-400' }} flex items-center gap-1">
                            {{ $msg->created_at->format('h:i A') }}
                            @if($msg->sender === 'admin')
                                @if($msg->is_read)
                                    <i class="fa-solid fa-check-double text-blue-200"></i>
                                @else
                                    <i class="fa-solid fa-check text-blue-300"></i>
                                @endif
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach

            <!-- Typing Indicator (hidden by default) -->
            <div class="flex justify-start hidden" id="typingIndicator">
                <div class="bg-slate-100 rounded-2xl rounded-bl-sm px-4 py-3">
                    <div class="typing-indicator flex items-center gap-0.5">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reply Input -->
        @if($chat->status === 'active')
            <div class="p-4 border-t border-slate-100 bg-white">
                <form id="replyForm" class="flex items-center gap-3">
                    <div class="flex-1 relative">
                        <input type="text" id="replyInput" placeholder="Type your reply..." 
                               class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all"
                               autocomplete="off">
                    </div>
                    <button type="submit" id="sendBtn" 
                            class="w-12 h-12 rounded-xl bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-all shadow-lg shadow-blue-200 hover:shadow-blue-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fa-solid fa-paper-plane text-sm"></i>
                    </button>
                </form>
            </div>
        @else
            <div class="p-4 border-t border-slate-100 bg-slate-50 text-center">
                <p class="text-sm text-slate-400 font-medium">
                    <i class="fa-solid fa-lock mr-1"></i> This conversation has been closed.
                </p>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chatMessages');
    const replyForm = document.getElementById('replyForm');
    const replyInput = document.getElementById('replyInput');
    const sendBtn = document.getElementById('sendBtn');
    const typingIndicator = document.getElementById('typingIndicator');
    const chatId = {{ $chat->id }};
    let lastMessageId = {{ $chat->messages->last() ? $chat->messages->last()->id : 0 }};
    let isSending = false;

    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    // Scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    scrollToBottom();

    // Add message to chat
    function addMessage(msg) {
        typingIndicator.classList.add('hidden');
        
        const isAdmin = msg.sender === 'admin';
        const wrapper = document.createElement('div');
        wrapper.className = `flex ${isAdmin ? 'justify-end' : 'justify-start'}`;
        wrapper.innerHTML = `
            <div class="msg-bubble ${isAdmin ? 'bg-blue-600 text-white rounded-2xl rounded-br-sm' : 'bg-slate-100 text-slate-800 rounded-2xl rounded-bl-sm'} px-4 py-3 shadow-sm">
                <p class="text-sm leading-relaxed">${escapeHtml(msg.message)}</p>
                <p class="text-[10px] mt-1.5 ${isAdmin ? 'text-blue-200' : 'text-slate-400'}">${msg.time}</p>
            </div>
        `;
        chatMessages.insertBefore(wrapper, typingIndicator);
        scrollToBottom();

        if (!isAdmin) {
            // Play notification sound
            try {
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.frequency.value = 800;
                gain.gain.value = 0.1;
                osc.start();
                osc.stop(audioCtx.currentTime + 0.15);
            } catch(e) {}
        }
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Send reply
    if (replyForm) {
        replyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = replyInput.value.trim();
            if (!message || isSending) return;

            isSending = true;
            sendBtn.disabled = true;

            fetch(`{{ url('/admin/chats') }}/${chatId}/reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message: message })
            })
            .then(res => res.json())
            .then(data => {
                addMessage(data);
                lastMessageId = Math.max(lastMessageId, data.id);
                replyInput.value = '';
            })
            .catch(err => console.error('Send error:', err))
            .finally(() => {
                isSending = false;
                sendBtn.disabled = false;
                replyInput.focus();
            });
        });
    }

    // Poll for new visitor messages
    @if($chat->status === 'active')
    setInterval(function() {
        fetch(`{{ url('/admin/chats') }}/${chatId}/poll?last_id=${lastMessageId}`, {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(function(msg) {
                    addMessage(msg);
                    lastMessageId = Math.max(lastMessageId, msg.id);
                });
            }
        })
        .catch(err => console.error('Poll error:', err));
    }, 3000);
    @endif

    // Enter key to send
    if (replyInput) {
        replyInput.focus();
    }
});
</script>
@endsection
