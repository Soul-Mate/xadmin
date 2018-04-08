<?php

namespace Admin\Facades;


/*
* 
* name Admin.php
* author Yuanchang
* date ${DATA}
*/

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Admin\Admin::class;
    }
}