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
        <div class="m-3 border border-3 border-black p-3 edit-profile d-none">
            <h2 class="text-center">Edit Profile</h2>
            <form action="{{ URL::to('edit-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="edit_profile_pic" class="form-label">Profile Photo</label>
                <input type="file" name="photo" class="form-control" id="edit_profile_pic" accept="image/*">
                <div class="d-flex justify-content-center">
                    <button class="p-2 btn btn-success mt-2">Update Profile</button>
                </div>
            </form>
        </div>
        {{-- UPLOAD PDF --}}
        <div class="m-3 border border-3 border-black p-3 upload-pdf">
            <h2 class="text-center">Upload a PDF</h2>

            <form action="{{ url('upload-pdf') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="upload-pdf-form" class="form-label">Upload PDF</label>
                <input type="file" name="pdf" class="form-control" id="upload-pdf-form" accept="application/pdf">
                <div class="d-flex justify-content-center gap-2 mt-2">
                    <button type="submit" class="p-2 btn btn-success">Upload PDF</button>
                </div>
            </form>

            <div class="d-flex justify-content-center gap-2 mt-3">
                @if ($user->pdf)
                    <a href="{{ URL::to('view-pdf') }}" class="p-2 btn btn-warning" target="_blank" rel="noopener">View
                        PDF</a>
                @else
                    <button type="button" class="p-2 btn btn-warning" disabled>View PDF</button>
                @endif
            </div>
        </div>

        {{-- SHOW USER POSTS --}}
        <div class="d-flex flex-column m-3 justify-content-center align-items-center m-3 border border-3 border-black p-3">
            <div class="d-flex gap-2">
                <div class="btn btn-warning mb-3 show_post_btn">Show All Posts by {{ $user['name'] }}</div>
                <div class="btn btn-danger mb-3 hide_post_btn">Hide All Posts by {{ $user['name'] }}</div>
            </div>
            @foreach ($posts as $post)
                @if ($post->visibility == 0)
                    <div class="card mb-2 border border-1 border-black p-2 bg-info bg-gradient" style="width: 25rem;">
                        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $post['title'] }}</h5>
                                <div class="position-absolute top-0 end-0 p-3">
                                    <div class="ratio ratio-1x1" style="width:45px;">
                                        <img src="{{ asset('storage/app/public/' . $user->photoURL) }}"
                                            alt="user_profile_pic"
                                            class="img-fluid d-block rounded-circle border border-1 border-black shadow object-fit-cover">
                                    </div>
                                </div>
                                <h6 class="card-subtitle mb-2 text-body-secondary text-center">By {{ $user->name }}</h6>
                                <p class="card-text">{{ $post['body'] }}</p>
                                <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                                    <a class="card-link p-2 btn btn-success border border-black border-1"
                                        href="{{ URL::to('edit-post/' . $post->id) }}">EDIT</a>
                                    <a href="{{ URL::to('delete-post/' . $post->id) }}"
                                        class="p-2 btn btn-danger delete_button border border-black border-1">DELETE</a>
                                    <div class="card-link p-2 btn btn-warning hide_btn border border-black border-1">HIDE
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{-- TOAST FOR DELETE POST --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="deleteToast" class="toast align-items-center text-bg-danger border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Post Deleted!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @else
        <div class="d-flex flex-column align-items-center gap-4 m-3">
            <!-- Register Card -->
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

            <!-- Login Card -->
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
                        <button type="submit" class="btn btn-success px-4">Login</button>
                    </div>
                </form>
            </div>
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
