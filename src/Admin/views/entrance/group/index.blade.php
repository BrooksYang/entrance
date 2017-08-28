@extends('entrance::layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    {{-- Add Button --}}
                    <div class="pull-right box-tools">
                        <a href="{{ url('auth/groups/create') }}">
                            <span class="box-btn"><i class="fa fa-plus"></i></span>
                        </a>
                    </div>

                    {{-- Title --}}
                    <h3 class="box-title"><i class="fontello-doc"></i>
                        <span>系统板块列表</span>
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
                                <th>排序</th>
                                <th>创建时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            @foreach($groups as $key => $item)
                                <tr>
                                    <td>{{ ($key + 1) + ($groups->currentPage() - 1) * $groups->perPage() }}</td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->order }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        {{-- Edit --}}
                                        <a href="{{ url("auth/groups/$item->id/edit") }}">
                                            <i class="fontello-edit" title="编辑"></i>
                                        </a>

                                        {{-- Move Up --}}
                                        <a href="{{ url("auth/groups/$item->id/move/up") }}">
                                            <i class="icon-arrow-up" title="上移"></i>
                                        </a>

                                        {{-- Move Down --}}
                                        <a href="{{ url("auth/groups/$item->id/move/down") }}">
                                            <i class="icon-arrow-down" title="下移"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <a href="javascript:;" onclick="itemDelete('{{ $item->id }}',
                                                '{{ url("auth/groups/$item->id") }}',
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
                                    {{ $groups->appends(Request::except('page'))->links() }}
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
