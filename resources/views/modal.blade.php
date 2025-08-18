<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="modal fade" id="{{ $index }}" tabindex="-1" aria-labelledby="{{ $index }}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-title text-center">{{ $post['title'] }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary text-center">By :
                        {{ $post->user->name }}</h6>
                    <p class="card-text">{{ $post['body'] }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
