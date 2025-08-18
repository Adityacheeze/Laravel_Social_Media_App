<?php

namespace App\Http\Controllers;

use URL;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        User::createUser($request);
        return redirect("/");
    }

    public function logout()
    {
        auth()->logout();
        return redirect("/");
    }

    public function login(Request $request)
    {
        $incommingFields = $request->validate([
            "loginname" => "required",
            "loginpassword" => "required",
        ]);
        $user = User::where("name", $incommingFields["loginname"])->first();
        if ($user != null) {
            if ($user->attempts >= 2) {
                return back()->withErrors(['login' => "Invalid credentials",])->with('user', $user);
            }
            if (auth()->attempt(["name" => $incommingFields["loginname"], "password" => $incommingFields["loginpassword"]])) {
                $request->session()->regenerate();
                $user->attempts = 0;
                $user->save();
                return redirect("/");
            } else {
                $user->attempts = $user->attempts + 1;
                $user->save();
                return back()->withErrors([
                    'loginname' => "Invalid credentials. Attempts left: " . (3 - $user->attempts)
                ]);
            }
        }
        return back()->withErrors(['loginname' => "Invalid credentials",]);
    }

    public function editProfile(Request $request)
    {
        $incomingFields = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = $user->id . '.' . $extension;
        $path = $request->file('photo')->storeAs('profile_photos', $filename, 'public');
        $user->photoURL = $path;
        $user->save();
        return redirect("/");
    }
    public function hidePost(Request $request)
    {

        $validated = $request->validate([
            'post_ids' => 'required|array',
            'post_ids.*' => 'integer|exists:posts,id'
        ]);

        Post::whereIn('id', $validated['post_ids'])
            ->update(['visibility' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Selected posts have been hidden successfully!'
        ]);
    }
    public function unhidePost(Request $request)
    {

        $validated = $request->validate([
            'post_ids' => 'required|array',
            'post_ids.*' => 'integer|exists:posts,id'
        ]);

        Post::whereIn('id', $validated['post_ids'])
            ->update(['visibility' => 0]);

        return response()->json([
            'success' => true,
            'message' => 'Selected posts have been unhidden successfully!'
        ]);
    }


    public function uploadPDF(Request $request)
    {
        $incomingFields = $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240',
        ]);
        $user = auth()->user();
        $extension = $request->file('pdf')->getClientOriginalExtension();
        $filename = $user->id . '.' . $extension;
        $path = $request->file('pdf')->storeAs('pdfs', $filename, 'public');
        $user->pdf = $path;
        $user->save();
        return redirect("/");
    }

    public function viewPDF()
    {
        $user = auth()->user();

        if (! $user || ! $user->pdf) {
            abort(404, 'No PDF uploaded.');
        }

        $file = storage_path('app/public/' . $user->pdf);

        if (! file_exists($file)) {
            abort(404, 'File not found.');
        }

        header('Content-Type: application/pdf');
        @readfile($file);
        redirect("/");
    }
}
