<?php

namespace Admin\Providers;

use Illuminate\Http\Request;
use Admin\Traits\AdminAuth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class AdminAuthServiceProvider extends AuthServiceProvider
{
    use AdminAuth;

    /**
     * @name boot
     * @desc check user permission
     * @author Yuanchang
     * @since 2017.04.
     * @return mixed
     */
    public function boot(Request $request)
    {
        // register policy
        $this->registerPolicies();

        // artisan command
         if ( $request->getScriptName() === 'artisan' ) {
             return false;
         }

        // is super user
        $this->before();
    }
}
