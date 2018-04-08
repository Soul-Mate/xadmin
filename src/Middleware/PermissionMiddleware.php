<?php

namespace Admin\Middleware;

/*
* name PermissionMiddleware.php
* user Yuanchang.xu
* date 2017/4/27
*/


use Admin\Models\Auth\AdminUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();

        if ($user = Auth::guard('admin')->user()) {
            // 定义权限
            Gate::define($routeName, function (AdminUser $user) use($routeName) {
                $uriArr = array_pluck($user->userPermissions(), "uri");
                return in_array($routeName, $uriArr);
            });

            // 检测权限
            if (!Gate::forUser($user)->check($routeName)) {
                dd('处理没有权限');
            }
            return $next($request);
        }
    }
}