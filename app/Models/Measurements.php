<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurements extends Model
{
    protected $fillable = [
        'student_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function history()
    {
        return $this->belongsToMany(MeasurementsHistory::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
