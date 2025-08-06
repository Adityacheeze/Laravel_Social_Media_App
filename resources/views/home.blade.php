<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  @auth
  <p>{{$user["name"]}} is Logged In</p>
  <form action="{{URL::to('logout')}}" method="POST">
    @csrf
    <button>Log Out</button>
  </form>

  <div style="border: 3px solid black; padding:20px;">
    <h2>Create a New Post</h2>
    <form action="{{URL::to('create-post')}}" method="POST">
      @csrf
      <input type="text" name="title" placeholder="post title...">
      <textarea name="body" placeholder="post content..."></textarea>
      <button>Save Post</button>
    </form>  
  </div>

  <div style="border: 3px solid black; padding:20px;">
    <h2>All Posts by {{$user["name"]}}</h2>
    @foreach($posts as $post)
    <div style="background-color: gray; padding: 10px; margin: 10px">
      <h3>{{$post['title']}} </h3>
      <h5>By {{$post->user->name}}</h5>
      {{$post['body']}}
      <p><a href="{{URL::to('edit-post/'.$post->id)}}">EDIT</a></p>
      <form action="{{URL::to('delete-post/'.$post->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button>Delete</button>
      </form>
    </div>
    @endforeach
  </div>
  @else
  <div style="border: 3px solid black; padding:20px;">
    <h2>Register</h2>
    <form action="{{URL::to('register')}}" method="POST">
      @csrf
      <input name="name" type="text" placeholder="name">
      <input name="email" type="text" placeholder="email">
      <input name="password" type="password" placeholder="password">
      <button>Register</button>
    </form>
  </div>
  <div style="border: 3px solid black; padding:20px;">
    <h2>Login</h2>
    <form action="{{URL::to('login')}}" method="POST">
      @csrf
      <input name="loginname" type="text" placeholder="name">
      <input name="loginpassword" type="password" placeholder="password">
      <button>Login</button>
    </form>
  </div>
  @endauth
</body>
</html>