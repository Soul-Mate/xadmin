<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/packages/admin/avatar.png" width="" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>AdminName</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> online </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">菜单</li>
            {!! request()->get("permissions") !!}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>


