<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
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
</body>

</html>
