<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'name', 'email', 'password', 'pdf', 'photoURL', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function userPosts() {
        return $this->hasMany(Post::class, 'user_id');
    }
    public static function createUser($request) {
        // dd($request);
         $incommingFields = $request->validate([
            "name" => ["required", "min:3", "max:10", Rule::unique("users", "name")],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => ["required", "min:4", "max:200"],
        ]);
        $incommingFields["password"] = bcrypt($incommingFields["password"]);
        $user = User::create($incommingFields);
        auth()->login($user);
        return redirect("/");
    }
}
