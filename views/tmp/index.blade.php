@extends('admin::layouts.index')
@section('content')
    <section class="content-header">
        <h1>
            管理员
            <small>列表</small>
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <div class="pull-right">
                    <div class="form-inline pull-right">
                        <form action="http://127.0.0.1:8000/admin/auth/users" method="get" pjax-container="">
                            <fieldset>

                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><strong>Id</strong></span>
                                    <input type="text" class="form-control" placeholder="Id" name="id" value=""></div>

                                <div class="btn-group btn-group-sm">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    <a href="http://127.0.0.1:8000/admin/auth/users" class="btn btn-warning"><i class="fa fa-undo"></i></a>
                                </div>
                            </fieldset>
                        </form>
                    </div>



                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="/admin/auth/users/create" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                </div>
                <span>
                    <a class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> 刷新</a>
                </span>

            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th> </th>
                        <th>ID<a class="fa fa-fw fa-sort" href="http://127.0.0.1:8000/admin/auth/users?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc"></a></th>
                        <th>用户名</th>
                        <th>名称</th>
                        <th>角色</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
            </div>
        </div>
    </section>
@endsection