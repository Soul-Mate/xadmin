<?php

namespace Admin\Commands;

/*
* 
* name InstallCommand.php
* author Yuanchang
* date ${DATA}
*/

use Admin\Seeds\AdminSeeder;
use Admin\Seeds\PermissionSeeder;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;

class InstallCommand extends Command
{
    protected $name = 'xadmin:install';

    protected $description = 'Install the xadmin package';

    public function handle()
    {
        $this->publishResource();

        $this->initDatabase();

        $this->line('<info>installing xadmin success!</info>');

    }

    public function publishResource()
    {
        $this->call('vendor:publish',['--tag'=>'yuanchang-admin']);
    }

    public function initDatabase()
    {
        $this->call('migrate');
        $this->runSeed();

    }

    public function runSeed()
    {
        $seeders = [
            new AdminSeeder(),
            new PermissionSeeder(),
        ];

        foreach ($seeders as $seeder) {
            $seeder->run();
        }
    }
}