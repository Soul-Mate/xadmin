<?php

namespace Admin\Middleware;


/*
* 
* name AdminGuest.php
* author Yuanchang
* date ${DATA}
*/

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminGuestMiddleware
{
    public function handle(Request $request,Closure $next, ...$excepts)
    {
        if (Auth::guard('admin')->check()) {
            return redirect(route('admin'));
        }
        return $next($request);
    }
}