@extends('entrance::layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box" style="min-height: 500px">
                <div class="box-header">
                    {{-- Title --}}
                    <h3 class="box-title">
                        <span>{{ @$editFlag ? '编辑模块' : '添加模块' }}</span>
                    </h3>
                </div>

                {{-- Form --}}
                <div class="box-body">
                    <form class="form form-horizontal" role="form" method="POST" action="{{ @$editFlag ? url("auth/modules/$module->id") : url('auth/modules') }}">
                        {{ csrf_field() }}
                        {{ @$editFlag ? method_field('PATCH') : '' }}

                        {{-- Name --}}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <input class="form-control input-lg" type="text" name="name" value="{{ $module->name ?? old('name') }}"
                                       placeholder="模块名称">
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Icon --}}
                        <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <input class="form-control input-lg" type="text" name="icon" value="{{ @$module->icon ?: old('icon') ?: 'fa fa-sun-o' }}"
                                       placeholder="菜单图标">
                                @if ($errors->has('icon'))
                                    <span class="help-block"><strong>{{ $errors->first('icon') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Group --}}
                        <div class="form-group {{ $errors->has('group_id') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <select class="form-control" name="group_id">
                                    <option value="">请选择模块区域</option>
                                    @foreach($groups as $key => $item)
                                        <option value="{{ $item->id }}" {{ (@$module->group_id == $item->id || old('group_id') == $item->id) ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('group_id'))
                                    <span class="help-block"><strong>{{ $errors->first('group_id') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="description" rows="5"
                                          placeholder="模块简介">{{ $module->description ?? old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="{{ url('auth/modules') }}" class="btn btn-default">返回</a>
                                <button type="submit" class="btn btn-default pull-right">确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
