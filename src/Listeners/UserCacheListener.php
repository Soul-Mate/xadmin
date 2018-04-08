<?php

namespace Admin\Listeners;


/*
* 
* name UserCacheListener.php
* author Yuanchang
* date ${DATA}
*/

use Admin\Events\UserCacheEvent;

class UserCacheListener
{
    public function handle(UserCacheEvent $userCacheEvent)
    {
        $user = $userCacheEvent->user;

        $user->userPermissions($user);

        $user->currentUserPermissionTree();
    }
}