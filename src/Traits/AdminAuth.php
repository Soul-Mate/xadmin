<?php

namespace Admin\Traits;

use Illuminate\Http\Request;
use Admin\Models\Auth\AdminUser;
use Illuminate\Support\Facades\Gate;

trait AdminAuth
{

    /**
     * @desc 对root用户不鉴权
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     */
    public function before()
    {
        Gate::before(function ($user) {
            return $this->isRoot($user);
        });
    }

    /**
     * @desc 超级管理员用户
     * @param AdminUser $user
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return bool
     */
    public function isRoot(AdminUser $user)
    {
        if ($user->id == 1 || $user->name == 'administrator') return true;
    }

    /**
     * @desc 使用控制台时不鉴权
     * @author Yuanchang (yuanchang.xu@outlook.com)
     * @since 2018/4/8
     * @return bool
     */
    public function isArtisan()
    {
        $request = new Request;

        if ($request->getScriptName() === 'artisan') return true;
    }
}