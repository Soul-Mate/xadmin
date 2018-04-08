@extends('admin::layouts.index')
@section('content')
    <section class="content-header">
        <h1>
            权限
            <small>列表</small>
        </h1>
    </section>
    <section class="content">
        @include('admin::layouts.validator-error')
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header">
                        <div class="btn-group">
                            <a class="btn btn-primary btn-sm" id="expand">
                                <i class="fa fa-plus-square-o"></i>展开
                            </a>
                            <a class="btn btn-primary btn-sm" id="collapse">
                                <i class="fa fa-minus-square-o"></i>收起
                            </a>
                        </div>
                        <div class="btn-group">
                            <a id="editPermission" class="btn btn-warning btn-sm" disabled><i class="fa fa-edit"></i>修改</a>
                            <button id="destroyPermission" class="btn btn-danger btn-sm" disabled><i class="fa fa-remove"></i>删除</button>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" id="dd">
                    </div>
                    <div class="box-footer clearfix">
                        <div class="ztree"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">新增</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body" style="display: block;">
                        <form method="POST" action="{{ route( 'permissions.store' ) }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="box-body">
                                @include('admin::auth.permission.form')
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-2">
                                    <div class="btn-group pull-left">
                                        <button type="reset" class="btn btn-warning pull-right">撤销</button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn btn-info pull-right">提交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                        确认要删除这个权限吗?
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

@push('css')
<link rel="stylesheet" href="{{ asset('/packages/admin/zTree_v3/css/zTreeStyle/zTreeStyle.css') }}">
@endpush

@push('js')
<script src="{{ asset('/packages/admin/zTree_v3/js/jquery.ztree.core.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var setting = {
            async: {
                enable: true,
                url: "/admin/auth/permissions/tree",
                otherParam: {"_token":"{{ csrf_token() }}"},
                dataFilter:function(treeId, parentNode, responseData) {
                    $.each(responseData,function(k,v){
                         delete responseData[k].icon;
                    });
                    return responseData;
                }
            },
            data: {
                simpleData: {
                    enable: true,
                    idKey: "id",
                    pIdKey: "parent_id",
                    rootPId: null

                }
            },
            callback: {
                beforeAsync: function () {

                },
                onAsyncSuccess: function(event, treeId, treeNode, msg){
                    treeObj.expandAll(true);
                },
                onClick:function(event, treeId, treeNode) {
                    edit(treeNode.id);
                    destroy(treeNode.id);
                }
            }
        };
        var treeObj = $.fn.zTree.init($(".ztree"), setting);
        expand(treeObj);
        collapse(treeObj);
    });

    function edit(id) {
        var editBtn = $('#editPermission');
        editBtn.removeAttr('disabled').attr('href','/admin/auth/permissions/'+id+'/edit');

    }

    function destroy(id) {
        var destroyBtn = $('#destroyPermission');
        destroyBtn.removeAttr('disabled');
        destroyBtn.on('click',function () {
            $('.deleteForm').attr('action','/admin/auth/permissions/'+id)
            $('#modal-delete').modal();
        });
    }
    function expand (treeObj) {
        $('#expand').click(function(){
            treeObj.expandAll(true);
        });
    }
    function collapse (treeObj) {
        $('#collapse').click(function(){
            treeObj.expandAll(false);
        });
    }
</script>
@endpush