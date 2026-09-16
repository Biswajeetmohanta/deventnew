<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorComplexity extends Model
{
    protected $fillable = [
        'key',
        'name',
        'multiplier',
        'description',
    ];

    protected $casts = [
        'multiplier' => 'float',
    ];
}
