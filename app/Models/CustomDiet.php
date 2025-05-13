<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomDiet extends Model
{
    protected $fillable = [
        'meals'
    ];
    protected $casts = [
        'meals' => 'array',
    ];
}
