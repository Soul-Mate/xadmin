<?php

namespace Admin\Models\Auth;
/*
* name Role.php
* user Yuanchang.xu
* date 2017/4/27
*/

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'admin_roles';

    protected $fillable = [
        'name','slug','description'
    ];


    public $rules = [
        'name'=>'required|unique:admin_roles'
    ];

    public $messages = [

    ];

    public function permissions()
    {
        return $this->belongsToMany('Admin\Models\Auth\Permission','admin_role_permissions','role_id','permission_id');
    }

    public function users()
    {
        return $this->belongsToMany('Admin\Models\Auth\AdminUser','admin_role_users','role_id','user_id');
    }
}