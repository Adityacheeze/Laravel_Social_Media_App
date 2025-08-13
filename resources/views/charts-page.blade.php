<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('getChart') }}",
            success: function(response) {
                $data = response.data;
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Desktop Search Engine Market Share - 2016"
                    },
                    data: [{
                        type: "pie",
                        startAngle: 240,
                        yValueFormatString: "##0.00\"%\"",
                        indexLabel: "{label} {y}",
                        dataPoints: $data,
                    }]
                });
                chart.render();
            },
            error: function(xhr) {
                console.error(xhr);
            }
        })
        $.ajax({
            type: "GET",
            url: "{{ URL::to('getChart2') }}",
            success: function(response) {
                $data = response.data;
                var chart = new CanvasJS.Chart("chartContainer2", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Top Oil Reserves"
                    },
                    axisY: {
                        title: "Reserves(MMbbl)"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "MMbbl = one million barrels",
                        dataPoints: $data,
                    }]
                });
                chart.render();
            },
            error: function(xhr) {
                console.error(xhr);
            }
        })
        $.ajax({
            type: "GET",
            url: "{{ URL::to('getChart3') }}",
            success: function(response) {
                $data = response.data;
                var chart = new CanvasJS.Chart("chartContainer3", {
                    animationEnabled: true,
                    zoomEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Employment in Agriculture vs Agri-Land and Population"
                    },
                    axisX: {
                        title: "Employment - Agriculture",
                        suffix: "%",
                        minimum: 0,
                        maximum: 61,
                        gridThickness: 1
                    },
                    axisY: {
                        title: "Agricultural Land (million sq.km)",
                        suffix: "mn"
                    },
                    data: [{
                        type: "bubble",
                        toolTipContent: "<b>{name}</b><br/>Employment: {x}% <br/> Agri-Land: {y}mn sq. km<br/> Population: {z}mn",
                        dataPoints: $data,
                    }]
                });
                chart.render();

            },
            error: function(xhr) {
                console.error(xhr);
            }
        })
        $.ajax({
            type: "GET",
            url: "{{ URL::to('getChart4') }}",
            success: function(response) {
                $data = response.data;
                var options = {
                    chart: {
                        type: 'rangeBar',
                        height: "250px",
                        width: '100%',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            barHeight: '10%'
                        }
                    },
                    series: [{
                        data: $data,
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#chartContainer4"), options);
                chart.render();
            },
            error: function(xhr) {
                console.error(xhr);
            }
        })
    })
</script>

<body>
    <div class="container-fluid">
        <div class="row m-3">
            <h1 class="text-center">CHART GALLERY</h1>
        </div>
        <div class="row justify-content-center">
            <div id="chartContainer" class="col-md-6 col-12 mb-3" style="height: 300px;"></div>
            <div id="chartContainer2" class="col-md-6 col-12 mb-3" style="height: 300px;"></div>
        </div>
    </div>
    <div id="chartContainer3" style="height: 300px; width: 100%;"></div>
    <div id="chartContainer4" style="height: 300px; width: 100%;"></div>

</body>

</html>
