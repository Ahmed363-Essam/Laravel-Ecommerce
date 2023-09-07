<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Products;
use Illuminate\Notifications\Notifiable;

class Stores extends Model
{
    use HasFactory , Notifiable;


    public function stores()
    {
        return $this->hasMany(Products::class,'store_id','id');
    }
}
