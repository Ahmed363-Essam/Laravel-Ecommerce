<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;


use App\Observers\CartObserver1;

class Carts extends Model
{
    use HasFactory;


    protected $fillable = [
       'id', 'cookie_id', 'user_id', 'product_id', 'quantity', 'options',
    ];


   public static function booted()
    {
        static::observe(CartObserver1::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
