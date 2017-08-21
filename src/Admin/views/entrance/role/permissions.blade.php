@extends('entrance::layouts.default')

@section('content')
    <div class="row">
        <form action="{{ url("auth/roles/$roleId/permissions") }}" method="post">
            {!! csrf_field() !!}

            {{-- Submit --}}
            <div class="col-lg-12">
                <p>
                    <button type="submit" class="btn btn-info">更新</button>
                </p>
            </div>

            @foreach($groups as $group)
                @if (!$group->permissions->isEmpty())
                    <div class="col-lg-4">
                        <div class="box">
                            {{-- Module Name --}}
                            <div class="box-header">
                                <h3 class="box-title">
                                    <span>{{ $group->name }}</span>
                                </h3>
                            </div>

                            {{-- Permissions --}}
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="checkbox">
                                            @foreach($group->permissions as $permission)
                                                <label>
                                                    <input type="checkbox" name="permissions[]"
                                                           value="{{ $permission->id }}"
                                                            {{ in_array($permission->id, $permissionIds) ? 'checked' : '' }} >
                                                    {{ $permission->name }}
                                                </label>&nbsp;&nbsp;
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Permission End --}}

                        </div>
                    </div>
                @endif
            @endforeach

            @foreach($modules as $module)
                <div class="col-lg-4">
                    <div class="box">
                        {{-- Module Name --}}
                        <div class="box-header">
                            <h3 class="box-title">
                                <span>{{ $module->name }}</span>
                            </h3>
                        </div>

                        {{-- Permissions --}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="checkbox">
                                        @foreach($module->permissions as $permission)
                                            <label>
                                                <input type="checkbox" name="permissions[]"
                                                       value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $permissionIds) ? 'checked' : '' }} >
                                                {{ $permission->name }}
                                            </label>&nbsp;&nbsp;
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Permission End --}}

                    </div>
                </div>
            @endforeach
        </form>
    </div>
@endsection
