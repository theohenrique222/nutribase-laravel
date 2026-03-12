<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'name',
        'calories',
        'protein',
        'carbs',
        'fat',
    ];
    public function diets()
    {
        return $this->belongsToMany(Diet::class, 'create_diet_food')
        ->withPivot('meal_number','quantity','observation');
    }
    public function food()
    {
        return $this->hasMany(Food::class);
    }
}
