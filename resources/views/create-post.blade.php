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
    {{-- Create a New Post --}}
    <div class="m-3 border border-3 border-black p-3">
        <h2 class="text-center">Create a New Post</h2>
        <form>
            @csrf
            <label for="post_title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="post_title" placeholder="post title...">
            <label for="post_body" class="form-label">Body</label>
            <textarea class="form-control" name="body" id="post_body" placeholder="post content..."></textarea>
            <div class="d-flex gap-2 justify-content-center">
                <button class="p-2 btn btn-success mt-2 create-post">Create Post</button>
                <a href="{{ URL::to('/') }}">
                    <div class="btn btn-warning home-btn p-2 mt-2">Back to home</div>
                </a>
            </div>
        </form>
    </div>
    {{-- TOAST FOR CREATE POST --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="createPostToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Post Created!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        const routes = {
            createPost: "{{ URL::to('create-post') }}",
            feedPage: "{{ URL::to('feed-page') }}"
        };
    </script>
    <script src="{{ asset('public/scripts/create-post.js') }}"></script>
</body>

</html>
