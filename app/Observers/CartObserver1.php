<?php

namespace App\Observers;

use App\Models\Carts;
use Illuminate\Support\Str;

class CartObserver1
{
    /**
     * Handle the Carts "created" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function creating(Carts $carts)
    {
        //
        $carts->id = Str::uuid();


    }

    /**
     * Handle the Carts "updated" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function updated(Carts $carts)
    {
        //
    }

    /**
     * Handle the Carts "deleted" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function deleted(Carts $carts)
    {
        //
    }

    /**
     * Handle the Carts "restored" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function restored(Carts $carts)
    {
        //
    }

    /**
     * Handle the Carts "force deleted" event.
     *
     * @param  \App\Models\Carts  $carts
     * @return void
     */
    public function forceDeleted(Carts $carts)
    {
        //
    }
}
