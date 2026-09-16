<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorFeature extends Model
{
    protected $fillable = [
        'key',
        'name',
        'min_price',
        'max_price',
        'description',
    ];

    protected $casts = [
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
    ];
}
