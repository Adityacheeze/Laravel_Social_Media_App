$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: routes.chart1,
        success: function (response) {
            $data = response.data;
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Desktop Search Engine Market Share - 2016",
                },
                data: [
                    {
                        type: "pie",
                        startAngle: 240,
                        yValueFormatString: '##0.00"%"',
                        indexLabel: "{label} {y}",
                        dataPoints: $data,
                    },
                ],
            });
            chart.render();
        },
        error: function (xhr) {
            console.error(xhr);
        },
    });
    $.ajax({
        type: "GET",
        url: routes.chart2,
        success: function (response) {
            $data = response.data;
            var chart = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Top Oil Reserves",
                },
                axisY: {
                    title: "Reserves(MMbbl)",
                },
                data: [
                    {
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "MMbbl = one million barrels",
                        dataPoints: $data,
                    },
                ],
            });
            chart.render();
        },
        error: function (xhr) {
            console.error(xhr);
        },
    });
    function loadChart($flagValue) {
        $.ajax({
            type: "POST",
            url: routes.chart3,
            data: {
                _token: tokens.csrfToken,
                flag: $flagValue,
            },
            success: function (response) {
                $data = response.data;
                var chart = new CanvasJS.Chart("chartContainer3", {
                    animationEnabled: true,
                    zoomEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Employment in Agriculture vs Agri-Land and Population",
                    },
                    axisX: {
                        title: "Employment - Agriculture",
                        suffix: "%",
                        minimum: 0,
                        maximum: 100,
                        gridThickness: 1,
                    },
                    axisY: {
                        title: "Agricultural Land (million sq.km)",
                        suffix: "mn",
                    },
                    data: [
                        {
                            type: "bubble",
                            toolTipContent:
                                "<b>{name}</b><br/>Employment: {x}% <br/> Agri-Land: {y}mn sq. km<br/> Population: {z}mn",
                            dataPoints: $data,
                        },
                    ],
                });
                chart.render();
            },
            error: function (xhr) {
                console.error(xhr);
            },
        });
    }
    loadChart(0);
    $("#checkNativeSwitch").click(function () {
        let flagValue = $(this).is(":checked") ? 1 : 0;
        loadChart(flagValue);
    });
    $.ajax({
        type: "GET",
        url: routes.chart4,
        success: function (response) {
            var data1 = response.data[0];
            var data2 = response.data[1];
            var options = {
                chart: {
                    colors: ["#2E93fA", "#66DA26", "#546E7A"],
                    type: "rangeBar",
                    height: "250px",
                    width: "100%",
                    zoom: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: "10%",
                    },
                },
                xaxis: {
                    min: 0,
                    max: 100,
                    tickAmount: 5,
                    labels: {
                        formatter: function (val) {
                            return val + "%";
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                },
                legend: {
                    position: "bottom",
                },
                series: [
                    {
                        name: "name 1",
                        data: data1,
                    },
                    {
                        name: "name 2",
                        data: data2,
                    },
                ],
            };

            var chart = new ApexCharts(
                document.querySelector("#chartContainer4"),
                options
            );
            chart.render();
        },
        error: function (xhr) {
            console.error(xhr);
        },
    });
});
