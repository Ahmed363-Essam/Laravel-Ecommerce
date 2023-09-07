<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //

        $user = auth('web')->user();

        $Countries = Countries::getNames();

        $Languages =  Languages::getNames();


        return view('dashboard.profile.edit',compact('user','Countries','Languages'));
    }

    public function update(Request $request)
    {
        try {




            $user = Profiles::updateOrCreate([
                'user_id'=>auth('web')->user()->id
            ],
            [   
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'birthday'=>$request->birthday,
                'gender'=>$request->gender,
                'street_address'=>$request->street_address,
                'city'=>$request->city,
                'state'=>$request->state,
                'locale'=>$request->locale,
                'country'=>$request->country
  
            ]);

            return redirect()->route('profile.edit')->with(['info' => ' The Profile  Succesfully ']);;


        } catch (\Exception $e) {
            //throw $th;

            return $e->getMessage();
        }
    }

}
