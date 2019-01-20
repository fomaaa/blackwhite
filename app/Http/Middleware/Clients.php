<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Clients
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
             return redirect()->guest('/login');
        }


        if (Auth::user()) {
            if (Auth::user()->is_ban) {
                echo 'contact the administrator';
                return abort(404);        
            }
            
        }

        User::where('id', Auth::user()->id)->update(['last_login' =>  date("Y-m-d H:i:s")]);


        return $next($request);
         
    }
}
