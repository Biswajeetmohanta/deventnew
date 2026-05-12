<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamRole extends Model
{
    protected $fillable = ['title', 'slug', 'icon', 'image', 'is_active', 'order', 'content_data'];

    protected $casts = [
        'content_data' => 'array',
    ];
}
