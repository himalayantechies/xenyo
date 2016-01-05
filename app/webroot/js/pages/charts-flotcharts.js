var ChartsFlotcharts = function() {

    return {
        //main function to initiate the module

        init: function() {
            Metronic.addResizeHandler(function() {
                Charts.initPieCharts();
            });
        },

        initCharts: function(chart_data, xaxis_label) {
            if (!jQuery.plot) {
            	alert('noo plot');
                return;
            }

            var data = [];
            var totalPoints = 250;

            //Interactive Chart
            function monthly_report(chart_data, xaxis_label) {
                if ($('#monthly_report').size() != 1) {
                    return;
                }

                var plot = $.plot($("#monthly_report"), chart_data, {
                    series: {
                        lines: {
                            show		: true,
                            lineWidth	: 2,
                            fill		: false,
                            fillColor	: {
                                colors: [{
                                    opacity: 0.05
                                }, {
                                    opacity: 0.01
                                }]
                            }
                        },
                        points: {
                            show		: true,
                            radius		: 3,
                            lineWidth	: 1
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable	: true,
                        clickable	: true,
                        tickColor	: "#eee",
                        borderColor	: "#eee",
                        borderWidth	: 1
                    },
                    colors: ["#d12610", "#37b7f3", "#52e136"],
                    xaxis: {
                        axisLabel		: 'Months',
                        ticks			: xaxis_label,
                    },
                });

                function showTooltip(x, y, contents) {
                    $('<div id="tooltip">' + contents + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 15,
                        border: '1px solid #333',
                        padding: '4px',
                        color: '#fff',
                        'border-radius': '3px',
                        'background-color': '#333',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
                }

                var previousPoint = null;
                $("#monthly_report").bind("plothover", function(event, pos, item) {
                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));

                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);

                            showTooltip(item.pageX, item.pageY, item.series.label + " of " + x + " = " + y);
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }

            monthly_report(chart_data, xaxis_label);
        },
    };
}();