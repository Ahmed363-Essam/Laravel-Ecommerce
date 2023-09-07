<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Products;
use App\Repository\cart\CartModelRepository;
use Illuminate\Support\Facades\DB;
use App\Facades\cartFacade;
class DebuctProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */

 
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($items)
    {
        //
        foreach(cartFacade::get() as $item)
        {

            

            products::where('id',$item->product_id)->update([
                'quantity'=> DB::raw("quantity - {$item->quantity}")
            ]);
        }

    }
}
