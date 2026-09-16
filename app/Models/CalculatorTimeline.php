<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorTimeline extends Model
{
    protected $fillable = [
        'key',
        'name',
        'duration',
        'multiplier',
    ];

    protected $casts = [
        'multiplier' => 'float',
    ];
}
