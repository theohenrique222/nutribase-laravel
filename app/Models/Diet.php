<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    protected $fillable = [
        'student_id',
        'coach_id',
        'objective',
        'calories',
        'meals',
    ];
}
