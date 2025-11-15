<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'name',
        'age',
        'gender',
        'weight',
        'height',
        'waist',
        'activity',
        'goal',
    ];

    public function diet() {
        return $this->hasOne(Diet::class, 'client_id');
    }
}
