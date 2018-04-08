<?php

namespace Admin\Middleware;

/*
* name Authenticate.php
* user Yuanchang.xu
* date 2017/4/27
*/

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminAuthenticate
{
    public function handle(Request $request,Closure $next)
    {
        if ( Auth::guard('admin')->guest() && !$this->exceptRoute())  {
            return redirect( url('admin/login') );
        }
        return $next($request);
    }

    public function exceptRoute()
    {
        $excepts = [
            url('admin/login'),
            url('admin/logout')
        ];

        foreach ($excepts as $except) {

            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ( $except == url()->current() ) {
                return true;
            }
        }
        return false;
    }
}