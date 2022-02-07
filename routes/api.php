<?php

use App\Http\Controllers\PostController;

use App\Models\User;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

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

Route::put('/users/{user}',[UserController::class, 'update']);
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{user}',[UserController::class,'show']);
Route::delete('/users/{user}',[Usercontroller::class,'destroy']);
Route::post('/users', [UserController::class,'store']);

Route::post('/user/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});



Route::get('posts',[postController::class,'index'])->name('APi'.' api.posts.index');
Route::get('posts/{post}',[postController::class,'show']);
Route::post('/posts',[PostController::class,'store']);
Route::put('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destory']);

