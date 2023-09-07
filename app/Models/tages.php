<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Products;

class tages extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    public function products()
    {
        return $this->belongsToMany(Products::class,'product_tages_table','product_id','tag_id');
    }
}
