<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'portion_unit',
        'observation'
    ];

    public function products() 
    {
        return $this->belongsTo(Diet::class);
    }
}
