<?php

namespace Admin\Middleware;

/*
* name MenuMiddleware.php
* user Yuanchang.xu
* date 2017/4/28
*/

use Closure;
use Admin\Traits\AdminAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class MenuMiddleware
{
    use AdminAuth;

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        if (!$user) return redirect(route('admin.login'));
        $menus = $user->userMenus();
        $request->attributes->set("permissions", self::buildPermissionTree($menus));
        return $next($request);

    }

    private static function buildPermissionTree(array $menus): string
    {
        $html = "";
        $currentRouteName = Route::currentRouteName();

        if (strpos($currentRouteName, ".")) {
            $currentRouteNamePrefix = substr($currentRouteName, 0, strpos($currentRouteName, "."));
        } else {
            $currentRouteNamePrefix = substr($currentRouteName, 0);
        }

        foreach ($menus as $index => $permission) {

            if (strpos($permission["uri"], $currentRouteNamePrefix) !== false)
                $html .= '<li class="active">';
            else
                $html .= '<li>';

            $html .= '<a href="#">';
            $html .= '<i class="fa ' . $permission["icon"] . '"></i>';
            $html .= '<span>' . $permission["name"] . '</span>';
            $html .= '<i class="fa fa-angle-left pull-right"></i>';
            $html .= '</a>';
            $html .= '<ul class="treeview-menu">';

            if (!empty($permission["child"])) {
                foreach ($permission["child"] as $c) {
                    if (strpos($c["uri"], $currentRouteNamePrefix) !== false)
                        $html .= '<li class="active">';
                    else
                        $html .= '<li>';
                    $html .= '<a href="' . URL::route($c["uri"]) . '">';
                    $html .= '<i class="fa ' . $c["icon"] . '"></i>';
                    $html .= '<span>' . $c["name"] . '</span>';
                    $html .= '</a>';
                    $html .= '</li>';
                }
            }
            $html .= '</ul>';
            $html .= '</li>';
        }
        return $html;
    }
}