<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        if (empty(auth()->user())) {
            return redirect("/");
        }
        if ($request->isMethod('get')) {
            return view('create-post');
        }
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

    public function updatePost(Post $post, Request $request)
    {
        if ($request->isMethod('get')) {
            if (empty(auth()->user())) {
                return redirect("/");
            }
            return view('edit-post', ['post' => $post]);
        }

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
        return  response()->json([
            'success' => true,
            'message' => 'Post edited successfully!'
        ]);
    }

    public function deletePost(Post $post)
    {
        if (auth()->user()->id === $post["user_id"]) {
            $post->delete();
        }
        return redirect("/");
    }

    public function showUserDetails()
    {
        $user = auth()->user();
        return response()->json(['message' => 'Data received', 'data' => $user]);
    }

    public function handleFeedRequest()
    {
        $user = auth()->user();
        $posts = Post::orderBy('created_at', 'desc')->get();
        $i = 0;
        foreach ($posts as $post) {
            $posts[$i]['user'] = User::where('id', $post['user_id'])->first();
            $i++;
        }
        return view('feed', ["posts" => $posts, "user" => $user]);
    }

    public function viewTable()
    {
        if (auth()->check()) {
            $users = User::all()->toArray();
            $i = 0;
            foreach ($users as $user) {
                $users[$i]['posts'] = Post::where('user_id', $user['id'])->get()->toArray();
                $i++;
            }
        }
        return view('table-view', ['users' => $users]);
    }

    public function viewPdf(Request $request)
    {
        $users = User::all()->toArray();
        $i = 0;
        foreach ($users as $user) {
            $users[$i]['posts'] = Post::where('user_id', $user['id'])->get()->toArray();
            $i++;
        }

        $pdf = Pdf::loadView('table-view', compact('users'));

        $user = auth()->user();
        $filename = $user->id . '.pdf';

        Storage::disk('public')->put('pdfs/' . $filename, $pdf->output());
        $user->pdf = 'pdfs/' . $filename;
        $user->save();

        return $pdf->stream('/posts/pdf');
    }
}
