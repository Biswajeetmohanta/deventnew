<?php

namespace App\Mail;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChatMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $chatMessage;
    public $chatSession;

    /**
     * Create a new message instance.
     */
    public function __construct(ChatMessage $chatMessage, ChatSession $chatSession)
    {
        $this->chatMessage = $chatMessage;
        $this->chatSession = $chatSession;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Message from Website Chatbot')
                    ->view('emails.chat_notification');
    }
}
