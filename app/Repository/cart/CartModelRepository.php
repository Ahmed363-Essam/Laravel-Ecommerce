<?php

namespace App\Repository\cart;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Carts;
use Illuminate\Support\Str;
use App\Models\Products;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Cookie;

class CartModelRepository implements CartRepository
{
    public $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get() : Collection
    {

        if(!$this->items->count())
        {
            $this->items = Carts::with('product')->where('cookie_id',$this->getCookieId())->get();
        }

        return $this->items;

       
        //return Carts::where('cookie_id',$this->getCookieId())->get() ;

       // return Carts::with(['product'])->get();
    }

    public function add(Products $Products,$quantity=1) 
    {
        $item = Carts::where('cookie_id',$this->getCookieId())->where('product_id',$Products->id)->first();

        if(!$item)
        {
            $cart=  Carts::create([
                'cookie_id'=>$this->getCookieId(),
                'user_id'=>Auth::id(),
                'product_id'=>$Products->id,
                'quantity'=>$quantity,
            ]);

            $this->get()->push($cart);

            return $cart;
        }

         return $item->increment('quantity',$quantity);

    }

    public function update($id , $quantity)
    {

        Carts::where('product_id',$id)->where('cookie_id',$this->getCookieId())->first()->update([
            'quantity'=>$quantity
        ]);
    }

    public function delete($id)
    {
        Carts::where('product_id',$id)->where('cookie_id',$this->getCookieId())->first()->delete();
    }

    public function empty()
    {
        Carts::where('cookie_id',$this->getCookieId())->delete();
    }

    public function total() : float{

        /*return (float) Carts::join('products', 'products.id', '=', 'carts.product_id')
        ->selectRaw('SUM(products.price * carts.quantity) as total')
        ->value('total');*/

    
        return $this->get()->sum(function($item)
        {
            return $item->quantity * $item->product->price;
        });


    }

    public function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id)
        {
           $cookie_id = Str::uuid();
            Cookie::queue('cart_id',$cookie_id,30*24*60);
        }
        return $cookie_id;
    }
}


