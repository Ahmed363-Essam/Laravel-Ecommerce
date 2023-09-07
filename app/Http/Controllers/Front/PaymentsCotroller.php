<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Support\Facades\Config;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Database\QueryException;

class PaymentsCotroller extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(order $order)
    {
        //
        return view('front.payment.create', [
            'order' => $order
        ]);
    }


    public function CreateStripePaymentIntent(order $order)
    {
        $amount = $order->items->sum(function ($item) {

            return $item->price * $item->quantity;
        });

        $stripe = new \Stripe\StripeClient(
            Config::get('services.stripe.secret_key')
        );
        $paymentIntent =$stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }




    public function confirm(Request $request, order $order)
    {
        
        /**
         * @var \Stripe\StripeClient
         */


        
         $stripe = new \Stripe\StripeClient(
            Config::get('services.stripe.secret_key')
          );
          $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->payment_intent,
            []
          );




          if($paymentIntent->status == 'succeeded')
          {
            $payment = new Payment();


            $payment->forceFill([
                'order_id'=>$order->id,
                'amount'=>$paymentIntent->amount,
                'currency'=>$paymentIntent->currency,
                'status'=>'completed' ,
                'method'=>'stripe',
                'transaction_id'=>$paymentIntent->id,
                'transaction_data'=>json_encode($paymentIntent)
            ])->save();

          }
        // dd($paymentIntent);

        return redirect()->route('home');

        
    }

    
}
