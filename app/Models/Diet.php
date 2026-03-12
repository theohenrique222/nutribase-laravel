<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    protected $casts = [
        'meals' => 'array',
    ];
    protected $fillable = [
        'student_id',
        'coach_id',
        'objective',
        'calories',
        'meals',
        'food',
        'quantity',
        'observation',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function coach()
    {
        return $this->hasOne(Coach::class);
    }
//    public function foods()
//    {
//        return $this->belongsToMany(Food::class)->withPivot('meal_number', 'quantity', 'observation');
//    }
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'diet_food')
            ->withPivot('meal_number', 'quantity', 'observation');
    }

}
