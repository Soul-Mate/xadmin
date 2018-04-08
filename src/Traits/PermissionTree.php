<?php

namespace Admin\Traits;


/*
* 
* name PermissionTree.php
* author Yuanchang
* date 2017/04/23
*/

use Admin\Models\Auth\Permission;
use Illuminate\Support\Facades\Cache;

trait PermissionTree
{
    /**
     * @desc 普通用户权限树
     * @param array $hasPermission
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array
     */
    public function userPermissionTree(array $hasPermission = [])
    {
        return Permission::userPermissionTree($hasPermission);
    }

    /**
     * @desc 生成权限树缓存
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array
     */
    public function createPermissionTreeCache()
    {
//        if (Cache::has("sendPermissionTree")) {
//            return json_decode(Cache::get('sendPermissionTree'), true);
//        }
        $permissionTree = Permission::secondPermissionTree();
        Cache::forever('sendPermissionTree', json_encode($permissionTree));
        return $permissionTree;
    }

    /**
     * @desc 更新权限树缓存
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array
     */
    public function updatePermissionTreeCache()
    {
        $permissions = Permission::secondPermissionTree();
        Cache::forever('sendPermissionTree', json_encode($permissions));
        return $permissions;
    }

    /**
     * @desc 递归获取根节点子树
     * @param array $permissions
     * @param $parent_id
     * @param null $fields
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array
     */
    public function subPermission(array $permissions, $parent_id, $fields = null)
    {
        static $arr = [];

        foreach ($permissions as $permission) {
            if ($permission['parent_id'] == $parent_id) {
                $arr [] = $permission;

                $this->subPermission($permissions, $permission['id']);
            }
        }
        return $fields ? array_pluck($arr, $fields) : $arr;
    }
}