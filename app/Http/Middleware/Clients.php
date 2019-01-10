<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::guest()) {
            return abort(404);
        }

        if (Auth::user()->is_ban) {
            echo 'contact the administrator';
            exit();
        }



        // if (!Auth::user()) {
        //    return redirect()->guest('/login');
        // }
        //  echo Auth::user()->type;
         
        return $next($request);
    }
}
