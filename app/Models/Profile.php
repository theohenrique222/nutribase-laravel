<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
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
    ];
}
