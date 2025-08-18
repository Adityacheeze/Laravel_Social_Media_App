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
    @include('toasts/hide-post-toast')

    {{-- TOAST FOR UNHIDE POST --}}
    @include('toasts/unhide-post-toast')
   

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
            {{-- HIDDEN POSTS --}}
            @include('hidden-posts')
            <h1>Feed Posts</h1>
        </div>
        {{-- UNHIDDEN POSTS --}}
      @include('unhidden-posts')
    </div>
    <script>
        const routes = {
            hidePost: "{{ URL::to('hide-posts') }}",
            unhidePost: "{{ URL::to('unhide-posts') }}",
        };
        const tokens = {
            csrfToken: "{{ csrf_token() }}",
        }
    </script>
    <script src="{{ asset('public/scripts/feed.js') }}"></script>
</body>

</html>
