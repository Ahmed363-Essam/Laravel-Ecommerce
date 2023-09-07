<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //

    public function index()
    {
        $cats = Categories::get();

        return view('front.categories.index',compact('cats'));
    }

    public function ProductCategories($id)
    {
        $productsCats  = Products::where('cat_id',$id)->get();

        $cats = Categories::find($id);

        return view('front.products.index',compact('productsCats','cats'));
    }   
}
