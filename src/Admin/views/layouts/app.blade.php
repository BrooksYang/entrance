<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--   <meta content="IE=edge" http-equiv="X-UA-Compatible"> -->
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <link href="{{ url('ico/favicon.ico') }}" rel="shortcut icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/bootstrap.css') }}">
    <!-- Bootstrap theme -->
    <!--  <link rel="stylesheet" href="{{ url('vendor/entrance') }}/css/bootstrap-theme.min.css"> -->

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/theme.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/dripicon.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/typicons.css') }}" />
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ url('vendor/entrance/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/entrance/js/tip/tooltipster.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('vendor/entrance/js/vegas/jquery.vegas.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('vendor/entrance/js/number-progress-bar/number-pb.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/entrance/js/layer/skin/default/layer.css') }}">
    <!-- pace loader -->
    <script src="{{ url('vendor/entrance/js/pace/pace.js') }}"></script>
    <link href="{{ url('vendor/entrance/js/pace/themes/orange/pace-theme-flash.css') }}" rel="stylesheet" />

    @section('css-part')

    @show
</head>

<body role="document">

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <!-- Container -->
    @section('content')

    @show
    <!-- Container -->

    <!--
    ================================================== -->
    <!-- Main jQuery Plugins -->
    <script type='text/javascript' src="{{ url('vendor/entrance/js/jquery.js') }}"></script>

    <script type='text/javascript' src="{{ url('vendor/entrance/js/bootstrap.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/date.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/slimscroll/jquery.slimscroll.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/jquery.nicescroll.min.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/sliding-menu.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/scriptbreaker-multiple-accordion-1.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/tip/jquery.tooltipster.min.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/donut-chart/jquery.drawDoughnutChart.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/tab/jquery.newsTicker.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/tab/app.ticker.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/app.js') }}"></script>


    <script type='text/javascript' src="{{ url('vendor/entrance/js/vegas/jquery.vegas.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/image-background.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/entrance/js/jquery.tabSlideOut.v1.3.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/entrance/js/bg-changer.js') }}"></script>

    <script type='text/javascript' src="{{ url('vendor/entrance/js/number-progress-bar/jquery.velocity.min.js') }}"></script>
    <script type='text/javascript' src="{{ url('vendor/entrance/js/number-progress-bar/number-pb.js') }}"></script>
    <script src="{{ url('vendor/entrance/js/loader/loader.js') }}" type="text/javascript"></script>
    <script src="{{ url('vendor/entrance/js/loader/demo.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ url('vendor/entrance/js/skycons/skycons.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/entrance/js/layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/entrance/js/bootbox.min.js') }}"></script>

    <!-- FLOT CHARTS -->
    <script src="{{ url('vendor/entrance/js/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="{{ url('vendor/entrance/js/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="{{ url('vendor/entrance/js/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="{{ url('vendor/entrance/js/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
    <!-- Page script -->

    <!-- TAB SLIDER -->

    {{-- custom Js--}}
    <script src="{{ url('vendor/entrance/js/custom.js') }}"></script>


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

    <script type="text/javascript">
    $(function() {
        "use strict";
        /*
         * Flot Interactive Chart
         * -----------------------
         */
        // We use an inline data source in the example, usually data would
        // be fetched from a server
        var data = [],
            totalPoints = 100;

        function getRandomData() {

            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk
            while (data.length < totalPoints) {

                var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y = prev + Math.random() * 10 - 5;

                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }

                data.push(y);
            }

            // Zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            return res;
        }

        var interactive_plot = $.plot("#interactive", [getRandomData()], {
            grid: {
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0, // Drawing is faster without shadows
                color: "#03B2B4"
            },
            lines: {
                fill: true, //Converts the line chart to area chart
                color: "#03B2B4"
            },
            yaxis: {
                min: 0,
                max: 100,
                show: true
            },
            xaxis: {
                show: true
            }
        });

        var updateInterval = 500; //Fetch data ever x milliseconds
        var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching
        function update() {

            interactive_plot.setData([getRandomData()]);

            // Since the axes don't change, we don't need to call plot.setupGrid()
            interactive_plot.draw();
            if (realtime === "on")
                setTimeout(update, updateInterval);
        }

        //INITIALIZE REALTIME DATA FETCHING
        if (realtime === "on") {
            update();
        }
        //REALTIME TOGGLE
        $("#realtime .btn").click(function() {
            if ($(this).data("toggle") === "on") {
                realtime = "on";
            } else {
                realtime = "off";
            }
            update();
        });
        /*
         * END INTERACTIVE CHART
         */


        /*
         * LINE CHART
         * ----------
         */
        //LINE randomly generated data

        var sin = [],
            cos = [];
        for (var i = 0; i < 14; i += 0.5) {
            sin.push([i, Math.sin(i)]);
            cos.push([i, Math.cos(i)]);
        }
        var line_data1 = {
            data: sin,
            color: "#3c8dbc"
        };
        var line_data2 = {
            data: cos,
            color: "#03B2B4"
        };
        $.plot("#line-chart", [line_data1, line_data2], {
            grid: {
                hoverable: true,
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            lines: {
                fill: false,
                color: ["#3c8dbc", "#f56954"]
            },
            yaxis: {
                show: true,
            },
            xaxis: {
                show: true
            }
        });
        //Initialize tooltip on hover
        $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
            position: "absolute",
            display: "none",
            opacity: 0.8
        }).appendTo("body");
        $("#line-chart").bind("plothover", function(event, pos, item) {

            if (item) {
                var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);

                $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                    .css({
                        top: item.pageY + 5,
                        left: item.pageX + 5
                    })
                    .fadeIn(200);
            } else {
                $("#line-chart-tooltip").hide();
            }

        });
        /* END LINE CHART */

        /*
         * FULL WIDTH STATIC AREA CHART
         * -----------------
         */
        var areaData = [
            [2, 88.0],
            [3, 93.3],
            [4, 102.0],
            [5, 108.5],
            [6, 115.7],
            [7, 115.6],
            [8, 124.6],
            [9, 130.3],
            [10, 134.3],
            [11, 141.4],
            [12, 146.5],
            [13, 151.7],
            [14, 159.9],
            [15, 165.4],
            [16, 167.8],
            [17, 168.7],
            [18, 169.5],
            [19, 168.0]
        ];
        $.plot("#area-chart", [areaData], {
            grid: {
                borderWidth: 0
            },
            series: {
                shadowSize: 0, // Drawing is faster without shadows
                color: "#00c0ef"
            },
            lines: {
                fill: true //Converts the line chart to area chart                        
            },
            yaxis: {
                show: false
            },
            xaxis: {
                show: false
            }
        });

        /* END AREA CHART */

        /*
         * BAR CHART
         * ---------
         */

        var bar_data = {
            data: [
                ["January", 10],
                ["February", 8],
                ["March", 4],
                ["April", 13],
                ["May", 17],
                ["June", 9]
            ],
            color: "#3c8dbc"
        };
        $.plot("#bar-chart", [bar_data], {
            grid: {
                borderWidth: 1,
                borderColor: "#f3f3f3",
                tickColor: "#f3f3f3"
            },
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });
        /* END BAR CHART */

        /*
         * DONUT CHART
         * -----------
         */

        var donutData = [{
            label: "Series2",
            data: 30,
            color: "#3c8dbc"
        }, {
            label: "Series3",
            data: 20,
            color: "#0073b7"
        }, {
            label: "Series4",
            data: 50,
            color: "#00c0ef"
        }];
        $.plot("#donut-chart", donutData, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.5,
                    label: {
                        show: true,
                        radius: 2 / 3,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }

                }
            },
            legend: {
                show: false
            }
        });
        /*
         * END DONUT CHART
         */
    });

    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }
    </script>


    @section('js-part')

    @show
</body>
</html>
