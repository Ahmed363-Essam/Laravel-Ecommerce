<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\order;

class DeliveryController extends Controller
{
    //

    public function show(Order $order)
    {
        $delivery = $order->delivery()->select([ 
            'id',
            'order_id',
            'status',
            DB::raw('ST_Y(current_location) AS lat' ),
            DB::raw('ST_X(current_location) AS lng' ),
         ])->first();

      
        return view('front.orders.show',compact('delivery','order'));
    }
}
