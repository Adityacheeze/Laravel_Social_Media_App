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
    <div class="m-3 border border-3 border-black p-3">
        <h2 class="text-center">Edit Post</h2>
        <form action="{{ URL::to('edit-post/' . $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="post_title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="post_title"
                placeholder="post title...">
            <label for="post_body" class="form-label">Body</label>
            <textarea class="form-control" name="body" id="post_body" placeholder="post content...">{{ $post->body }}</textarea>
            <div class="d-flex justify-content-center gap-2">
                <button class="p-2 btn btn-success mt-2">Save Changes</button>
                <a href="{{ URL::to('/') }}">
                    <div class="btn btn-warning p-2 mt-2">Back to home</div>
                </a>
            </div>
        </form>
    </div>
</body>

</html>
