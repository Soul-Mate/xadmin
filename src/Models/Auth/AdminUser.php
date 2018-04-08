<?php

namespace Admin\Models\Auth;


/*
*
* name AdminUser.php
* author Yuanchang
* date  2017.04.23
*/

use Admin\Traits\AdminAuth;
use Admin\Traits\PermissionTree;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Cache;

class AdminUser extends User
{

    use PermissionTree, AdminAuth;

    protected $table = 'admin_users';

    protected $fillable = [
        'username', 'password', 'name', 'email', 'avatar'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public $rules = [
        'username' => 'required|max:190',
        'password' => 'required|confirmed',
        'name' => 'required|max:255',
        'email' => 'required|unique:admin_users|max:40',
    ];

    public $messages = [
    ];


    public function roles()
    {
        return $this->belongsToMany('Admin\Models\Auth\Role', 'admin_role_users', 'user_id', 'role_id');
    }


    public function permissions()
    {
        return $this->belongsToMany('Admin\Models\Auth\Permission', 'admin_user_permissions', 'user_id', 'permission_id');
    }


    public function createOrUpdate(array $data, AdminUser $user = null)
    {
        if ($user) {
            // 不修改密码
            if (empty($data["password"]))
                $data["password"] = $user->getAuthPassword();
            else
                $data ['password'] = bcrypt($data['password']);
            $user->fill($data)->save();

        } else {
            $this->name = $data['name'];
            $this->email = $data['email'];
            // TODO 上传头像
            $this->password = bcrypt($data['password']);
            $this->username = $data['username'];
            $this->save();
        }
    }

    /**
     * @desc 用户的权限
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array|bool
     */
    public function userPermissions()
    {
        if (Cache::has($this->id . ':permissions')) {
            $permissions = json_decode(Cache::get($this->id . ':permissions'), true);
            return $permissions;
        }

        $roles = $this->roles()->with("permissions")->get();

        $permissions = [];

        foreach ($roles as $role) {
            $permissions += $role->permissions->toArray();
        }

        Cache::forever($this->id . ':permissions', json_encode($permissions));
        return $permissions;
    }

    /**
     * @desc 更新用户权限
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     */
    public function updateUserPermissions()
    {
        Cache::forget($this->id . ':permissions');
        return $this->userPermissions();
    }

    /**
     * @desc 删除用户权限缓存
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     */
    public function destroyUserPermissions()
    {
        Cache::forget($this->id . ':permissions');
    }

    /**
     * @desc 用户的菜单
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/4
     * @return array|bool|mixed
     */
    public function userMenus()
    {
        $permissionTree = $this->createPermissionTreeCache();

        if ($this->isRoot($this)) {
            return $permissionTree;
        }

        $hasPermission = array_pluck($this->userPermissions(), "parent_id", "id");

        foreach ($permissionTree as $key => $item) {
            if (!in_array($item["id"], $hasPermission))
                unset($permissionTree[$key]);
            if (!empty($item["child"]))
                foreach ($item["child"] as $kk => $c)
                    if (!array_key_exists($c["id"], $hasPermission))
                        unset($permissionTree[$key][$kk]);
        }
        return $permissionTree;
    }
}