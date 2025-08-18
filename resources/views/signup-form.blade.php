<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="card border border-3 border-black p-4" style="width: 25rem;">
        <h3 class="text-center mb-3">Register</h3>
        <form action="{{ URL::to('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="register_name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="register_name"
                    placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="register_email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="register_email"
                    placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="register_password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="register_password"
                    placeholder="Enter password">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary px-4">Register</button>
            </div>
        </form>
    </div>
</body>

</html>
