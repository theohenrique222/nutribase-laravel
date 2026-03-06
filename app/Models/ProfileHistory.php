<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileHistory extends Model
{
    protected $fillable = [
        'profile_id',
        'user_id',
        'title',
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
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
