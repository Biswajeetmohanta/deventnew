<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'cta_text', 'cta_link', 'order', 'is_active'];
}
