<?php

namespace Admin\Providers;

/*
* name AdminProviderService.php
* user Yuanchang.xu
* date 2017/4/26
*/

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{


    protected $commands = [
        'Admin\Commands\InstallCommand',
        'Admin\Commands\UninstallCommand'
    ];

    /**
     * @name boot
     * @desc
     * @author Yuanchang
     * @since 2017.04.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../views','admin');

        $this->publishResources();

    }

    /**
     * @name register
     * @desc
     * @author Yuanchang
     * @since 2017.04.
     */
    public function register()
    {
        $this->setAuth();

        // 注册 xadmin 运行时所需provider
        collect(config('admin.providers'))->each(function ($provider){
            $this->app->register($provider);
        });



        $this->commands($this->commands);
    }

    /**
     * @name setAuth
     * @desc
     * @author Yuanchang
     * @since 2017.04.
     */
    public function setAuth()
    {
        config([
            'auth.guards.admin.driver'    => 'session',
            'auth.guards.admin.provider'  => 'admin',
            'auth.providers.admin.driver' => 'eloquent',
            'auth.providers.admin.model'  => 'Admin\Models\Auth\AdminUser',
        ]);
    }

    /**
     * @desc 初始化运行资源
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/4
     */
    public function publishResources()
    {
        $this->publishes([
            __DIR__.'/../../configs/admin.php'=>config_path('admin.php')
        ],'yuanchang-admin');

        $this->publishes([
            __DIR__.'/../../assets'=>public_path('packages/admin')
        ],'yuanchang-admin');

        $this->publishes([
            __DIR__.'/../../migrations/'=>base_path('database/migrations')
        ],'yuanchang-admin');
    }

}