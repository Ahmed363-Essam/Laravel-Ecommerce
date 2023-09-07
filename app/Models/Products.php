<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\tages;
use App\Models\Stores;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Str;

use App\Models\Categories;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function cats1()
    {
        return $this->belongsTo(Categories::class, 'cat_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id', 'id');
    }


    public function tages()
    {
        return $this->belongsToMany(tages::class, 'product_tages_table', 'product_id', 'tag_id');
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
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

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        } else {
            return round(100 - (100 * $this->price / $this->compare_price), 1);
        }
    }



    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'cat_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filters);

        $builder->when($options['status'], function ($query, $status) {
            return $query->where('status', $status);
        });

        $builder->when($options['store_id'], function($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options['cat_id'], function($builder, $value) {
            $builder->where('cat_id', $value);
        });
        $builder->when($options['tag_id'], function($builder, $value) {

            $builder->whereExists(function($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id', $value);
            });
            // $builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)', [$value]);
            // $builder->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id = products.id)', [$value]);
            
            // $builder->whereHas('tags', function($builder) use ($value) {
            //     $builder->where('id', $value);
            // });
        });
    }



    public function getImageAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'assets/product/'. $value.'/'.$value);
    }
}
