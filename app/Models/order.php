<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Observers\OrderObserver;
use App\Models\orderItem;
use App\Models\Delivery;

use App\Models\orderAddress;

use App\Models\Products;
use Illuminate\Notifications\Notifiable;

class order extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'store_id', 'user_id', 'payment_method', 'status', 'payment_status','shipping',	'tax',	'discount',	'total'	
    ];

    public function store()
    {
        return $this->belongsTo(Stores::class,'store_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault([
            'name' => 'Guest Customer'
        ]);
    }


    public function products()
    {
        return $this->belongsToMany(Products::class,orderItem::class,'order_id','product_id','id','id');
      //  ->withPivot('product_name','price','quantity','options');
        
    }

    public function items()
    {
        return $this->hasMany(orderItem::class, 'order_id');
    }


    public function addrress()
    {
        return $this->hasMany(orderAddress::class,'order_id');
    }

    public function billingAddress() 
    {
        return $this->hasOne(orderAddress::class,'order_id')->with('type','=','billing');
    }

    public function shipingAddress()
    {
        return $this->hasOne(orderAddress::class,'order_id')->with('type','=','shipping');
    }

    public static function booted()
    {
        static::creating(function(order $order)
        {
            // 20230001 - 20230002 - 20230003
            $order->number = $order->getNextOrderNumber();
        });

       // order::observe(OrderObserver::class);
     /*   static::created(function(order $order)
        {
         
        });*/


    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class,'order_id');
    }

  
    public static function  getNextOrderNumber()
    {
        $year = Carbon::now()->year; /// get year from order table 2023

        $number = order::whereYear('created_at', $year)->max('number');
        if($number)
        {
            return $number+1;
        }
        return $year .'0001'; 

    } 

}
