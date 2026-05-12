<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = ['title', 'slug', 'icon', 'image', 'description', 'content_data'];

    protected $casts = [
        'content_data' => 'array',
    ];
}
