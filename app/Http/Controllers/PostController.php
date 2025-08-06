<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $incommingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $incommingFields['title'] = strip_tags($incommingFields['title']);
        $incommingFields['body'] = strip_tags($incommingFields['body']);
        $incommingFields['user_id'] = auth()->id();
        Post::create($incommingFields);
        return redirect('/');
    }
    public function showEditScreen(Post $post) {
        if(auth()->user()->id !== $post["user_id"]){
            return redirect("/");
        }
        return view('edit-post', ['post' => $post]);
    }
    public function updatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post["user_id"]){
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
    public function deletePost(Post $post) {
        if(auth()->user()->id === $post["user_id"]){
            $post->delete();
        }
        return redirect("/");
    }
}
