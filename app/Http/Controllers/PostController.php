<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incommingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $incommingFields['title'] = strip_tags($incommingFields['title']);
        $incommingFields['body'] = strip_tags($incommingFields['body']);
        $incommingFields['user_id'] = auth()->id();
        Post::create($incommingFields);
        return  response()->json([
            'success' => true,
            'message' => 'Post created successfully!'
        ]);
    }
    public function showEditScreen(Post $post)
    {
        if (auth()->user()->id !== $post["user_id"]) {
            return redirect("/");
        }
        return view('edit-post', ['post' => $post]);
    }
    public function updatePost(Post $post, Request $request)
    {
        if (auth()->user()->id !== $post["user_id"]) {
            return redirect("/");
        }
        $incommingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $incommingFields['title'] = strip_tags($incommingFields['title']);
        $incommingFields['body'] = strip_tags($incommingFields['body']);
        $post->update($incommingFields);
        return redirect('/');
    }
    public function deletePost(Post $post)
    {
        if (auth()->user()->id === $post["user_id"]) {
            $post->delete();
        }
        return redirect("/");
    }
    public function handleTempPage()
    {
        $data = auth()->user();
        return response()->json(['message' => 'Data received', 'data' => $data]);
    }
    public function handleFeedRequest()
    {
        $user = auth()->user();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('feed', ["posts" => $posts, "user" => $user]);
    }
}
