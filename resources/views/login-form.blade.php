<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @error('loginname')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('login')
        <h5>Too many login attempts</h5>
        <h5>try again in 5 minutes</h5>
        <div id="timer"></div>
        <script>
            $(document).ready(function() {
                $(".loginBtn").addClass("disabled");
                setTimeout(() => {
                    $(".loginBtn").removeClass("disabled");
                }, 10000);
            });
        </script>
        <script>
            function decTimer() {
                var currentMinutes = Math.floor(totalSecs / 60);
                var currentSeconds = totalSecs % 60;
                if (currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
                if (currentMinutes <= 9) currentMinutes = "0" + currentMinutes;
                totalSecs--;
                if (totalSecs == 0) {
                    $("#timer").text(0 + " : " + 0);
                    {{ session('user')->attempts = 0 }}
                    {{ session('user')->save() }}
                    location.reload();
                } else {
                    $("#timer").text(currentMinutes + ":" + currentSeconds);
                    setTimeout('decTimer()', 1000);
                }
            }
            totalSecs = 10;
            $(document).ready(function() {
                decTimer();
            });
        </script>
    @enderror
    <div class="card border border-3 border-black p-4" style="width: 25rem;">
        <h3 class="text-center mb-3">Login</h3>
        <form action="{{ URL::to('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="login_name" class="form-label">Name</label>
                <input name="loginname" type="text" class="form-control" id="login_name"
                    placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="login_password" class="form-label">Password</label>
                <input name="loginpassword" type="password" class="form-control" id="login_password"
                    placeholder="Enter password">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success px-4 loginBtn">Login</button>
            </div>
        </form>
    </div>
</body>

</html>
