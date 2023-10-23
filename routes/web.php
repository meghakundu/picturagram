<?php

use Illuminate\Support\Facades\Route;

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

// DB::listen(function($query) {
//     return dump($query->sql);
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [App\Http\Controllers\User\PostController::class, 'index']);
    Route::get('/users/{id}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::put('/change-profileimg/{id}',[App\Http\Controllers\HomeController::class, 'updateProfileImg']);
    Route::resource('posts',App\Http\Controllers\User\PostController::class)->names('user.post');
    Route::post('/add-comment/{id}',[App\Http\Controllers\CommentController::class, 'storeComments']);
    Route::get('/reply',[App\Http\Controllers\CommentController::class, 'replyComments']);
    Route::post('/reply-comment',[App\Http\Controllers\CommentController::class, 'storeReply']);
    Route::get('/online-user', [App\Http\Controllers\HomeController::class, 'usersList']); 
    Route::get('user/{following_id}/{follower_id}/follow', [App\Http\Controllers\UserController::class, 'follow'])->name('follow');
    Route::get('user/{following_id}/{follower_id}/unfollow', [App\Http\Controllers\UserController::class, 'unfollow'])->name('unfollow');
    Route::get("/your-inbox",[App\Http\Controllers\User\PostController::class,'inboxChat']);
    Route::get("/search-tag",[App\Http\Controllers\UserController::class,'searchTagsPost']);
    Route::get('/tagged-person', [App\Http\Controllers\UserController::class, 'taggedPersonPosts']);
    Route::get("/search",[App\Http\Controllers\UserController::class,'search']);
    Route::get("/explore/tags/{tagPost}",[App\Http\Controllers\User\PostController::class,'tagsByPost']);
    Route::get("/autocomplete-search",[App\Http\Controllers\UserController::class, 'autocompleteSearch']);
    Route::get("/post-timeline/{id}",[App\Http\Controllers\User\PostController::class,'postTimeline']);
});