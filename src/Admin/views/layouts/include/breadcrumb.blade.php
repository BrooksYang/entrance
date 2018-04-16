<div class="sub-board">
    <span class="header-icon"><i class="fontello-home"></i>
    </span>

    {{-- Bredcrumb --}}
    <ol class="breadcrumb newcrumb ng-scope">
        <li>
            <a href="/"><span></span>dashboard</a>
        </li>
        @if ($breadcrumb)
            <li>
                <a href="javascript:;">{{ @$breadcrumb->module->group->name ?: @$breadcrumb->group->name }}</a>
            </li>
            @if (@$breadcrumb->module)
                <li>
                    <a href="javascript:;">{{ @$breadcrumb->module->name }}</a>
                </li>
            @endif
            <li>
                <a href="{{ url(Request::path()) }}">{{ @$breadcrumb->name }}</a>
            </li>
        @endif
    </ol>

    {{-- Search --}}
    {{--<div class="dark" style="visibility: visible;">--}}
        {{--<form class="navbar-form navbar-left" role="search">--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" name="keyword" value="{{ Request::get('keyword') }}"--}}
                       {{--class="form-control search rounded id_search" placeholder="Search">--}}
            {{--</div>--}}
        {{--</form>--}}
    {{--</div>--}}
</div>
