<?php

/**
 * Created by IntelliJ IDEA.
 * User: yuanc
 * Date: 2018/4/8
 * Time: 16:39
 */

namespace Admin\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        DB::statement(
            "INSERT INTO `admin_permissions` VALUES 
('1', '用户管理', '1', 'users.index', '1', 'fa-wifi', null, '2018-04-08 08:43:21', '2018-04-08 08:43:21'),
('2', '用户列表', '1', 'users.index', '1', 'fa-user', '1', '2018-04-08 08:43:53', '2018-04-08 08:43:53'),
('3', '角色管理', '2', 'roles.index', '1', 'fa-windows', null, '2018-04-08 08:44:37', '2018-04-08 08:44:37'),
('4', '角色列表', '1', 'roles.index', '1', 'fa-user-md', '3', '2018-04-08 08:45:03', '2018-04-08 08:45:03'),
('5', '权限管理', '3', 'permissions.index', '1', 'fa-unlock-alt', null, '2018-04-08 08:45:28', '2018-04-08 08:46:51'),
('6', '权限列表', '1', 'permissions.index', '1', 'fa-unlock', '5', '2018-04-08 08:45:49', '2018-04-08 08:45:49'),
('7', '新增用户', '2', 'users.create', '0', 'fa-wifi', '1', '2018-04-08 08:47:22', '2018-04-08 08:47:22'),
('8', '删除用户', '3', 'users.destroy', '1', 'fa-warning', '1', '2018-04-08 08:47:40', '2018-04-08 08:47:54'),
('9', '编辑用户', '4', 'users.edit', '0', 'fa-edit', '1', '2018-04-08 08:56:21', '2018-04-08 08:56:21'),
('11', '更新用户', '5', 'users.update', '0', 'fa-wifi', '1', '2018-04-08 08:57:16', '2018-04-08 08:57:16'),
('12', '新增角色', '2', 'roles.create', '1', 'fa-wifi', '3', '2018-04-08 08:57:58', '2018-04-08 08:57:58'),
('13', '删除角色', '3', 'roles.destroy', '0', 'fa-wifi', '3', '2018-04-08 08:58:35', '2018-04-08 08:58:35'),
('15', '更新角色', '5', 'roles.update', '0', 'fa-wifi', '3', '2018-04-08 08:59:17', '2018-04-08 08:59:53'),
('18', '修改角色', '4', 'roles.edit', '0', 'fa-wifi', '3', '2018-04-08 09:01:17', '2018-04-08 09:01:17');"
        );
    }
}