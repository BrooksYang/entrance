<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--   <meta content="IE=edge" http-equiv="X-UA-Compatible"> -->
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <link href="{{ asset('ico/favicon.ico') }}" rel="shortcut icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/bootstrap.css') }}">
    <!-- Bootstrap theme -->
    <!--  <link rel="stylesheet" href="{{ asset('vendor/entrance') }}/css/bootstrap-theme.min.css"> -->

    @section('css-import')
    @show

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/dripicon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/typicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/entrance/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/entrance/js/tip/tooltipster.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/entrance/js/vegas/jquery.vegas.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/entrance/js/number-progress-bar/number-pb.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/entrance/js/layer/skin/default/layer.css') }}">
    <!-- pace loader -->
    <script src="{{ asset('vendor/entrance/js/pace/pace.js') }}"></script>
    <link href="{{ asset('vendor/entrance/js/pace/themes/orange/pace-theme-flash.css') }}" rel="stylesheet" />

    @section('js-import')
    @show



    @section('css-part')
        <style>
            a:hover, a:focus { text-decoration: none }
        </style>
    @show
</head>

<body role="document">

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    @include('entrance::layouts.include.top_nav')
    <!-- Container -->
    <div class="container-fluid paper-wrap bevel tlbr">
        <div id="paper-top">
            <div class="row">
                <div class="col-sm-3 no-pad">
                    <a class="navbar-brand logo-text" href="#">{{ config('app.name', 'Laravel') }}</a>
                </div>
            </div>
        </div>
        <!-- SIDE MENU -->

        <div class="wrap-sidebar-content">

            @include('entrance::layouts.include.side_menu')
            @include('entrance::layouts.include.breadcrumb')

            <!-- CONTENT -->
            <div class="wrap-fluid" id="paper-bg">
                @section('content')

                @show
            </div>
            <!-- #/paper bg -->
        </div>
        <!-- ./wrap-sidebar-content -->

        <!-- / END OF CONTENT -->

        <!-- FOOTER -->
        <div id="footer">
            <div class="devider-footer-left"></div>
            <div class="time">
                <p id="spanDate"></p>
                <p id="clock"></p>
            </div>
            <div class="copyright">Copyright &copy; 2014
                <a href="http://ndesaintheme.com/">
                    {{ config('app.copyright', 'Laravel') }}
                </a> Made with
                <i class="fontello-heart-filled text-red"></i>
            </div>
            <div class="devider-footer"></div>
            <ul>
                <li><i class="fa fa-facebook-square"></i>
                </li>
                <li><i class="fa fa-twitter-square"></i>
                </li>
                <li><i class="fa fa-instagram"></i>
                </li>
            </ul>
        </div>
        <!-- / FOOTER -->
    </div>
    <!-- Container -->

    <!--
    ================================================== -->
    <!-- Main jQuery Plugins -->
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/jquery.js') }}"></script>

    <script type='text/javascript' src="{{ asset('vendor/entrance/js/bootstrap.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/date.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/slimscroll/jquery.slimscroll.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/jquery.nicescroll.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/sliding-menu.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/scriptbreaker-multiple-accordion-1.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/tip/jquery.tooltipster.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/donut-chart/jquery.drawDoughnutChart.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/tab/jquery.newsTicker.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/tab/app.ticker.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/app.js') }}"></script>


    <script type='text/javascript' src="{{ asset('vendor/entrance/js/vegas/jquery.vegas.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/image-background.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/entrance/js/jquery.tabSlideOut.v1.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/entrance/js/bg-changer.js') }}"></script>

    <script type='text/javascript' src="{{ asset('vendor/entrance/js/number-progress-bar/jquery.velocity.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('vendor/entrance/js/number-progress-bar/number-pb.js') }}"></script>
    <script src="{{ asset('vendor/entrance/js/loader/loader.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/entrance/js/loader/demo.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('vendor/entrance/js/skycons/skycons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/entrance/js/layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/entrance/js/bootbox.min.js') }}"></script>
    <!-- Page script -->

    <!-- TAB SLIDER -->

    {{-- custom Js--}}
    <script src="{{ asset('vendor/entrance/js/custom.js') }}"></script>


    <script>
    //Weather Icons
    (function($) {
        "use strict";
        var icons = new Skycons({
                "stroke": 0.08,
                "color": "Gray",
                "cloudColor": "#65C3DF",
                "sunColor": "#0090d9",
                "moonColor": "DodgerBlue",
                "rainColor": "RoyalBlue",
                "snowColor": "LightGray",
                "windColor": "LightSteelBlue",
                "fogColor": "#65C3DF"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    })(jQuery);

    //Animation Slider
    $(function() {
        function randomPercentage() {
            return Math.floor(Math.random() * 100);
        }

        function randomInterval() {
            var min = Math.floor(Math.random() * 30);
            var max = min + (Math.floor(Math.random() * 40) + 70);
            return [min, max];
        }

        function randomStep() {
            return Math.floor(Math.random() * 10) + 5;
        }

        // setup
        var $basic = $('#basic');
        var interval = randomInterval();
        var basicBar = $basic.find('.number-pb').NumberProgressBar({
            style: 'basic',
            min: interval[0],
            max: interval[1]
        })
        $basic.find('.title span').text('[Min: ' + interval[0] + ', Max: ' + interval[1] + ']');

        var percentageBar = $('#percentage .number-pb').NumberProgressBar({
            style: 'percentage'
        })

        var $step = $('#step');
        var maxStep = randomStep()
        var stepBar = $('#step .number-pb').NumberProgressBar({
            style: 'step',
            max: maxStep
        })
        $step.find('.title span').text('[Max step: ' + maxStep + ']');

        // loop
        var basicLoop = function() {
            basicBar.reach(undefined, {
                complete: percentageLoop
            });
        }

        var percentageLoop = function() {
            percentageBar.reach(undefined, {
                complete: stepLoop
            });
        }

        var stepLoop = function() {
            stepBar.reach(undefined, {
                complete: basicLoop
            });
        }

        // start
        basicLoop();
    });
    </script>

    @section('js-part')

    @show
</body>
</html>
