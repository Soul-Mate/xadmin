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
                        <form action="" method="get" pjax-container="">
                            <fieldset>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><strong>Id</strong></span>
                                    <input type="text" class="form-control" placeholder="Id" name="id" value=""></div>

                                <div class="btn-group btn-group-sm">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    <a href="{{ route('users.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i></a>
                                </div>
                            </fieldset>
                        </form>
                    </div>



                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a data-pjax href="{{route('users.create')}}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                </div>
                <span>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> 刷新</a>
                </span>

            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th> </th>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>名称</th>
                        <th>邮箱</th>
                        <th>角色</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td><input type="checkbox" value="{{ $user->id }}" class="icheck"></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-xs btn-warning">修改</a>
                                    <button data-href="{{ route('users.destroy',$user->id) }}" class="btn btn-del btn-danger btn-xs">删除</button>
                                </td>
                            </tr>
                            @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                {{ $users->links() }}
            </div>
        </div>
    </section>
@endsection
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