<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = ['job_title', 'description', 'requirements', 'benefits', 'deadline', 'is_open'];

    protected $casts = [
        'deadline' => 'date',
        'is_open' => 'boolean',
    ];
}
