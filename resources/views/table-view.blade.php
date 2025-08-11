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
    <div class="d-flex flex-column align-items-center gap-2 m-4">
        <h1>ALL Post Details</h1>
        <a href="{{ URL::to('feed-page') }}">
            <div class="btn btn-success">Back to feed</div>
        </a>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr class="border border-black">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Post Title</th>
                <th scope="col">Post Body</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp

            @foreach ($users as $user)
                @php
                    $posts = $user->userPosts()->get();
                    $rowspan = $posts->count();
                @endphp

                @foreach ($posts as $index => $post)
                    <tr class="border border-black">
                        @if ($index === 0)
                            <td rowspan="{{ $rowspan }}" valign="middle">{{ $i++ }}</td>
                            <td rowspan="{{ $rowspan }}" valign="middle">{{ $user->name }}</td>
                            <td rowspan="{{ $rowspan }}" valign="middle">{{ $user->email }}</td>
                        @endif

                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <style>
        /* Make nested table take full width of parent cell */
        .nested-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
            /* removes double borders */
            table-layout: fixed;
            /* keeps columns consistent */
        }

        /* Ensure nested table inherits column alignment */
        .nested-table td,
        .nested-table th {
            padding: 0.4rem 0.6rem;
            vertical-align: middle;
            text-align: left;
            /* change to center or right if needed */
            word-wrap: break-word;
            /* prevents overflow */
        }

        /* Match column alignment with outer table */
        .col-index {
            text-align: center;
            width: 50px;
        }

        .col-name {
            text-align: left;
        }

        .col-email {
            text-align: left;
        }

        .col-title {
            text-align: left;
            width: 40%;
        }

        .col-body {
            text-align: left;
        }
    </style>

    <table class="table table-striped table-hover m-0">
        <thead>
            <tr class="border border-black">
                <th class="col-index" valign="middle">#</th>
                <th class="col-name" valign="middle">Name</th>
                <th class="col-email" valign="middle">Email</th>
                <th>Posts</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($users as $user)
                <tr>
                    <td class="col-index">{{ $i++ }}</td>
                    <td class="col-name">{{ $user->name }}</td>
                    <td class="col-email">{{ $user->email }}</td>
                    <td>
                        <table class="table table-striped table-hover nested-table">
                            <tbody>
                                @foreach ($user->userPosts as $post)
                                    <tr>
                                        <td class="col-title">{{ $post->title }}</td>
                                        <td class="col-body">{{ $post->body }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



</body>

</html>
