<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        //
        $order = $event->order;

        $user = User::where('store_id', $order->store_id)->first();


        if($user)
        {
            $user->notify(new OrderCreatedNotification($order));
        }




        /*
        $users = User::where('store_id',$order->user_id)->get();

        foreach($users as $user)
        {
            $user->notify(new OrderCreatedNotification($order));
        }
        ==== 
        Notification::send( $users, new OrderCreatedNotification($order));
        
        */
    }
}
