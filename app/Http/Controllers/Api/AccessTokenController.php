<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AccessTokenController extends Controller
{
    //

    public function store(Request $request)
    {
        try {
         

             $user =   User::where('email',$request->email)->first();


          
             if($user && Hash::check( $request->password , $user->password ))
             {
         
                $device_name = $request->post('device_name', $request->userAgent());
                $token = $user->createToken($device_name, $request->post('abilities'));

                return Response::json([
                    'code' => 1,
                    'token' => $token->plainTextToken,
                    'user' => $user,
                ], 201);
             }
             else
             {
                return 123456;
             }

            // $user = auth()->user();

            



        } catch (\Exception $e) {
            //throw $th;

            return $e->getMessage();
        }
    }




    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();


        // Revoke all tokens
        // $user->tokens()->delete();

        if (null === $token) {
            $user->currentAccessToken()->delete();
            return;
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);
        if (
            $user->id == $personalAccessToken->tokenable_id 
            && get_class($user) == $personalAccessToken->tokenable_type
        ) {
            $personalAccessToken->delete();
        }
    }
}
