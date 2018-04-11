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
        $current = Route::currentRouteName();
        foreach ($menus as $index => $permission) {
            if (self::matchRoute($current, $permission["uri"]))
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
                    if ($c["uri"] == $current)
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

    private static function matchRoute(string $current, string $route)
    {
        $current = explode(".", $current);
        $cnt = count($current);
        if ($cnt <= 0 || $cnt == 1) {
            return false;
        }
        $prefix = array_shift($current);
        array_pop($current);
        if (!$current)
            return starts_with($route, $prefix);
        $str = implode(".", $current);
        $pattern = '/\w+\.'.$str.'(\.\w+)+/';
        return preg_match($pattern, $route);
    }
}