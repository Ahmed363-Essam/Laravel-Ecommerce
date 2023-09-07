<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get all products
        $products = Products::filter($request->query())
        ->with('cats1:id,name', 'store:id,name', 'tages:id,name')
        ->paginate();

        return $products;


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

        try {
            
            $product = Products::create($request->all());


            return $product;





        } catch (\Exception $e) {
            //throw $th;

            return $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Products::with('cats1:id,name', 'store:id,name', 'tages:id,name')->findorfail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
          
            $product_id = Products::where('id',$id)->first();

            $product_id->delete();
            return response([
                'status' => 200,
                'msg' => "deleted succesfully",

            ]);
        } catch (\Exception $e) {

            return response([
                'status' => 404,
                'msg' => $e->getMessage(),

            ]);
        }
    }



    public function forceDelete1(Request $request)
    {
        try {
          

        $products = Products::onlyTrashed()->findOrFail($request->id);
            $products->forceDelete();
            return response([
                'status' => 200,
                'msg' => "deleted succesfully",

            ]);
        } catch (\Exception $e) {

            return response([
                'status' => 404,
                'msg' => $e->getMessage(),

            ]);
        }
    }
}
