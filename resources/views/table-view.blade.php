<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Post Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            margin: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            margin: 10px;
        }
        
        .btn-success {
            background-color: #28a745;
        }

        .btn-primary {
            background-color: #007bff;
        }
        
        .btn-primary:hover {
            background-color: #3173b8;
        }
        .btn-success:hover {
            background-color: #3a804b;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            font-size: 14px;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
            text-align: left;
            word-break: break-word;
        }

        thead {
            background-color: #f2f2f2;
        }

        /* Table striping */
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #eaeaea;
        }

        /* First Table Column Widths */
        .first-table .col-index {
            width: 5%;
            text-align: center;
        }

        .first-table .col-name {
            width: 12%;
        }

        .first-table .col-email {
            width: 13%;
        }

        .first-table .col-title {
            width: 35%;
        }

        .first-table .col-body {
            width: 35%;
        }

        /* Second Table Column Widths */
        .second-table .col-index {
            width: 5%;
            text-align: center;
        }

        .second-table .col-name {
            width: 12%;
        }

        .second-table .col-email {
            width: 13%;
        }

        /* Nested Table inside Second Table */
        .nested-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .nested-table td {
            border: 1px solid black;
            padding: 4px;
            vertical-align: top;
            word-break: break-word;
        }

        .nested-table .col-title {
            width: 35%;
        }

        .nested-table .col-body {
            width: 65%;
        }
        .flex-center {
            display: flex;
            text-align: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>ALL Post Details</h1>
        <div class="flex-center">
            <a href="{{ URL::to('feed-page') }}" class="btn btn-success">Back to feed</a>
            <a href="{{ URL::to('/posts/pdf') }}" class="btn btn-primary">View PDF</a>
        </div>
    </div>

    <!-- First Table -->
    <table class="first-table">
        <thead>
            <tr>
                <th class="col-index">#</th>
                <th class="col-name">Name</th>
                <th class="col-email">Email</th>
                <th class="col-title">Post Title</th>
                <th class="col-body">Post Body</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($users as $user)
                @php
                    $rowspan = count($user["posts"]);
                @endphp
                @foreach ($user["posts"] as $index => $post)
                    <tr>
                        @if ($index === 0)
                            <td class="col-index" rowspan="{{ $rowspan }}">{{ $i++ }}</td>
                            <td class="col-name" rowspan="{{ $rowspan }}">{{ $user["name"] }}</td>
                            <td class="col-email" rowspan="{{ $rowspan }}">{{ $user["email"] }}</td>
                        @endif
                        <td class="col-title">{{ $post["title"] }}</td>
                        <td class="col-body">{{ $post["body"] }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <!-- Second Table -->
    <table class="second-table">
        <thead>
            <tr>
                <th class="col-index">#</th>
                <th class="col-name">Name</th>
                <th class="col-email">Email</th>
                <th>Posts</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($users as $user)
                <tr>
                    <td class="col-index">{{ $i++ }}</td>
                    <td class="col-name">{{ $user["name"] }}</td>
                    <td class="col-email">{{ $user["email"] }}</td>
                    <td>
                        <table class="nested-table">
                            <tbody>
                                @foreach ($user["posts"] as $post)
                                    <tr>
                                        <td class="col-title">{{ $post["title"] }}</td>
                                        <td class="col-body">{{ $post["body"] }}</td>
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
