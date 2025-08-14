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
</head>

<body>
    <div class="position-absolute top-0 end-0 p-3">
        <div class="ratio ratio-1x1" style="width:120px;">
            <img src="{{ asset('storage/app/public/' . $user->photoURL) }}" alt="user_profile_pic"
                class="img-fluid d-block rounded-circle border border-3 border-black shadow object-fit-cover">
        </div>
    </div>

    {{-- TOAST FOR HIDE POST --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="hidePostToast" class="toast align-items-center text-bg-danger border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Post Hidden Successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    {{-- TOAST FOR UNHIDE POST --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="unhidePostToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Post Unhidden Successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column align-items-center gap-4">
        <h1>Feed</h1>
        <div class="d-flex gap-2">
            <a href="{{ URL::to('/') }}">
                <div class="btn btn-success">Back To Home</div>
            </a>
            <a href="{{ URL::to('/table-details') }}">
                <div class="btn btn-warning">See Post Details</div>
            </a>
            <a href="{{ URL::to('/charts') }}">
                <div class="btn btn-info">Chart Gallery</div>
            </a>
            @if ($user->role == 2)
                <div class="btn btn-danger hidePostBtn">Hide Posts</div>
            @endif
            @if ($user->role == 2)
                <div class="btn btn-success unhidePostBtn d-none">Unhide Posts</div>
            @endif
            @if ($user->role == 2)
                <div class="btn btn-primary showhiddenPostBtn">Show Hidden Posts</div>
            @endif
        </div>
        <div class="hiddenPostContainer d-none">
            <h1>Hidden Posts</h1>
            @foreach ($posts as $index => $post)
                @if ($post->visibility == 1)
                    <div class="card mb-2 border border-1 border-black p-2 bg-info bg-gradient" style="width: 25rem;">
                        @if ($user->role == 2)
                            <input type="checkbox" name="unhidePost" class="unhidePost" id={{ $post['id'] }}>
                        @endif
                        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $post['title'] }}</h5>
                                <div class="position-absolute top-0 end-0 p-3">
                                    <div class="ratio ratio-1x1" style="width:45px;">
                                        <img src="{{ asset('storage/app/public/' . $post->user->photoURL) }}"
                                            alt="user_profile_pic"
                                            class="img-fluid d-block rounded-circle border border-1 border-black shadow object-fit-cover">
                                    </div>
                                </div>
                                <h6 class="card-subtitle mb-2 text-body-secondary text-center">By :
                                    {{ $post->user->name }}
                                </h6>
                                <p class="card-text">{{ $post['body'] }}</p>
                                <p class="card-text">Created at : {{ $post['created_at'] }}</p>
                                <p class="card-text">Updated at : {{ $post['updated_at'] }}</p>
                                <!-- Button trigger modal -->
                            </div>
                            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                                data-bs-target="#{{ $index }}">
                                View Full Post
                            </button>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="{{ $index }}" tabindex="-1"
                        aria-labelledby="{{ $index }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="card-title text-center">{{ $post['title'] }}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="card-subtitle mb-2 text-body-secondary text-center">By :
                                        {{ $post->user->name }}</h6>
                                    <p class="card-text">{{ $post['body'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <h1>Not Hidden Posts</h1>
        </div>
        @foreach ($posts as $index => $post)
            @if ($post->visibility == 0)
                <div class="card mb-2 border border-1 border-black p-2 bg-info bg-gradient" style="width: 25rem;">
                    @if ($user->role == 2)
                        <input type="checkbox" name="hidePost" class="hidePost" id={{ $post['id'] }}>
                    @endif
                    <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $post['title'] }}</h5>
                            <div class="position-absolute top-0 end-0 p-3">
                                <div class="ratio ratio-1x1" style="width:45px;">
                                    <img src="{{ asset('storage/app/public/' . $post->user->photoURL) }}"
                                        alt="user_profile_pic"
                                        class="img-fluid d-block rounded-circle border border-1 border-black shadow object-fit-cover">
                                </div>
                            </div>
                            <h6 class="card-subtitle mb-2 text-body-secondary text-center">By :
                                {{ $post->user->name }}
                            </h6>
                            <p class="card-text">{{ $post['body'] }}</p>
                            <p class="card-text">Created at : {{ $post['created_at'] }}</p>
                            <p class="card-text">Updated at : {{ $post['updated_at'] }}</p>
                            <!-- Button trigger modal -->
                        </div>
                        <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                            data-bs-target="#{{ $index }}">
                            View Full Post
                        </button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="{{ $index }}" tabindex="-1"
                    aria-labelledby="{{ $index }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="card-title text-center">{{ $post['title'] }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6 class="card-subtitle mb-2 text-body-secondary text-center">By :
                                    {{ $post->user->name }}</h6>
                                <p class="card-text">{{ $post['body'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <script>
        $(document).ready(function() {
            $(".hidePostBtn").click(function() {
                let selectedPosts = [];
                $(".hidePost:checked").each(function() {
                    selectedPosts.push($(this).attr("id"));
                });
                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('/hide-posts') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        post_ids: selectedPosts
                    },
                    success: function(response) {
                        const toastE1 = document.getElementById("hidePostToast");
                        const toast = new bootstrap.Toast(toastE1, {
                            delay: 3000,
                        });
                        toast.show();
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                })
            })
            $(".showhiddenPostBtn").click(function() {
                $(".hiddenPostContainer").toggleClass("d-none");
                $(".unhidePostBtn").toggleClass("d-none");
            })
            $(".unhidePostBtn").click(function() {
                let selectedPosts = [];
                $(".unhidePost:checked").each(function() {
                    selectedPosts.push($(this).attr("id"));
                });
                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('/unhide-posts') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        post_ids: selectedPosts
                    },
                    success: function(response) {
                        const toastE2 = document.getElementById("unhidePostToast");
                        const toast = new bootstrap.Toast(toastE2, {
                            delay: 3000,
                        });
                        toast.show();
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                })
            })
        })
    </script>
</body>

</html>
