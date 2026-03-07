<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'nickname',
        'date_birth',
        'gender'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(ProfileHistory::class);
    }
}
