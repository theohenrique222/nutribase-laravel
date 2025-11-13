<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_id',
        'product',
        'quantity',
        'observation'
    ];

    public function meal()
    {
        return $this->belongsTo(Diet::class);
    }
}
