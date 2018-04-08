<?php

namespace Admin\Models;


/*
* 
* name 
* author Yuanchang
* date 
*/

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $primaryKey = 'user_id';

    protected $table = 'admin_login_logs';

    protected $fillable = [
        'user_id','name','email','country','province','city','ip','times','time'
    ];

    public $timestamps = false;
}