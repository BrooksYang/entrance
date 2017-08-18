<!-- SIDE MENU -->
<div class="wrap-sidebar-content">
    <div id="skin-select">
        <a id="toggle">
            <span class="fa icon-menu"></span>
        </a>

        <div class="skin-part">
            <div id="tree-wrap">
                <div class="side-bar">
                    <ul id="menu-showhide" class="topnav">
                        {{-- Dashboard --}}
                        <li class="devider-title">
                            <h3>
                                <span>Dashboard</span>
                            </h3>
                        </li>
                        <li>
                            <a href="{{ url('') }}" title="Dashboard">
                                <i class="fa fa-tachometer"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        {{-- Groups --}}
                        @foreach (Auth::user()->menus() as $group)
                            <li class="devider-title">
                                <h3>
                                    <span>{{ $group->name }}</span>
                                </h3>
                            </li>

                            {{-- Modules --}}
                            @foreach ($group->modules as $module)
                                <li>
                                    {{-- Module Title --}}
                                    <a class="tooltip-tip" href="#" title="Layout">
                                        <i class="{{ $module->icon }}"></i>
                                        <span>{{ $module->name }}</span>
                                    </a>

                                    {{-- Permissions --}}
                                    <ul>
                                        @foreach ($module->permissions as $permission)
                                            <li class="{{ @$breadcrumb->module_id == $module->id ? 'active' : '' }}">
                                                <a href="{{ url($permission->uri) }}" title="Index"
                                                   style="{{ Request::route()->uri() == $permission->uri ? 'color: #5F9BDB!important;' : '' }} ">
                                                    {{ $permission->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    {{-- Permissions End --}}

                                </li>
                            @endforeach
                            {{-- Modules End --}}

                            <li class="devider-horizontal"></li>
                        @endforeach
                        {{-- Groups End --}}
                    </ul>

                    <div class="side-dash">
                        <div id="doughnutChart" class="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
