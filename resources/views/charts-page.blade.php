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

<body>
    <div class="container-fluid">
        <div class="row m-3">
            <h1 class="text-center">CHART GALLERY</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ URL::to('/feed-page') }}">
                <div class="btn btn-info p-2 m-2">Back To Feed</div>
            </a>
        </div>
        <div class="row justify-content-center">
            <div id="chartContainer" class="col-md-6 col-12 mb-3" style="height: 300px;"></div>
            <div id="chartContainer2" class="col-md-6 col-12 mb-3" style="height: 300px;"></div>
        </div>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" value="" id="checkNativeSwitch" switch>
        <label class="form-check-label" for="checkNativeSwitch">
            Change Data
        </label>
    </div>
    <div id="chartContainer3" style="height: 300px; width: 100%;"></div>
    <div id="chartContainer4" style="height: 300px; width: 100%;"></div>
    <script>
        const routes = {
            chart1: "{{ URL::to('getChart1') }}",
            chart2: "{{ URL::to('getChart2') }}",
            chart3: "{{ URL::to('getChart3') }}",
            chart4: "{{ URL::to('getChart4') }}",
        };
        const tokens = {
            csrfToken: "{{ csrf_token() }}",
        };
    </script>
    <script src="{{ asset('public/scripts/charts-page.js') }}"></script>
</body>

</html>
