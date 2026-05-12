@extends('admin.layouts.admin')

@section('title', 'Live Chat')
@section('page_title', 'Live Chat')

@section('content')
<div class="space-y-6">
    <!-- Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="glass rounded-2xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                <i class="fa-solid fa-comments text-blue-600 text-lg"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $chats->count() }}</p>
                <p class="text-xs text-slate-500 font-medium">Total Chats</p>
            </div>
        </div>
        <div class="glass rounded-2xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $chats->where('status', 'active')->count() }}</p>
                <p class="text-xs text-slate-500 font-medium">Active Chats</p>
            </div>
        </div>
        <div class="glass rounded-2xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                <i class="fa-solid fa-bell text-amber-600 text-lg"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $chats->sum('unread_messages_count') }}</p>
                <p class="text-xs text-slate-500 font-medium">Unread Messages</p>
            </div>
        </div>
    </div>

    <!-- Chat List -->
    <div class="glass rounded-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-800">
                <i class="fa-solid fa-inbox mr-2 text-amber-500"></i> All Conversations
            </h3>
        </div>

        @if($chats->isEmpty())
            <div class="p-12 text-center">
                <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-regular fa-comment-dots text-3xl text-slate-300"></i>
                </div>
                <p class="text-slate-500 font-medium">No conversations yet.</p>
                <p class="text-slate-400 text-sm mt-1">Chat messages from visitors will appear here.</p>
            </div>
        @else
            <div class="divide-y divide-slate-50">
                @foreach($chats as $chat)
                    <a href="{{ route('admin.chats.show', $chat->id) }}" 
                       class="flex items-center gap-4 p-5 hover:bg-amber-50/30 transition-all group {{ !$chat->is_read ? 'bg-blue-50/30' : '' }}">
                        
                        <!-- Avatar -->
                        <div class="relative flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $chat->status === 'active' ? 'from-blue-500 to-indigo-600' : 'from-slate-400 to-slate-500' }} flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                {{ strtoupper(substr($chat->visitor_name ?? 'V', 0, 1)) }}
                            </div>
                            @if($chat->status === 'active')
                                <div class="absolute -bottom-0.5 -right-0.5 w-4 h-4 bg-emerald-500 rounded-full border-2 border-white"></div>
                            @endif
                        </div>

                        <!-- Chat Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="text-sm font-bold text-slate-800 group-hover:text-amber-700 transition-colors">
                                    {{ $chat->visitor_name ?? 'Visitor' }}
                                    @if($chat->visitor_email)
                                        <span class="text-xs font-normal text-slate-400 ml-1">({{ $chat->visitor_email }})</span>
                                    @endif
                                </h4>
                                <span class="text-xs text-slate-400 font-medium flex-shrink-0 ml-2">
                                    {{ $chat->last_message_at ? $chat->last_message_at->diffForHumans() : $chat->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-slate-500 truncate max-w-md">
                                    @if($chat->latestMessage)
                                        @if($chat->latestMessage->sender === 'admin')
                                            <span class="text-blue-500 font-medium">You: </span>
                                        @endif
                                        {{ Str::limit($chat->latestMessage->message, 60) }}
                                    @else
                                        <span class="italic text-slate-400">No messages yet</span>
                                    @endif
                                </p>
                                <div class="flex items-center gap-2 flex-shrink-0 ml-2">
                                    @if($chat->unread_messages_count > 0)
                                        <span class="w-6 h-6 rounded-full bg-blue-600 text-white text-[10px] font-bold flex items-center justify-center shadow-sm">
                                            {{ $chat->unread_messages_count }}
                                        </span>
                                    @endif
                                    <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-full {{ $chat->status === 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-400' }}">
                                        {{ $chat->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow -->
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300 group-hover:text-amber-500 transition-colors flex-shrink-0"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
