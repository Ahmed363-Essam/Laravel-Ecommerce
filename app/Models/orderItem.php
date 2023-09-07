<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Products;

use App\Models\order;

class orderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id',	'product_id',	'product_name'	,'price'	,'quantity',	'options'];

    public $timestamps = false;
    public function products()
    {
        return $this->belongsToMany(Products::class,'product_id')->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function order()
    {
        return $this->belongsToMany(order::class,'order_id')->withDefault([
            'name' => 'Guest Customer'
        ]);  
    }
}
