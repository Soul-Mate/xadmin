@if(!empty($permission))
    <div class="form-group">
        <label for="parent_id" class="col-sm-2 control-label">父级菜单</label>
        <div class="col-sm-8">
            <select name="parent_id" id="parent_id" class="select2 form-control">
                <option value="">顶级</option>
                @forelse($permissions as $top)
                    <option value="{{ $top['id'] }}"
                        {{ $top['id'] == $permission->parent_id? "selected":"" }}
                    >
                        {{ $top['name'] }}
                    </option>
                    @if(!empty($top['child']))
                        @foreach($top['child'] as $sub)
                            <option value="{{ $sub['id'] }}"
                            {{ $sub['id'] == $permission->parent_id? "selected":"" }}
                            >
                                {{ str_repeat('&nbsp;&nbsp;',2).$sub['name'] }}
                            </option>
                        @endforeach
                    @endif
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">权限名称</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" value="{{ $permission->name }}" class="form-control title" placeholder="请输入权限名称">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="order" class="col-sm-2 control-label">排序</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="order" name="order" value="{{ $permission->order }}" class="form-control title" placeholder="请输入排序">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="icon" class="col-sm-2 control-label">图标</label>
        <div class="col-sm-8">
            <button class="btn btn-default" name="icon" data-iconset="fontawesome" data-icon="{{ $permission->icon }}" role="iconpicker"></button>
        </div>
    </div>
    <div class="form-group">
        <label for="uri" class="col-sm-2 control-label">路径</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="uri" name="uri" value="{{ $permission->uri }}" class="form-control uri" placeholder="请输入路径">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="uri" class="col-sm-2 control-label">菜单栏显示</label>
        <div class="col-sm-8">
            <select name="visit" id="visit" class="select2 form-control">
                <option value='1' {{ $permission->visit == 1?'selected':"" }}>是</option>
                <option value='0' {{ $permission->visit == 0?'selected':"" }}>否</option>
            </select>
        </div>
    </div>
@else
    <div class="form-group">
        <label for="parent_id" class="col-sm-2 control-label">父级菜单</label>
        <div class="col-sm-8">
            <select name="parent_id" id="parent_id" class="select2 form-control">
                <option value=''>根菜单</option>
                @forelse($permissions as $top)
                    <option value="{{ $top['id'] }}">{{ $top['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">权限名称</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" value="" class="form-control title" placeholder="请输入权限名称">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="order" class="col-sm-2 control-label">排序</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="order" name="order" value="" class="form-control title" placeholder="请输入排序">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="icon" class="col-sm-2 control-label">图标</label>
        <div class="col-sm-8">
            <button class="btn btn-default" name="icon" data-iconset="fontawesome" data-icon="fa-wifi" role="iconpicker"></button>
        </div>
    </div>
    <div class="form-group">
        <label for="uri" class="col-sm-2 control-label">路径</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="uri" name="uri" value="" class="form-control uri" placeholder="请输入路径">
            </div>
        </div>
    </div>
<div class="form-group">
    <label for="uri" class="col-sm-2 control-label">菜单栏显示</label>
    <div class="col-sm-8">
        <select name="visit" id="visit" class="select2 form-control">
            <option value='1'>是</option>
            <option value='0'>否</option>
        </select>
    </div>
</div>
@endif
@push('css')
<link rel="stylesheet" href="{{ asset('/packages/admin/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css') }}">
@endpush
@push('js')
<script src="{{ asset('/packages/admin/bootstrap-iconpicker/dist/js/bootstrap-iconpicker-iconset-all.min.js') }}"></script>
<script src="{{ asset('/packages/admin/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js') }}"></script>

@endpush