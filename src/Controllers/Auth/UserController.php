<?php

namespace Admin\Controllers\Auth;

/*
* name UserController.php
* user Yuanchang.xu
* date 2017.04.23
*/


use Flash;
use Illuminate\Validation\Rule;
use Throwable;
use Admin\Models\Auth\Role;
use Illuminate\Http\Request;
use Admin\Traits\PermissionTree;
use Admin\Events\UserCacheEvent;
use Admin\Models\Auth\AdminUser;
use Admin\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends BaseController
{

    use PermissionTree;

    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin::auth.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::get(['id', 'name']);

        $permissions = $this->createPermissionTreeCache();

        return view('admin::auth.user.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        // validator data
        $model = new AdminUser();

        $validator = Validator::make($request->all(), $model->rules, $model->messages);

        if ($validator->fails())
            return redirect(route('users.create'))->withErrors($validator->errors());

        if (!$model->createOrUpdate($request->all()))
            return redirect(route('users.index'))->withErrors("创建失败");


        // create user roles to db
        if ($request->get('role_id')) {
            $model->roles()->sync($request->get('role_id'));
        }

        // 建立用户权限缓存
        $model->userPermissions();
        return redirect(route('users.index'));
    }

    public function edit($id)
    {
        $user = AdminUser::find($id);
        if (!$user)
            return redirect()->back()->withErrors("该用户不存在或已被删除");
        $roles = Role::get(['id', 'name']);
        $user_roles = $user->roles()->pluck('role_id')->toArray();
        return view('admin::auth.user.edit', compact('user', 'roles', 'permissions', 'user_roles', 'user_permissions'));
    }

    public function update($id, Request $request)
    {

        $user = AdminUser::find($id);
        if (!$user)
            return redirect()->back()->withErrors("该用户不存在或已被删除");

        $user->rules["email"] = [
            'email' => 'required',
            Rule::unique('admin_users')->ignore($user->id),
        ];

        unset($user->rules["password"]);

        $validator = Validator::make($request->all(), $user->rules, $user->messages);

        if ($validator->fails())
            return redirect(route('users.edit', $id))->withErrors($validator->errors());

        $user->createOrUpdate($request->all(), $user);

        if ($request->get('role_id'))
            $user->roles()->sync($request->get('role_id'));
         else
            $user->roles()->detach();

         $user->updateUserPermissions();
        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $user = AdminUser::find($id);
        if (!$user)
            return redirect()->back()->withErrors("该用户不存在或已被删除");

        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        $user->destroyUserPermissions();
        return redirect(route('users.index'));
    }
}