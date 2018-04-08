@extends('admin::layouts.index')
@section('content')
    <section class="content-header">
        <h1>
            角色
            <small>列表</small>
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <div class="pull-right">
                    <div class="form-inline pull-right">
                        <form action="" method="get" >
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
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>
                </div>
                <span>
                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> 刷新</a>
                </span>

            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th> </th>
                        <th>ID</th>
                        <th>名称</th>
                        <th>标识</th>
                        <th>简介</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td><input type="checkbox" value="{{ $role->id }}" class="icheck"></td>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->updated_at }}</td>
                                <td>
                                    <a href="{{ route('roles.edit',$role->id) }}" class="href btn btn-xs btn-warning">修改</a>
                                    <button data-href="{{ route('roles.destroy',$role->id) }}" class="btn btn-del btn-xs btn-danger">删除</button>
                                </td>
                            </tr>
                            @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog modal-danger">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>
                        确认要删除这个角色吗?
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="deleteForm" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i> 确认
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
