<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use URL;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incommingFields = $request->validate([
            "name" => ["required", "min:3", "max:10", Rule::unique("users", "name")],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => ["required", "min:8", "max:200"],
        ]);
        $incommingFields["password"] = bcrypt($incommingFields["password"]);
        $user = User::create($incommingFields);
        auth()->login($user);
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
        if (auth()->attempt(["name" => $incommingFields["loginname"], "password" => $incommingFields["loginpassword"]])) {
            $request->session()->regenerate();
        }
        return redirect("/");
    }
    public function editProfile(Request $request)
    {
        $incomingFields = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = $user->id . '.' . $extension;
        $path = $request->file('photo')->storeAs('profile_photos',$filename ,'public');
        $user->photoURL = $path;
        $user->save();
        return redirect("/");
    }
}
