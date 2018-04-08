<?php

namespace Admin\Models\Auth;


/*
* 
* name 
* author Yuanchang
* date 2017/04/21
*/

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * @var string
     */
    protected $table = 'admin_permissions';

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'order', 'icon', 'uri', "visit"
    ];

    /**
     * @var array
     */
    public $rules = [
        'name' => 'required',
        'order' => 'required|numeric',
        'uri' => 'required',
    ];

    /**
     * @var array
     */
    public $messages = [

    ];

    /**
     * @var array 排除不现实的路由
     */
    public static $exceptPermission = [
        "store", "destroy", "update", "edit"
    ];

    /**
     * @desc 获取一个二级权限树
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array
     */
    public static function secondPermissionTree()
    {
        $permissions = Permission::orderBy("order", "asc")->where("visit", 1)->get()->toArray();
        $tree = [];
        foreach ($permissions as $permission) {
            // 根节点 & 过滤非法根结点
            if (!$permission["parent_id"] &&
                (!empty($permission["uri"]) &&
                    !in_array(substr($permission["uri"], strrpos($permission["uri"], ".") + 1),
                        self::$exceptPermission))) {
                $root = $permission;
                $root["child"] = [];
                foreach ($permissions as $pp) {
                    // 子节点 & 过滤非法子结点
                    if ($pp["parent_id"] == $permission["id"] &&
                        (!empty($permission["uri"]) &&
                            !in_array(substr($pp["uri"], strrpos($pp["uri"], ".") + 1),
                                self::$exceptPermission))) {
                        array_push($root["child"], $pp);
                    }
                }
                array_push($tree, $root);
            }
        }
        return $tree;
    }

    /**
     * @desc 普通用户对应的权限树
     * @param array $userPermissionsId
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array
     */
    public static function userPermissionTree(array $userPermissionsId = [])
    {
        $permissions = Permission::orderBy("order", "asc")->get()->toArray();

        $tree = [];
        foreach ($permissions as $permission) {
            // 根节点
            if (!$permission["parent_id"]) {
                // 过滤用户权限
                if (in_array($permission["id"], $userPermissionsId)) {
                    $child = self::findChild($permissions, $permission["id"], $userPermissionsId);
                    $permission["child"] = $child;
                    array_push($tree, $permission);
                }
            }
        }
        return $tree;
    }

    /**
     * @desc 查找子树
     * @param array $permissions
     * @param null $p
     * @param array $userPermissionsId
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return array
     */
    public static function findChild(array $permissions, $p = null, array $userPermissionsId = [])
    {
        $tree = [];
        foreach ($permissions as $permission) {
            // 需要过滤用户权限
            if (!empty($userPermissionsId)) {
                //  向下递归查找子结点 & 过滤非法uri
                if (array_key_exists($permission["id"], $userPermissionsId) &&
                    $permission["parent_id"] == $p &&
                    (!empty($permission["uri"]) &&
                        !in_array(substr($permission["uri"], strrpos($permission["uri"], ".") + 1),
                            self::$exceptPermission))
                ) {
                    $permission["child"] = self::findChild($permissions, $permission["id"], $userPermissionsId);
                    array_push($tree, $permission);
                }
            } else {
                if ($permission["parent_id"] == $p &&
                    (!empty($permission["uri"]) &&
                        !in_array(substr($permission["uri"], strrpos($permission["uri"], ".") + 1),
                            self::$exceptPermission))
                ) {
                    $permission["child"] = self::findChild($permissions, $permission["id"], $userPermissionsId);
                    array_push($tree, $permission);
                }
            }
        }
        return $tree;
    }
}