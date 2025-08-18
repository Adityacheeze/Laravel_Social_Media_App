<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- Edit Profile --}}
    <div class="m-3 border border-3 border-black p-3 edit-profile d-none">
        <h2 class="text-center">Edit Profile</h2>
        <form action="{{ URL::to('edit-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="edit_profile_pic" class="form-label">Profile Photo</label>
            <input type="file" name="photo" class="form-control" id="edit_profile_pic" accept="image/*">
            <div class="d-flex justify-content-center">
                <button class="p-2 btn btn-success mt-2">Update Profile</button>
            </div>
        </form>
    </div>
</body>

</html>
