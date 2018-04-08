<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('admin.title')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/ionicons/2.0.1/css/ionicons.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/font-awesome/css/font-awesome.min.css") }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/skins/" . config('admin.skin') .".min.css") }}">

    <!-- Datatables style -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/datatables/jquery.dataTables.min.css") }}">

    <!-- Datatables Boostrap -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/datatables/dataTables.bootstrap.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/AdminLTE/plugins/iCheck/square/red.css') }}">

    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/AdminLTE/plugins/select2/select2.min.css') }}">

    <!-- FilInput -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/bootstrap-fileinput/css/fileinput.min.css') }}">

    <!-- load -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/load/load.css') }}">

    <!-- nestable -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/nestable/nestable.css") }}">

    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/toastr/build/toastr.min.css') }}">

    <!-- nprogress -->
    <link rel="stylesheet" href="{{ asset('/packages/admin/nprogress/nprogress.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/AdminLTE.min.css") }}">

    @stack('css')

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/dist/js/app.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/jquery-pjax/jquery.pjax.js") }}"></script>
    <script src="{{ asset('/packages/admin/nprogress/nprogress.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body class="hold-transition {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}">
<div class="wrapper">

    @include('admin::layouts.header')

    @include('admin::layouts.sidebar')

    <div class="content-wrapper">
        @yield('content')

    </div>


    @include('admin::layouts.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset ("/packages/admin/AdminLTE/plugins/chartjs/Chart.min.js") }}"></script>
<script src="{{ asset ("/packages/admin/nestable/jquery.nestable.js") }}"></script>
<script src="{{ asset('/packages/admin/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('/packages/admin/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('/packages/admin/AdminLTE/plugins/select2/i18n/zh-CN.js') }}"></script>
<script src="{{ asset('/packages/admin/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('/packages/admin/helpers/helpers.js') }}"></script>
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

        /**
         * select2 init
         */
        $(".select2").select2();

        $('table').delegate('.btn-del','click',function(){
            $('.deleteForm').attr('action',$(this).attr('data-href'));
            $('#modal-delete').modal();
        });
    });
</script>
@stack('js')
</body>
</html>
