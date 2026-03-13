<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'coach_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
    public function diet()
    {
        return $this->hasOne(Diet::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
