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
Route::post('/user/token', [UserController::class,'Login']);/****************token_aPi******/
Route::put('/users/{user}',[UserController::class, 'update'])->middleware('auth:sanctum');
Route::get('/users',[UserController::class,'index'])->middleware('auth:sanctum');
Route::get('/users/{user}',[UserController::class,'show'])->middleware('auth:sanctum');
Route::delete('/users/{user}',[Usercontroller::class,'destroy'])->middleware('auth:sanctum');
Route::post('/users', [UserController::class,'store'])->middleware('auth:sanctum');
Route::get('posts',[postController::class,'index'])->name('APi'.' api.posts.index')->middleware('auth:sanctum');
Route::get('posts/{post}',[postController::class,'show'])->middleware('auth:sanctum');
Route::post('/posts',[PostController::class,'store'])->middleware('auth:sanctum');
Route::put('/posts/{post}',[PostController::class,'update'])->middleware('auth:sanctum');
Route::delete('/posts/{post}',[PostController::class,'destory'])->middleware('auth:sanctum');

