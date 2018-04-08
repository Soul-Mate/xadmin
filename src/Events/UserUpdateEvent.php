<?php

namespace Admin\Events;


/*
* 
* name UserUpdateEvent.php
* author Yuanchang
* date ${DATA}
*/

use Admin\Models\Auth\AdminUser;
use Illuminate\Support\Facades\Event;

class UserUpdateEvent extends Event
{
    /**
     * @var AdminUser
     */
    public $user;

    public function __construct(AdminUser $user)
    {

        $this->user = $user;
    }
}