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
        // echo Auth::user()->type;
        // if (!Auth::user()) {

        // } else {
        //     if (Auth::user()->type == 'SuperAdmin' || Auth::user()->type == 'Admin' ) return redirect('/admin');
        // }
        return $next($request);
    }
}
