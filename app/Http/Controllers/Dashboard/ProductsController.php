<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;


use App\Models\Products;
use App\Models\Categories;

use App\Models\tages;

use Illuminate\Support\Str;
//use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // get all categories from data base

       // return auth('admin')->user()->store_id;
       // $products = Products::with(['cats1','store'])->where('store_id',auth('admin')->user()->store_id)->paginate(15); // get All data that hasnot deleted

        $products = Products::with(['cats1','store'])->paginate(15);

        return view('dashboard.products.index',compact('products')); // rturn categories to index page
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try {

            $categories = Categories::all();

            return view('dashboard.products.create',compact('categories'));
        } catch (\Throwable $th) {
            //throw $th;
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
           $products = Products::findorfail($id);

           $tages =  $products->tages;



           return view('dashboard.products.show',compact('products','tages'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        try {
            //code...

            $products = Products::findOrfail($id);

            $categories = Categories::all();

            $tages =  implode(',',$products->tages()->pluck('name')->toArray());

            
   

            return view('dashboard.products.edit',compact('products','categories','tages'));

        } 
        catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

        try {
     
           $product = Products::findOrfail($id);
           
           //$product->update($request->except('tags'));


           $tags = explode(',',$request->tags);  // ahmed,mohamed, omar => explode ['ahmed','mohamed','omar']

           $tags2 =  json_decode($request->tags);

           $tags_id = [];
          


           foreach($tags2 as $key)
           {


                $slug = Str::slug($key->value); // value

            
                $tag = tages::where('slug',$slug)->first(); 

               if(!$tag)
                {
                  $tagid =   tages::create([
                        'name'=>$key->value,  // value
                        'slug'=>$slug
                    ]);
                }

                $tags_id[] = $tagid->id;

                $product->tages()->sync($tags_id);

   
     

           }


           return redirect()->route('products.index')->with(['info' => ' The Product updated Succesfully ']);;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        try {

                $Products = Products::where('id',$id)->first();

                if($Products)
                {
                    $Products->delete();
                    
    
                    return redirect()->route('products.index')->with(['danger' => ' The products deleted Succesfully ']);
                }
     
/*
            if($checkExist->count() !=0)
            {
                return 'cannot delete';
            }else
            {
                return 'delete';
            }

*/
         
        } catch (\Exception $e) {
            //throw $th;

            return $e->getMessage();
        }
    }



    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
              
        // get All trashed Products that deleted from view but exists in database

        $products  = Products::onlyTrashed()->paginate();

        return view('dashboard.products.trashed',compact('products')); // rturn Products to index page
    }



    public function force(Request $request)
    {
        
        $products = Products::onlyTrashed()->findOrFail($request->id);
        $products->forceDelete();
        return redirect()->route('products.index')->with(['danger' => ' The Products deleted Succesfully ']);

    }


    public function restore(Request $request)
    {

        $products = Products::onlyTrashed()->findOrFail($request->id);
        $products->restore();
        return redirect()->route('products.index')->with(['success' => ' The Producrs Restored Succesfully ']);

    }
}
