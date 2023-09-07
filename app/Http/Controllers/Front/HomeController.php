<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Repository\cart\CartModelRepository;
use App\Models\Products;

class HomeController extends Controller
{
    //
   public $cart;

    public function __construct(CartModelRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {


        $cart = $this->cart;
        $Products = Products::active()->latest()->limit(8)->get();

        $cats = Categories::with(['products1'])->get();

        

        

     

        return view('front.home',compact('Products','cart','cats'));
    }
}
