
<div class="form-group">
    <label for="username" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" id="username" name="username"  class="form-control" placeholder="请输入登陆用户名">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="email" class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" id="email" name="email" class="form-control" placeholder="请输入邮箱">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label">昵称</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" id="name" name="name" class="form-control required" placeholder="请输入昵称">
        </div>
    </div>
</div>
<!--<div class="form-group">-->
<!--    <label for="avatar" class="col-sm-2 control-label">头像</label>-->
<!--    <div class="col-sm-8">-->
<!--        <input type="file" id="avatar" name="avatar" class="form-control required">-->
<!--    </div>-->
<!--</div>-->
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
            <input type="password" id="password" name="password" class="form-control required" placeholder="请输入登陆密码">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control required" placeholder="请输入确认密码">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="role_id" class="col-sm-2 control-label">角色</label>
    <div class="col-sm-8">
        <select name="role_id[]" id="role_id" class="select2 form-control" multiple>
            @forelse($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @empty
            @endforelse
        </select>
    </div>
</div>

