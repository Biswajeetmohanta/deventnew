<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatAutoReply extends Model
{
    protected $fillable = ['keyword', 'reply', 'is_active'];
}
