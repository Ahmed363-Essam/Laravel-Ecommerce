<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repository\cart\CartModelRepository;
use App\Models\order;
use App\Models\orderItem;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;

use App\Notifications\OrderCreatedNotification;
class CheckoutController extends Controller
{
    //
    public $item;
    public function __construct(CartModelRepository $cart)
    {
        $this->item = $cart;
    }
    public function create()
    {

        

        if($this->item->get()->count() ==0 )
        {
            return redirect()->route('home');
        }
        $cart1 = $this->item;
        $Countries = Countries::getNames();
        return view('front.cart.checkout', compact('cart1','Countries'));
    }

    public function store(Request $request)
    {
     
        DB::beginTransaction();

        try {


            $items = $this->item->get()->groupBy('product.store_id')->all();

    
            // first table

            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => auth()->user()->id,
                    'payment_method' => 'cod',
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addrress()->create($address);
                }


            }

            
            DB::commit();

         //   event('order.created',$this->item);

         event(new OrderCreated($order));


    

            
            return redirect()->route('orders.payments.create',$order->id);
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
