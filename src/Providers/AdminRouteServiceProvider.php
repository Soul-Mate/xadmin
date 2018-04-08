<?php

namespace Admin\Providers;
/*
* name RouteServiceProvider.php
* user Yuanchang.xu
* date 2017/4/27
*/


use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AdminRouteServiceProvider extends ServiceProvider
{

    /**
     * @desc middleware
     * @var array
     */
    protected $middleware = [
        'admin.guest' =>\Admin\Middleware\AdminGuestMiddleware::class,
        'admin.auth' => \Admin\Middleware\AdminAuthenticate::class,
        'admin.permission' =>\Admin\Middleware\PermissionMiddleware::class,
        'admin.menu' =>\Admin\Middleware\MenuMiddleware::class,
    ];

    /**
     * @desc $middlewareGroup
     * @var array
     */
    protected $middlewareGroup = [
        'admin' => [
            'admin.auth',
            'admin.permission',
            'admin.menu',
        ]
    ];


    /**
     * @name map
     * @desc register admin routes
     * @author Yuanchang
     * @since 2017.04.23
     */
    public function map()
    {
        $this->registerMiddleware();

        $this->resourceRoute();

        $this->webRoute();

    }

    /**
     * @name resourceRoute
     * @author Yuanchang
     * @since 2017.04.23
     */
    public function resourceRoute()
    {

        $config = [
            'prefix' =>   config('admin.prefix'),
            'namespace' =>  'Admin\Controllers\Auth',
            'middleware'=>['web','admin'],
        ];

        $prefix = config('admin.prefix');

        Route::group($config,function($router) use ($prefix) {
            $router->resource('auth/users', 'UserController');
            $router->resource('auth/roles', 'RoleController');
            $router->resource('auth/permissions', 'PermissionController');
            $router->resource('auth/menus', 'MenuController');
        });
    }

    /**
     * @name webRoute
     * @author Yuanchang
     * @since 2017.04.23
     */
    public function webRoute()
    {

        $config = [
            'prefix' =>   config('admin.prefix'),
            'namespace' =>  'Admin\Controllers\Auth',
            'middleware'=>['web','admin'],
        ];

        Route::group($config,function($router) {

            $router->post('auth/permissions/tree','PermissionController@tree')->name('permissions.tree');

        });

        Route::group([
            'prefix' =>   config('admin.prefix'),
            'namespace' =>  'Admin\Controllers\Auth',
            'middleware'=>['web'],
        ],function($router){

            $router->get('login','LoginController@showLoginForm')->name('admin.login');

            $router->post('login','LoginController@login')->name('admin.login');

            $router->get('logout','LoginController@logout')->name('admin.logout');

        });

        Route::get('/admin','Admin\Controllers\IndexController@index')->middleware(['web','admin.menu'])->name('admin');

    }

    /**
     * @desc 注册xadmin中间件
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/4
     */
    public function registerMiddleware()
    {
        foreach ($this->middleware as $key=>$middleware) {
            app('router')->aliasMiddleware($key,$middleware);
        }

        foreach ($this->middlewareGroup as $key=>$middleware) {
            app('router')->middlewareGroup($key,$middleware);
        }
    }
}