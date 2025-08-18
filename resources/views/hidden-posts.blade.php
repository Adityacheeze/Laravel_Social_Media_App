<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($posts as $index => $post)
        @if ($post->visibility == 1)
            <div class="card mb-2 border border-1 border-black p-2 bg-danger bg-gradient" style="width: 25rem;">
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
                    </div>
                    
                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#{{ $index }}">
                        View Full Post
                    </button>
                </div>
            </div>
            <!-- Modal -->
            @include('modal')
        @endif
    @endforeach
</body>

</html>
