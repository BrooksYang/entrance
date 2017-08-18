@extends('entrance::layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box" style="min-height: 500px">
                <div class="box-header">
                    {{-- Title --}}
                    <h3 class="box-title">
                        <span>{{ @$editFlag ? '编辑板块' : '添加板块' }}</span>
                    </h3>
                </div>

                {{-- Form --}}
                <div class="box-body">
                    <form class="form form-horizontal" role="form" method="POST" action="{{ @$editFlag ? url("auth/groups/$group->id") : url('auth/groups') }}">
                        {{ csrf_field() }}
                        {{ @$editFlag ? method_field('PATCH') : '' }}

                        {{-- Name --}}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <input class="form-control input-lg" type="text" name="name" value="{{ $group->name ?? old('name') }}"
                                       placeholder="板块名称">
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="description" rows="5"
                                          placeholder="板块简介">{{ $group->description ?? old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="{{ url('auth/groups') }}" class="btn btn-default">返回</a>
                                <button type="submit" class="btn btn-default pull-right">确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
