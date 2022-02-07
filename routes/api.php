<?php

use App\Http\Controllers\PostController;
use App\Models\User;



use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});








Route::put('/users/{user}',[UserController::class, 'update'])->name('users.update');
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{user}',[UserController::class,'show']);
Route::delete('/users/{user}',[Usercontroller::class,'destroy']);
Route::post('/users', [UserController::class,'store']);


Route::get('posts',[postController::class,'index'])->name('APi'.' api.posts.index');
Route::get('posts/{post}',[postController::class,'show']);
Route::post('/posts',[PostController::class,'store']);
Route::put('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destory']);
