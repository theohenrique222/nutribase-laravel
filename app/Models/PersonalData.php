<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'gender',
        'age',
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

    protected $appends = ['created_at_formatted'];
    
    public function getCreatedAtFormattedAttribute() 
    { 
        return $this->created_at?->format('d/m/Y'); 
    }
}
