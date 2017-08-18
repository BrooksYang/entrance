    <!-- TOPNAV -->

    <div class="row">
        <div class="col-lg-3">
            <ul class="nav navbar-nav navbar-left list-unstyled list-inline text-amber date-list">
                <li><i class="fontello-th text-amber"></i>
                </li>
                <li id="Date"></li>
            </ul>
            <ul class="nav navbar-nav navbar-left list-unstyled list-inline text-amber date-list">
                <li><i class="fontello-stopwatch text-amber"></i>
                </li>
                <li id="hours"></li>
                <li class="point">:</li>
                <li id="min"></li>
                <li class="point">:</li>
                <li id="sec"></li>
            </ul>


        </div>
        <div class="col-lg-6">
            <div style="margin-bottom:0;" class="alert text-white ">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <span class="entypo-info-circled"></span>
                <strong>系统欢迎消息</strong>&nbsp;&nbsp;您可以在这里发布系统欢迎或者提醒消息
            </div>
        </div>

        <div class="col-lg-3">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle text-white" href="#">
                        <img alt="" class="admin-pic img-circle" src="http://api.randomuser.me/portraits/thumb/men/23.jpg">Hi,{{ isset($user)?$user->name:"user" }}  <b class="caret"></b>
                    </a>
                    <ul style="margin:25px 15px 0 0;" role="menu" class="dropdown-setting dropdown-menu bg-amber">
                        <li>
                            <a href="#">
                                <span class="entypo-user"></span>&nbsp;&nbsp;个人资料</a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="entypo-vcard"></span>&nbsp;&nbsp;账号管理</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>

    </div>
    <!-- END OF TOPNAV -->