<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diet extends Model
{
    protected $fillable = [
        'name',
        'client_id'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'diet_product')->withPivot('quantity', 'observation');
    }

}
