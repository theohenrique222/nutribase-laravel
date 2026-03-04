<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    protected $fillable = [
        'user_id',
        'tmb',
        'proteins',
        'carbohydrates',
        'fat',
        'water_intake',
        'imc',
    ];
}
