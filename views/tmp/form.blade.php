<div class="form-group">
    <label for="username" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" id="username" name="username" class="form-control" placeholder="输入用户名">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label">名称</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" id="name" name="name" class="form-control" placeholder="输入用户名称">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="avatar" class="col-sm-2 control-label">头像</label>
    <div class="col-sm-8">
        <input type="file" id="avatar" name="avatar" class="form-control" placeholder="输入用户名称">
    </div>
</div>
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
            <input type="password" id="password" name="password"class="form-control" placeholder="输入密码">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="输入确认密码">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="role_id" class="col-sm-2 control-label">角色</label>
    <div class="col-sm-8">
        <select name="role_id" id="role_id" class="select2 form-control" multiple>

        </select>
    </div>
</div>
<div class="form-group">
    <label for="permission_id" class="col-sm-2 control-label">权限</label>
    <div class="col-sm-8">
        <select name="permission_id" id="permission_id" class="select2 form-control" multiple>

        </select>
    </div>
</div>
@push('css')
    <link rel="stylesheet" href="{{ asset('/packages/admin/select2/dist/css/select2.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('/packages/admin/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/packages/admin/select2/dist/js/i18n/zh-CN.js') }}"></script>
    <script>
        $(".select2").select2();
    </script>
@endpush