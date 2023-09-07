<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Facades\cartFacade;
use App\Repository\cart\CartModelRepository;

class EmptyCard
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct ()
    {
        //

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()  // action - reaction 
    {                               // event  - listener
        //
        cartFacade::empty();

    }
}
