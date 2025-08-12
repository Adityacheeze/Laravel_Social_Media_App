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


    <div class="d-flex flex-column align-items-center gap-4">
        <h1>Feed</h1>
        <a href="{{ URL::to('/') }}">
            <div class="btn btn-success">Back to home</div>
        </a>
        <a href="{{ URL::to('/table-details') }}">
            <div class="btn btn-warning">see post details</div>
        </a>
        @foreach ($posts as $index => $post)
            <div class="card mb-2 border border-1 border-black p-2 bg-info bg-gradient" style="width: 25rem;">
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
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center">By : {{ $post->user->name }}</h6>
                        <p class="card-text">{{ $post['body'] }}</p>
                        <p class="card-text">Created at : {{ $post['created_at'] }}</p>
                        <p class="card-text">Updated at : {{ $post['updated_at'] }}</p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#{{ $index }}">
                            View Full Post
                        </button>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="{{ $index }}" tabindex="-1" aria-labelledby="{{ $index }}Label"
                aria-hidden="true">
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
        @endforeach
    </div>
</body>

</html>
