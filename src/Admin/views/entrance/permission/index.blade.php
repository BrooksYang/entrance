@extends('entrance::layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    {{-- Add Button --}}
                    <div class="pull-right box-tools">
                        <a href="{{ url('auth/permissions/create') }}">
                            <span class="box-btn"><i class="fa fa-plus"></i></span>
                        </a>
                    </div>

                    {{-- Title --}}
                    <h3 class="box-title"><i class="fontello-doc"></i>
                        <span>系统权限列表</span>
                    </h3>
                </div>

                {{-- Table --}}
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>序号</th>
                                <th>标题</th>
                                <th>描述</th>
                                <th>模块</th>
                                <th>板块</th>
                                <th>请求方法</th>
                                <th>URI</th>
                                <th>是否可见</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            @foreach($permissions as $key => $item)
                                <tr>
                                    <td>{{ ($key + 1) + ($permissions->currentPage() - 1) * $permissions->perPage() }}</td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ @$item->module->name }}</td>
                                    <td>{{ @$item->group->name ?: @$item->module->group->name }}</td>
                                    <td>
                                        @if ($item->method == 'GET')
                                            <span class="label label-primary">{{ $item->method }}</span>
                                        @elseif ($item->method == 'POST')
                                            <span class="label label-success">{{ $item->method }}</span>
                                        @elseif (in_array($item->method, ['PUT', 'PATCH']))
                                            <span class="label label-warning">{{ $item->method }}</span>
                                        @elseif ($item->method == 'DELETE')
                                            <span class="label label-danger">{{ $item->method }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->uri }}</td>
                                    <td>
                                        @if ($item->is_visible)
                                            <span class="label label-success">是</span>
                                        @else
                                            <span class="label label-danger">否</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url("auth/permissions/$item->id/edit") }}">
                                            <i class="fontello-edit" title="编辑"></i>
                                        </a>
                                        <a href="javascript:;" onclick="itemDelete('{{ $item->id }}',
                                                '{{ url("auth/permissions/$item->id") }}',
                                                '{{ csrf_token() }}');">
                                            <i class="fontello-trash-2" title="删除"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{-- Paginaton --}}
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-right">
                                    {{ $permissions->appends(Request::except('page'))->links() }}
                                </div>
                            </div>
                        </div>
                        {{-- Paginaton End --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
