<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Events\DeliveryLocationUpdated;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{

    public function show($id)
    {
        $delivery = Delivery::query()->select([ 
            'id',
            'order_id',
            'status',
            DB::raw('ST_Y(current_location) AS lat' ),
            DB::raw('ST_X(current_location) AS lng' ),
         ])->where('id',$id)->first();

         

         return $delivery;


        
    }
    //
    public function update(Request $request ,Delivery $delivery )
    {
      
        $request->validate([
            'lng' => ['required', 'numeric'],
            'lat' => ['required', 'numeric'],
        ]);

        $delivery->update([
            'current_location'=> DB::raw("POINT($request->lng ,$request->lat)")
        ]);

        event(new DeliveryLocationUpdated($delivery,$request->lng ,$request->lat));

        return $delivery;
    }
}
