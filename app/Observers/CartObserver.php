<?php

namespace App\Observers;

use App\Models\Carts;

use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the cart "creating" event.
     *
     * @param  \App\Models\cart\  $cart
     * @return void
     */
    public function creating(Carts $cart)
    {
        //
     
    }

    /**
     * Handle the cart "updated" event.
     *
     * @param  \App\Models\cart\  $cart
     * @return void
     */
    public function updating(Carts $cart)
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     *
     * @param  \App\Models\cart\  $cart
     * @return void
     */
    public function deleting(Carts $cart)
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     *
     * @param  \App\Models\cart\  $cart
     * @return void
     */
    public function restoring(Carts $cart)
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     *
     * @param  \App\Models\cart\  $cart
     * @return void
     */
    public function forceDeleting(Carts $cart)
    {
        //
    }
}
