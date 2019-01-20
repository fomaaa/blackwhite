<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Guest
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
    
        if (Auth::user()) {
            if(Auth::user()->type == "Girl") return redirect('/');
                
            if(Auth::user()->type == "Admin" || Auth::user()->type == 'SuperAdmin') return redirect('/admin');

        }


        return $next($request);
    }
}
