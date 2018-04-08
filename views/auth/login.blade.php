<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/font-awesome/css/font-awesome.min.css") }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/skins/" . config('admin.skin') .".min.css") }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/AdminLTE/plugins/iCheck/square/red.css') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/AdminLTE.min.css") }}">

@stack('css')

<!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/dist/js/app.min.js") }}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page" style="background: #00b5ec">
<div class="login-box">
    <div class="login-logo">
        <a><b>X</b>CMS</a>
    </div>
    @include('admin::layouts.validator-error')
<!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">欢迎使用XCMS</p>
        <form action="{{ route('admin.login') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="登录邮箱"  name="email" >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control"  name="password" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember">&nbsp;&nbsp;记&nbsp;住&nbsp;
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>


<!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset('/packages/admin/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('/packages/admin/toastr/build/toastr.min.js') }}"></script>
<script>
    $(document).ready(function(){
        /**
         * iCheck init
         */
        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
            increaseArea: '20%' // optional
        });
    });

</script>
@stack('js')
</body>
</html>
