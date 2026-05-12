<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['title', 'slug', 'client', 'description', 'image', 'gallery', 'link', 'is_active'];

    protected $casts = [
        'gallery' => 'array',
    ];

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
