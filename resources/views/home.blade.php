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
        <div class="d-flex justify-content-center p-2">
            <h3>{{ $user['name'] }} is Logged In</h3>
        </div>
        <div class="d-flex justify-content-center p-4">
            <form action="{{ URL::to('logout') }}" method="POST">
                @csrf
                <button class="p-2 btn btn-danger">Log Out</button>
            </form>
        </div>

        <div class="m-3 border border-3 border-black p-3">
            <h2 class="text-center">Create a New Post</h2>
            <form action="{{ URL::to('create-post') }}" method="POST">
                @csrf
                <label for="post_title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="post_title" placeholder="post title...">
                <label for="post_body" class="form-label">Body</label>
                <textarea class="form-control" name="body" id="post_body" placeholder="post content..."></textarea>
                <div class="d-flex justify-content-center">
                    <button class="p-2 btn btn-success mt-2">Save Post</button>
                </div>
            </form>
        </div>

        <div class="mb-3">
        </div>
        <div class="mb-3">
        </div>
        <div class="d-flex flex-column m-3 justify-content-center align-items-center m-3 border border-3 border-black p-3">
          <div class="d-flex gap-2">
            <div class="btn btn-warning mb-3 show_post_btn">Show All Posts by {{ $user['name'] }}</div>
            <div class="btn btn-danger mb-3 hide_post_btn">Hide All Posts by {{ $user['name'] }}</div>
          </div>
            @foreach ($posts as $post)
                <div class="card mb-2 border border-1 border-black p-2" style="width: 25rem;">
                    <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $post['title'] }}</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary text-center">By {{ $post->user->name }}</h6>
                            <p class="card-text">{{ $post['body'] }}</p>
                            <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                                <a class="card-link p-2 btn btn-success"
                                    href="{{ URL::to('edit-post/' . $post->id) }}">EDIT</a>
                                <form class="card-link" action="{{ URL::to('delete-post/' . $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 btn btn-danger delete_button">Delete</button>
                                </form>
                                <div class="card-link p-2 btn btn-warning hide_btn">HIDE</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
    <script>
        $(document).ready(function() {
            $(".delete_button").click(function() {
                const toastEl = document.getElementById("deleteToast");
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            })
        })
    </script>
    <script>
        $(document).ready(function() {
          $(".hide_btn").click(function() {
                $(this).closest(".card").hide("slow");
              })
          $(".show_post_btn").click(function() {
            $(".card").show("slow")
          })
          $(".hide_post_btn").click(function() {
            $(".card").hide("slow")
          })
        })
    </script>
</body>

</html>
