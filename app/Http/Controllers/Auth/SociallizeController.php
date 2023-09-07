<?php

namespace App\Http\Controllers\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SociallizeController extends Controller
{
    //

    public function redirect($provider)
    {
    
       return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $provider_user = Socialite::driver($provider)->user(); // ae676430@gmail.com

       $user = User::where([
            'provider'=>$provider,
        ])->first();


        // ahmed ae676430@gmailo.com - 

        if(!$user)
        {
           $user =  User::create([
                'provider'=>$provider,
                'provider_token'=>$provider_user->token,
                'provider_id'=>$provider_user->id,
                'email'=>$provider_user->email,
                'name'=>$provider_user->name,
                'type'=>'user',
                'lastactive'=>now(),
                'password'=> bcrypt('123456789')
            ]);
        }



        Auth::login($user);

        return redirect()->route('home');


        
    }
}
