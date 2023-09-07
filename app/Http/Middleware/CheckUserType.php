<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

    
/*
        if (auth('web')->user()->type == 'user') {
            return 'user';
        } elseif (auth('web')->user()->type == 'admin') {
            return 'admin';
        } else {
            return 'super admin';
        }
*/
        $user = $request->user();  // user model

        if(!$user)
        {
            return redirect()->route('login');  
        }
   
        
        if(!in_array($user->type,['admin','super-admin']))
        {
            abort(403);
        }
        
        return $next($request);
    }
}
