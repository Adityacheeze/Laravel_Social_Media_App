<?php

use App\Http\Controllers\ChartController;
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
Route::post('/hide-posts', [UserController::class, 'hidePost']);
Route::post('/unhide-posts', [UserController::class, 'unhidePost']);


// POST CONTROLLER ROUTES
Route::match(['get', 'post'], '/create-post', [PostController::class, 'createPost']);
Route::match(['get', 'post'], '/edit-post/{post}', [PostController::class, 'updatePost']);
Route::get('/delete-post/{post}', [PostController::class, 'deletePost']);

Route::get('/table-details', [PostController::class, 'viewTable']);
Route::get('/show-user', [PostController::class, 'showUserDetails']);
Route::get('/feed-page', [PostController::class, 'handleFeedRequest']);
Route::get('/posts/pdf', [PostController::class, 'viewPdf']);

// CHART CONTROLLER ROUTES
Route::get('/charts', [ChartController::class, 'charts']);

Route::get('/getChart', [ChartController::class, 'getChartData']);
Route::get('/getChart2', [ChartController::class, 'getChartData2']);
Route::get('/getChart3', [ChartController::class, 'getChartData3']);
Route::get('/getChart4', [ChartController::class, 'getChartData4']);
Route::get('/getChart5', [ChartController::class, 'getChartData5']);