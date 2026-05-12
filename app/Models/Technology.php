<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['name', 'logo', 'category', 'is_active', 'description', 'content_data'];

    protected $casts = [
        'content_data' => 'array',
    ];

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class);
    }
}
