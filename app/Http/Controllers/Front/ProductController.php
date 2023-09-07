<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
class ProductController extends Controller
{
    //

    public function index()
    {
    
        $products = Products::get();

        

        return view('front.products.products',compact('products'));
    }
    public function show($id)
    {
        try {
         
            $product = Products::FindOrFail($id);

            if($product->status !='active')
            {
                abort(404);
            }
            return view('front.products.show',compact('product'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
