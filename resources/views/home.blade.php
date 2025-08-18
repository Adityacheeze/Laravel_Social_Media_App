<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    @auth

        {{-- USER OPTIONS --}}
        <div class="d-flex justify-content-center p-2">
            <h3>{{ $user['name'] }} is Logged In</h3>
        </div>
        {{-- PROFILE PICTURE --}}
        <div class="position-absolute top-0 end-0 p-3">
            <div class="ratio ratio-1x1" style="width:120px;">
                <img src="{{ asset('storage/app/public/' . $user->photoURL) }}" alt="user_profile_pic"
                    class="img-fluid d-block rounded-circle border border-3 border-black shadow object-fit-cover">
            </div>
        </div>
        <div class="d-flex justify-content-center p-4 gap-2">
            <button class="show-user-info btn btn-success">User Info</button>
            <button class="edit-profile-btn btn btn-info">Edit Profile</button>
            <a href="{{ URL::to('create-post') }}" class="btn btn-primary">Create New Post</a>
            <form action="{{ URL::to('feed-page') }}">
                @csrf
                <button class="p-2 btn btn-warning">Go to Feed</button>
            </form>
            <form action="{{ URL::to('logout') }}" method="POST">
                @csrf
                <button class="p-2 btn btn-danger">Log Out</button>
            </form>
        </div>
        
        {{-- SHOW USER INFO --}}
        <div class="d-flex flex-column align-items-center">
            <div class="response_div border border-1 border-black rounded p-2 m-2 d-none">
            </div>
            <button class="btn btn-danger close_user_info d-none">Close</button>
        </div>

        {{-- SHOW ERRORS --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Edit Profile --}}
        @include('edit-profile');

        {{-- UPLOAD PDF --}}
        @include('upload-pdf');

        {{-- SHOW USER POSTS --}}
        @include('user-post');

    @else
        <div class="d-flex flex-column align-items-center gap-4 m-3">
            <!-- Signup Form -->
            @include('signup-form');
            <!-- Login Form -->
             @include('login-form');
        </div>
    @endauth
    {{-- SCRIPTS --}}
    <script>
        const routes = {
            showUserDetailsAPI: "{{ URL::to('show-user') }}",
        };
    </script>
    <script src="{{ asset('public/scripts/home.js') }}"></script>
</body>

</html>
