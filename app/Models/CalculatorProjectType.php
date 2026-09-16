<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorProjectType extends Model
{
    protected $fillable = [
        'key',
        'name',
        'min_price',
        'max_price',
        'icon',
        'description',
    ];

    protected $casts = [
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
    ];
}
