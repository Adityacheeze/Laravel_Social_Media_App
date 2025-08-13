<?php

use App\Models\Post;
use App\Models\User;
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
Route::match(['get', 'post'], '/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

Route::get('/table-details', [PostController::class, 'viewTable']);
Route::get('/show-user', [PostController::class, 'showUserDetails']);
Route::get('/feed-page', [PostController::class, 'handleFeedRequest']);
Route::get('/posts/pdf', [PostController::class, 'viewPdf']);
Route::get('/charts', [PostController::class, 'charts']);

Route::get('/getChart', [PostController::class, 'getChartData']);
Route::get('/getChart2', [PostController::class, 'getChartData2']);
Route::get('/getChart3', [PostController::class, 'getChartData3']);
Route::get('/getChart4', [PostController::class, 'getChartData4']);
Route::get('/getChart5', [PostController::class, 'getChartData5']);