<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = ['session_id', 'visitor_name', 'visitor_email', 'status', 'is_read', 'last_message_at'];

    protected $casts = [
        'is_read' => 'boolean',
        'last_message_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class)->latest();
    }

    public function unreadMessages()
    {
        return $this->hasMany(ChatMessage::class)->where('sender', 'visitor')->where('is_read', false);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
