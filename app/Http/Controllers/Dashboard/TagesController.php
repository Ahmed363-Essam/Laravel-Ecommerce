<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\tages;
use Illuminate\Http\Request;

class TagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
           
           $tags = tages::all();

            return view('dashboard.tags.index',compact('tags'));
        } catch (\Throwable $th) {
            //throw $th;
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tages  $tages
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        try {
            
            $products = tages::findOrFail($id)->products;


            $tags = tages::findOrFail($id);

            return view('dashboard.tags.ProductsTag',compact('products','tags'));
    
        } catch (\Throwable $th) {
            //throw $th;
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tages  $tages
     * @return \Illuminate\Http\Response
     */
    public function edit(tages $tages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tages  $tages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tages $tages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tages  $tages
     * @return \Illuminate\Http\Response
     */
    public function destroy(tages $tages)
    {
        //
    }
}
