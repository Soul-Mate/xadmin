@extends('admin::layouts.index')
@section('content')
    <section class="content-header">
        <h1>
            管理员
            <small>创建</small>
        </h1>

    </section>

    <section class="content">
        @include('admin::layouts.validator-error')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">创建</h3>
                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="/admin/auth/users" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
                            </div> <div class="btn-group pull-right" style="margin-right: 10px">
                                <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                            </div>
                        </div>
                        <form action="{{ route('users.store') }}" class="form-horizontal" method="post">
                            {{csrf_field()}}
                            <div class="box-body">
                                    @include('admin::auth.user.create_form')
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> 提交">提交</button>
                                    </div>
                                    <div class="btn-group pull-left">
                                        <button type="reset" class="btn btn-warning">撤销</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection