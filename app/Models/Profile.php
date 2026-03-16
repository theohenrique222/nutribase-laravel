<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $fillable = [
        'student_id',
        'nickname',
        'date_birth',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(ProfileHistory::class);
    }
}
