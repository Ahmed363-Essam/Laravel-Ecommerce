<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoriesRequest;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        // get all categories from data base
        $categories = Categories::paginate(15); // get All data that hasnot deleted

        return view('dashboard.categories.index',compact('categories')); // rturn categories to index page
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parents = Categories::all();
        return view('dashboard.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoriesRequest $request)
    {
        //
        try {


         /*  Categories::create([
                'name'=>$request->name,
                'parent_id'=>$request->parent_id,
                'description'=>$request->description,
                'status'=>$request->status,
                'slug'=>Str::slug('aaaa')
            ]);
          */

          /*
            $category = new Categories();
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->slug = Str::slug('aaaa');

            $category->save();
           */

           $filename = '';

           if($request->hasFile('image'))
           {
               $file = $request->file('image');

               $filename = $file->getClientOriginalName();
           
           //    $file->storeAs($filename,$filename,'categories');

               $request->request->add(['image'=>$filename]);
           }

           $request->request->add(['slug'=>Str::slug('aaaa11')]);

           Categories::create($request->all());
            return redirect()->route('categories.index')->with(['success' => ' The Category Addded Succesfully ']);            
        } catch (\Exception $e) {
            //throw $th;

            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        try {
   
            $products = Products::where('cat_id',$id)->paginate('15');
            return view('dashboard.categories.show',compact('products'));

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try{
    
            $parents = Categories::where('id','!=',$id)->get();
            $categories = Categories::findOrfail($id);

            return view('dashboard.categories.edit',compact('parents','categories'));
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoriesRequest $request, $id)
    {
        //
        try {

             $category = Categories::findorfail($id);
             $oldImage = $category->image;

             if($request->hasFile('image'))
            {
                $file = $request->file('image');
 
                $filename = $file->getClientOriginalName();
 
                $file->storeAs($filename,$filename,'categories');
 
                $request->request->add(['image'=>$file->getClientOriginalName()]);
            }
            if($oldImage)
            {
                Storage::disk('public')->delete($oldImage);
            }
            $category->update($request->all());

            /* $category->update([
                'name'=>$request->name,
                'parent_id'=>$request->parent_id,
                'description'=>$request->description,
                'status'=>$request->status,
                'slug'=>Str::slug('aaaa666')
            ]);*/

            return redirect()->route('categories.index')->with(['info' => ' The Category updated Succesfully ']);

        } catch (\Exception $e) {
            //throw $th;

           return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        try {

            $checkExist = Categories::where('parent_id','!=',$id)->orWhere('parent_id',NULL)->first();

            if($checkExist)
            {
                $category = Categories::where('id',$id)->first();
                $category->delete();
                if($category->image)
                {
                   Storage::disk('categories')->delete($category->image);
                }
  
                return redirect()->route('categories.index')->with(['danger' => ' The Category deleted Succesfully ']);
            }
            else
            {
                return 'cannot delete this item because has parent';
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
              
        // get All trashed Categories that deleted from view but exists in database

        $categories = Categories::onlyTrashed()->paginate();

        return view('dashboard.categories.trashed',compact('categories')); // rturn categories to index page
    }

    public function force(Request $request)
    {
        
        $category = Categories::onlyTrashed()->findOrFail($request->id);
        $category->forceDelete();
        return redirect()->route('categories.index')->with(['danger' => ' The Category deleted Succesfully ']);

    }


    public function restore(Request $request)
    {

        $category = Categories::onlyTrashed()->findOrFail($request->id);
        $category->restore();
        return redirect()->route('categories.index')->with(['success' => ' The Category Restored Succesfully ']);

    }

}
