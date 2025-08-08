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
    <div class="d-flex flex-column align-items-center gap-4">
        <h1>Feed</h1>
        <a href="{{ URL::to('/') }}"><div class="btn btn-success home-btn">Back to home</div></a>
        @foreach ($posts as $post)
            <div class="card mb-2 border border-1 border-black p-2 bg-warning bg-gradient
" style="width: 25rem;">
                <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $post['title'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center">By : {{ $post->user->name }}</h6>
                        <p class="card-text">{{ $post['body'] }}</p>
                        <p class="card-text">Created at : {{ $post['created_at'] }}</p>
                        <p class="card-text">Updated at : {{ $post['updated_at'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
      $(document).ready(function() {
        $("home-btn").click(function() {
          
        })
      })
    </script>
</body>

</html>
