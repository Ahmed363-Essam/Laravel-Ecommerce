<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;




class Categories extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = [];


    public function parents()
    {
        return $this->belongsTo(Self::class,'parent_id','id')->withDefault([
            'name'=>'Annonymous'
        ]);
    }

    public function getImmageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://cellaron.net/images/category/default.png';
        }

        if (Str::startsWith($this->image, ['https://', 'http://'])) {
            # code...
            return $this->image;
        }
        if ($this->image) {
            return asset('assets/product/' . $this->image . '/' . $this->image . '');
        }
    }



    public function children()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }


    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
    }



    public function products1()
    {
        return $this->hasMany(Products::class,'cat_id','id');
    }
}
