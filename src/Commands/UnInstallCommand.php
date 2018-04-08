<?php

namespace Admin\Commands;


/*
* 
* name UnInstallCommand.php
* author Yuanchang
* date ${DATA}
*/

use Illuminate\Console\Command;
use Admin\Models\Auth\AdminUser;
use Illuminate\Support\Facades\Cache;

class UninstallCommand extends Command
{
    protected $name = 'xadmin:uninstall';

    protected $description = 'uninstall xadmin package';

    public function handle()
    {
        $this->fire();
    }

    public function fire()
    {
        if (!$this->confirm('Are you sure to uninstall xadmin?')) {
            return;
        }

        $this->removeResource();

        $this->clearCache();

        $this->line('<info>Uninstalling xadmin success!</info>');
    }

    public function removeResource()
    {
        $this->laravel['files']->deleteDirectory(public_path('packages/admin'));

        $this->laravel['files']->delete(config_path('admin.php'));

        $this->laravel['files']->delete(base_path('database/migrations/2017_04_26_154241_create_table_admin_tables.php'));

        $this->laravel['files']->delete(base_path('database/seeds/AdminSeeder.php'));
    }

    public function clearCache()
    {
        collect(AdminUser::all())->each(function($user){

           Cache::forget($user->id.'permissions');

           Cache::forget($user->id.'menus');
        });

        Cache::forget('permissions');
    }
}