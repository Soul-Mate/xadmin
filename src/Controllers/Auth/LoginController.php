<?php

namespace Admin\Controllers\Auth;
/*
* name LoginController.php
* user Yuanchang.xu
* date 2017/4/27
*/

use Admin\Models\LoginLog;
use Illuminate\Http\Request;
use Admin\Models\Auth\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /**
     * @var string
     */
    protected $redirectTo = '/admin';

    use AuthenticatesUsers;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    /**
     * @name showLoginForm
     * @desc
     * @author Yuanchang
     * @since 2017.04.23
     * @return mixed
     */
    public function showLoginForm()
    {
        return view('admin::auth.login');
    }

    public function attemptLogin(Request $request)
    {
        if ( $this->guard()->attempt( $this->credentials($request), $request->has('remember') ) )
        {
            $user = $this->guard()->user();

            $this->loginLog($user,$request);

            return true;
        }
        return false;
    }

    /**
     * @name guard
     * @desc
     * @author Yuanchang
     * @since 2017.04.23
     * @return mixed
     */
    public function guard()
    {
        return auth()->guard('admin');
    }

    /**
     * @name logout
     * @desc
     * @param Request $request
     * @author Yuanchang
     * @since 2017.04.2323
     * @return mixed
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(route('admin.login'));
    }

    private function loginLog(AdminUser $user,Request $request)
    {
        // get ip information
        $ch = curl_init();

        $options = [
            CURLOPT_URL => 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json',
            CURLOPT_RETURNTRANSFER => true,
        ];

        curl_setopt_array($ch,$options);

        $info = curl_exec($ch);

        curl_close($ch);

        $info = json_decode($info,true);

        $loginLogModel = new LoginLog();

        // login log table fill data
        $fill = [
            'name'=>$user->name,
            'email'=>$user->email,
            'country'=>$info['country'],
            'province'=>$info['province'],
            'city'=>$info['city'],
            'ip'=>$request->getClientIp(),
            'time' => date('Y-m-d H:i:s'),
            'times' => 1
        ];

        if ( $userLoginLog = $loginLogModel->find($user->id) )
        {
            $fill ['times'] = $userLoginLog->times + 1;

            $userLoginLog->fill( $fill )->save();

        }
        else
        {

            $fill['user_id'] = $user->id;
            $loginLogModel->fill($fill)->save();
        }
    }
}