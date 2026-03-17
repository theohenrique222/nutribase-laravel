<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeasurementsHistory extends Model
{
    protected $fillable = [
        'student_id',
        'measurement_id',
        'description',
        'height',
        'weight',
        'arm_l',
        'arm_r',
        'chest',
        'waist',
        'scruff',
        'thigh_l',
        'thigh_r',
        'calf_l',
        'calf_r',
        'hip',
        'tmb',
        'water',
        'proteins',
        'carbs',
        'fat_percent'
    ];

    public function measurement()
    {
        return $this->hasOne(Measurements::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
