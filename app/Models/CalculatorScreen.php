<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorScreen extends Model
{
    protected $fillable = [
        'key',
        'name',
        'multiplier',
    ];

    protected $casts = [
        'multiplier' => 'float',
    ];
}
