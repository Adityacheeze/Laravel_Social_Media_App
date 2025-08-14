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
            if (auth()->user()->id !== $post["user_id"]) {
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

    public function charts()
    {
        return view("charts-page");
    }

    public function getChartData()
    {
        $data = [
            ["y" => 79.45, "label" => "Google"],
            ["y" => 7.31,  "label" => "Bing"],
            ["y" => 7.06,  "label" => "Baidu"],
            ["y" => 4.91,  "label" => "Yahoo"],
            ["y" => 1.26,  "label" => "Others"]
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    public function getChartData2()
    {
        $data = [
            ["y" => 300878, "label" => "Venezuela"],
            ["y" => 266455,  "label" => "Saudi"],
            ["y" => 169709,  "label" => "Canada"],
            ["y" => 158400,  "label" => "Iran"],
            ["y" => 142503,  "label" => "Iraq"],
            ["y" => 101500, "label" => "Kuwait"],
            ["y" => 97800,  "label" => "UAE"],
            ["y" => 80000,  "label" => "Russia"]
        ];

        return response()->json([
            'data' => $data
        ]);
    }
    public function getChartData3()
    {
        $data =  [
            [
                "x" => 39.6,
                "y" => 5.225,
                "z" => 1347,
                "name" => "China"
            ],
            [
                "x" => 3.3,
                "y" => 4.17,
                "z" => 21.49,
                "name" => "Australia"
            ],
            [
                "x" => 1.5,
                "y" => 4.043,
                "z" => 304.09,
                "name" => "US"
            ],
            [
                "x" => 17.4,
                "y" => 2.647,
                "z" => 2.64,
                "name" => "Brazil"
            ],
            [
                "x" => 8.6,
                "y" => 2.154,
                "z" => 141.95,
                "name" => "Russia"
            ],
            [
                "x" => 52.98,
                "y" => 1.797,
                "z" => 1190.86,
                "name" => "India"
            ],
            [
                "x" => 4.3,
                "y" => 1.735,
                "z" => 26.16,
                "name" => "Saudi Arabia"
            ],
            [
                "x" => 1.21,
                "y" => 1.41,
                "z" => 39.71,
                "name" => "Argentina"
            ],
            [
                "x" => 5.7,
                "y" => .993,
                "z" => 48.79,
                "name" => "SA"
            ],
            [
                "x" => 13.1,
                "y" => 1.02,
                "z" => 110.42,
                "name" => "Mexico"
            ],
            [
                "x" => 2.4,
                "y" => .676,
                "z" => 33.31,
                "name" => "Canada"
            ],
            [
                "x" => 2.8,
                "y" => .293,
                "z" => 64.37,
                "name" => "France"
            ],
            [
                "x" => 3.8,
                "y" => .46,
                "z" => 127.70,
                "name" => "Japan"
            ],
            [
                "x" => 40.3,
                "y" => .52,
                "z" => 234.95,
                "name" => "Indonesia"
            ],
            [
                "x" => 42.3,
                "y" => .197,
                "z" => 68.26,
                "name" => "Thailand"
            ],
            [
                "x" => 31.6,
                "y" => .35,
                "z" => 78.12,
                "name" => "Egypt"
            ],
            [
                "x" => 1.1,
                "y" => .176,
                "z" => 61.39,
                "name" => "U.K"
            ],
            [
                "x" => 3.7,
                "y" => .144,
                "z" => 59.83,
                "name" => "Italy"
            ],
            [
                "x" => 1.8,
                "y" => .169,
                "z" => 82.11,
                "name" => "Germany"
            ]
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    public function getChartData4()
    {
        $data = [
            [
                "x" => 'TEAM A',
                "y" => [65, 96]
            ],
            [
                "x" => 'TEAM B',
                "y" => [33, 78]
            ],
            [
                "x" => 'TEAM C',
                "y" => [23, 48],
            ],
            [
                "x" => 'TEAM D',
                "y" => [0, 78]
            ]
        ];
        $data2 = [
            [
                "x" => 'TEAM A',
                "y" => [23, 45]
            ],
            [
                "x" => 'TEAM B',
                "y" => [78, 99]
            ],
            [
                "x" => 'TEAM C',
                "y" => [3, 37],
            ],
            [
                "x" => 'TEAM D',
                "y" => [58, 83]
            ]
        ];

        return response()->json([
            'data' => [$data, $data2],
        ]);
    }
    public function getChartData5()
    {
        $data = [
            [
                "x" => "",
                "y" => [0, 78]
            ]
        ];

        return response()->json([
            'data' => $data
        ]);
    }
}
