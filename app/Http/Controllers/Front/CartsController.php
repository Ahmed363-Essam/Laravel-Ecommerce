<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Carts;
use App\Models\Products;
use App\Repository\cart\CartModelRepository;

use Illuminate\Http\Request;


class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $cart;
    public function __construct(CartModelRepository $cart)
    {
        $this->cart = $cart;
    }
    public function index()
    {
        //

        $carts =  $this->cart->get();
       
        return view('front.cart.cart',[
            'carts'=>$this->cart 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $product = Products::findOrFail($request->product_id);
        $this->cart->add($product,$request->quantity);


        return redirect()->route('cart.index')->with(['success' => ' The product Addded Succesfully ']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(Carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(Carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    
     
        $this->cart->update($id,$request->quantity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $this->cart->delete($id);
    }
}
