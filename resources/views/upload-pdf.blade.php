<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- UPLOAD PDF --}}
    <div class="m-3 border border-3 border-black p-3 upload-pdf">
        <h2 class="text-center">Upload a PDF</h2>

        <form action="{{ url('upload-pdf') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="upload-pdf-form" class="form-label">Upload PDF</label>
            <input type="file" name="pdf" class="form-control" id="upload-pdf-form" accept="application/pdf">
            <div class="d-flex justify-content-center gap-2 mt-2">
                <button type="submit" class="p-2 btn btn-success">Upload PDF</button>
            </div>
        </form>

        <div class="d-flex justify-content-center gap-2 mt-3">
            @if ($user->pdf)
                <a href="{{ URL::to('view-pdf') }}" class="p-2 btn btn-warning" target="_blank" rel="noopener">View
                    PDF</a>
            @else
                <button type="button" class="p-2 btn btn-warning" disabled>View PDF</button>
            @endif
        </div>
    </div>
</body>

</html>
