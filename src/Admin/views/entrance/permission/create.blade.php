@extends('entrance::layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    {{-- Title --}}
                    <h3 class="box-title">
                        <span>{{ @$editFlag ? '编辑权限' : '添加权限' }}</span>
                    </h3>
                </div>

                {{-- Form --}}
                <div class="box-body">
                    <form class="form form-horizontal" role="form" method="POST" action="{{ @$editFlag ? url("auth/permissions/$permission->id") : url('auth/permissions') }}">
                        {{ csrf_field() }}
                        {{ @$editFlag ? method_field('PATCH') : '' }}

                        {{-- Name --}}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <input class="form-control input-lg" type="text" name="name" value="{{ $permission->name ?? old('name') }}"
                                       placeholder="权限名称">
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Type --}}
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="0" id="moduleRadio" {{ !old('type') ? 'checked' : '' }}>
                                        模块
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="type" value="1" id="groupRadio" {{ (old('type') || @$permission->group_id) ? 'checked' : '' }}>
                                        板块
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Module --}}
                        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}" id="moduleForm"
                             style="display: {{ (old('type') || @$permission->group_id) ? 'none' : 'block' }}">
                            <div class="col-sm-12">
                                <select class="form-control" name="module_id">
                                    <option value="">请选择模块</option>
                                    @foreach($modules as $key => $item)
                                        <option value="{{ $item->id }}" {{ (@$permission->module_id == $item->id || old('module_id') == $item->id) ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('module_id'))
                                    <span class="help-block"><strong>{{ $errors->first('module_id') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Group --}}
                        <div class="form-group {{ $errors->has('group_id') ? 'has-error' : '' }}" id="groupForm"
                             style="display: {{ (old('type') || @$permission->group_id) ? 'block' : 'none' }}">
                            <div class="col-sm-12">
                                <select class="form-control" name="group_id" id="group">
                                    <option value="">请选择板块</option>
                                    @foreach($groups as $key => $item)
                                        <option value="{{ $item->id }}" {{ (@$permission->group_id == $item->id || old('group_id') == $item->id) ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('group_id'))
                                    <span class="help-block"><strong>{{ $errors->first('group_id') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Icon --}}
                        <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}" id="iconForm"
                             style="display: {{ (old('type') || @$permission->group_id) ? 'block' : 'none' }}">
                            <div class="col-sm-12">
                                <input class="form-control input-lg" type="text" name="icon" value="{{ @$permission->icon ?: old('icon') ?: 'fa fa-sun-o' }}"
                                       placeholder="菜单图标">
                                @if ($errors->has('icon'))
                                    <span class="help-block"><strong>{{ $errors->first('icon') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Method --}}
                        <div class="form-group {{ $errors->has('method') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <select class="form-control" name="method">
                                    @foreach($methods as $value)
                                        <option value="{{ $value }}" {{ (@$permission->method == $value || old('method') == $value) ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('method'))
                                    <span class="help-block"><strong>{{ $errors->first('method') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- URI --}}
                        <div class="form-group {{ $errors->has('uri') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <input class="form-control input-lg" type="text" name="uri" value="{{ $permission->uri ?? old('uri') }}"
                                       placeholder="URI">
                                @if ($errors->has('uri'))
                                    <span class="help-block"><strong>{{ $errors->first('uri') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Visible --}}
                        <div class="form-group {{ $errors->has('is_visible') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_visible" value="1" checked>
                                        可见
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="is_visible" value="0" {{ (old('is_visible') === 0 || @$permission->is_visible === 0) ? 'checked' : '' }}>
                                        不可见
                                    </label>
                                </div>
                                @if ($errors->has('is_visible'))
                                    <span class="help-block"><strong>{{ $errors->first('is_visible') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="description" rows="5"
                                          placeholder="权限简介">{{ $permission->description ?? old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="{{ url('auth/permissions') }}" class="btn btn-default">返回</a>
                                <button type="submit" class="btn btn-default pull-right">确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-part')
    <script>
        $('#groupRadio').click(function () {
            $('#moduleForm').hide();
            $('#groupForm').show();
            $('#iconForm').show();
        });

        $('#moduleRadio').click(function () {
            $('#groupForm').hide();
            $('#iconForm').hide();
            $('#moduleForm').show();
        });
    </script>
@endsection
