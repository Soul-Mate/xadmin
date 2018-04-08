<?php

namespace Admin\Controllers\Auth;

/*
* name PermissionController.php
* user Yuanchang.xu
* date 2017/4/26
*/

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Admin\Traits\PermissionTree;
use Admin\Models\Auth\Permission;
use Illuminate\Support\Facades\Route;
use Admin\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionController extends BaseController
{
    use PermissionTree;

    public function index()
    {
        $user = \Auth::guard("admin")->user();

        $permissions = $user->userMenus();
        return view('admin::auth.permission.index', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $model = new Permission();
        $validator = Validator::make($request->all(), $model->rules, $model->messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if (!$this->isValidUrl($request->get('uri'))) {
            return redirect()->back()->withErrors('输入的路径无效');
        }

        try {
            $model->fill($request->all())->saveOrFail();
            $this->updatePermissionTreeCache();
            return redirect()->back();
        } catch (Throwable $throwable) {
            return redirect()->back()->withErrors($throwable->getMessage());
        }
    }

    public function edit($id)
    {
        $user = \Auth::guard("admin")->user();
        $permissions = $user->userMenus();
        try {
            $permission = Permission::find($id);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('permissions.index'))->withErrors("该权限信息不存在或已经被删除");
        }
        return view('admin::auth.permission.edit', ['permission' => $permission, 'permissions' => $permissions]);
    }

    public function update($id, Request $request)
    {
        $inputs = $request->all();
        $model = Permission::find($id);

        if (!$model) {
            return redirect(route('permissions.index'))->withErrors("该权限信息不存在或已经被删除");
        }

        $validator = Validator::make($inputs, $model->rules, $model->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }


        if (!$this->isValidUrl($inputs['uri'])) {
            return redirect()->back()->withErrors('输入的路径不无效');
        }

        $children = $this->subPermission($model->all()->toArray(), $id, 'id');

        if ($inputs['parent_id'] == $id || in_array($inputs['parent_id'], $children)) {
            return redirect()->back()->withErrors('选择父级菜单错误:不能将下级或自身作为父级菜单');
        }

        if ($model->fill($inputs)->save()) {
            $this->updatePermissionTreeCache();
            return redirect(route('permissions.index'));
        }

        return redirect()->back()->withErrors("修改失败");
    }

    public function destroy($id)
    {
        $model = Permission::find($id);
        if (!$model)
            return redirect(route('permissions.index'))->withErrors("该权限信息不存在或已经被删除");
        try {
            $model->delete();
        } catch (\Exception $e) {
            return redirect(route('permissions.index'))->withErrors($e->getMessage());
        }
        return redirect(route('permissions.index'));
    }

    public function tree()
    {
        $permissions = Permission::all();
        return $permissions;
    }

    public function isValidUrl($uri)
    {
        if (in_array(substr($uri, strrpos($uri, ".") + 1), Permission::$exceptPermission))
            return true;
        return Route::has($uri);
    }
}