<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock_quantity',
        'image'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
