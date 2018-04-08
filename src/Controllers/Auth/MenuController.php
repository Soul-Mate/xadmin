<?php

namespace Admin\Controllers\Auth;


/*
* 
* name MenuController.php
* author Yuanchang
* date ${DATA}
*/

use Admin\Models\Auth\Permission;
use Flash;
use Exception;
use Admin\Models\Auth\Menu;
use Illuminate\Http\Request;
use Admin\Controllers\BaseController;

class MenuController extends BaseController
{

    protected $menu = '';

    public function index()
    {
        $model = new Menu();

        $tmp =  $model->all();

        $menus = $model->orderTree($tmp);

        $menuTabs = $model->menuTree($tmp);

        return view('admin::auth.menu.index',['menus'=>$menus,'menuTabs'=>$menuTabs]);
    }

    public function store(Request $request)
    {

        $model = new Menu();

        if ( $model->fill($request->all())->save() )
        {

            Flash::success('保存成功');
            return redirect( route('menus.index') );

        }
        return redirect()->back()->withErrors($model->getErrors());
    }

//    public function menu()
//    {
//        $permissionModel = new Permission;
//
//        $permissions = $permissionModel->childrenTree(Permission::all()->toArray());
//
//        return $permissions;
//    }
}