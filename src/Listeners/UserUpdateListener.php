<?php

namespace Admin\Listeners;


/*
* 
* name UserUpdateListener.php
* author Yuanchang
* date ${DATA}
*/

use Illuminate\Http\Request;
use Admin\Events\UserUpdateEvent;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserUpdateListener
{
    use AuthenticatesUsers;

    public function handle(UserUpdateEvent $event)
    {
        auth()->guard('admin')->logout();

        return redirect(route('admin.login'));
    }
}