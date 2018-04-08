<?php

namespace Admin\Providers;


/*
* 
* name AdminEventServiceProvider.php
* author Yuanchang
* date ${DATA}
*/

use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class AdminEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        'Admin\Events\UserUpdateEvent' => [
            'Admin\Listeners\UserUpdateListener',
        ],
        'Admin\Events\UserCacheEvent' => [
            'Admin\Listeners\UserCacheListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}