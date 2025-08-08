<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = [];
    $user = "";
    if(auth()->check()) {
        $posts = auth()->user()->userPosts()->latest()->get();
        $user = auth()->user();
    }
    return view('home', ['posts' => $posts, 'user' => $user]);
});
// USER CONTROLLER ROUTES
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/edit-profile', [UserController::class, 'editProfile']);
Route::post('/upload-pdf', [UserController::class, 'uploadPDF']);
Route::get('/view-pdf', [UserController::class, 'viewPDF']);


// POST CONTROLLER ROUTES
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

Route::get('/temp-page', [PostController::class, 'handleTempPage']);
Route::get('/feed-page', [PostController::class, 'handleFeedRequest']);