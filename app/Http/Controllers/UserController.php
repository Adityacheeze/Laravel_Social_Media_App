<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use URL;

class UserController extends Controller
{
    public function register(Request $request) {
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
    public function logout() {
        auth()->logout();
        return redirect("/");
    }
    public function login(Request $request) {
        $incommingFields = $request->validate([
            "loginname" => "required",
            "loginpassword" => "required",
        ]);
        if(auth()->attempt(["name" => $incommingFields["loginname"], "password" => $incommingFields["loginpassword"]])){
            $request->session()->regenerate();
        }
        return redirect("/");
    }
}
