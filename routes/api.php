<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CommentLikeController ;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FileController;
use App\Models\User;
use App\Models\Photo;
use App\Http\Controllers\postLikeController ;
use App\Http\Controllers\ChatController ;
use App\Http\Controllers\MessageController ;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SavePostController;
use App\Http\Controllers\shareController;
use App\Models\CommentLike;
use App\Models\postLike;
use App\Models\Friend;
use Pusher\Pusher;
use App\Models\Chat;
use App\Models\ChatLine;
use App\Http\Controllers\ProfilePictureController;
use App\Events\MessageEvent;
use App\Http\Controllers\ChatLineController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\NotificationController;
use App\Models\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

//user Routes
Route::post('/user/token', [UserController::class,'Login']);/****************token_aPi******/
Route::put('/users/{user}',[UserController::class, 'update']);
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{user}',[UserController::class,'show']);
Route::get('/search/{user}',[UserController::class,'search']);
Route::delete('/users/{user}',[Usercontroller::class,'destroy'])->middleware('auth:sanctum');
Route::post('/users', [UserController::class,'store']);
Route::post('/user/id', [UserController::class,'getUserId']);
Route::post('/user/userid', [UserController::class,'getUserByUserId'])->middleware('auth:sanctum');
//Route::get('/showsave/{user}',[UserController::class,'showsave']);

//post Routes
Route::get('/posts',[postController::class,'index'])->name('APi'.' api.posts.index');
Route::get('/posts/{post}',[postController::class,'show']);
Route::post('/posts',[PostController::class,'store']);
Route::put('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destory']);
//Route::put('/savepost/{post}',[PostController::class,'savepost']);
//Route::put('/deletesave/{post}',[PostController::class,'deletesave']);
//Route::get('/showsave',[PostController::class,'showsave'])->middleware('auth:sanctum');

//comment Routes
Route::get('/comments',[CommentController::class,'index']);
Route::get('/comments/{comment}',[CommentController::class,'show']);
Route::post('/comments',[CommentController::class,'store']);
Route::put('/comments/{comment}',[CommentController::class ,'update']);
Route::delete('/comments/{comment}',[CommentController::class ,'destory']);
//photo Routes
Route::get('/photos',[PhotoController::class,'index']);
Route::get('/photos/{photo}',[PhotoController::class,'show']);
Route::post('/photos',[PhotoController::class,'store']);
Route::put('/photos/{photo}',[PhotoController::class ,'update']);
Route::delete('/photos/{photo}',[PhotoController::class ,'destory']);
//group Routes
Route::get('/groups',[GroupController::class,'index']);
Route::get('/groups/{group}',[GroupController::class,'show']);
Route::post('/groups',[GroupController::class,'store']);
Route::put('/groups/{group}',[GroupController::class ,'update']);
Route::delete('/groups/{group}',[GroupController::class ,'destory']);
//commentslike Routes
Route::get('/commentslike',[CommentLikeController ::class,'index']);
Route::get('/commentslike/{comment}',[CommentLikeController ::class,'show']);
Route::post('/commentslike',[CommentLikeController ::class,'store']);
Route::delete('/commentslike/{comment}',[CommentLikeController ::class ,'destory']);

//savepostslike Routes
Route::get('/saveposts',[SavePostController::class,'index']);
Route::get('/saveposts/{savepost}',[SavePostController ::class,'show']);
Route::post('/saveposts',[SavePostController::class,'store']);
Route::put('/saveposts/{savepost}',[SavePostController::class ,'update']);
Route::delete('/saveposts/{savepost}',[SavePostController::class ,'destory']);
//postLike
Route::get('/postslikes',[postLikeController ::class,'index']);
Route::post('/postslikes',[postLikeController ::class,'store']);
Route::delete('/postslikes/{postslike}',[postLikeController ::class ,'destory']);
//chat Routes
Route::get('/chats',[ChatController ::class,'index']);
Route::get('/chats/{chat}',[ChatController ::class,'show']);
Route::post('/chats',[ChatController ::class,'store']);
Route::delete('/chats/{chat}',[ChatController ::class ,'destory']);
//message Routes
Route::get('/messages',[MessageController ::class,'index']);
Route::get('/messages/{message}',[MessageController ::class,'show']);
Route::post('/messages',[MessageController ::class,'store']);
Route::delete('/messages/{message}',[MessageController ::class ,'destory']);
//pages Routes
Route::get('/pages',[PageController::class,'index']);
Route::get('/pages/{page}',[PageController::class,'show']);
Route::post('/pages',[PageController::class,'store']);
Route::put('/pages/{page}',[PageController::class ,'update']);
Route::delete('/pages/{page}',[PageController::class ,'destory']);

 //friend Routes
 Route::get('/friends',[FriendController::class,'index']);
 Route::post('/friends',[FriendController::class,'store']);
 Route::delete('/friends/{friend}',[FriendController::class ,'destroy']);

Route::post('/send-message',function(Request $data){
    event(new MessageEvent('from vs'));
});

//For Uploading a file
Route::post('/file',[FileController::class,'file']);
Route::post('/profilepicture/{id}',[FileController::class,'profilePicture']);
Route::post('/postpicture/{id}',[FileController::class,'postPicture']);
Route::post('/coverpicture/{id}',[FileController::class,'coverPicture']);

//chatline Routes
Route::post('/chatlines',[ChatLineController::class ,'store']);

// new update for friend and unfriend api 
Route::post('/friendship',[FriendshipController::class,'friend']);
Route::delete('/friendship/{friend}',[FriendshipController::class,'unfriend']);

//profile pictures Routes
Route::get('/profilepics',[ProfilePictureController::class,'index']);
Route::get('/profilepics/{profilepic}',[ProfilePictureController::class,'show']);
Route::post('/profilepics',[ProfilePictureController::class,'store']);

//notification Routes
Route::get('/notifications',[NotificationController::class,'index']);
Route::get('/notifications/{notification}',[NotificationController::class,'show']);
Route::post('/notifications',[NotificationController::class,'store']);
Route::delete('/notifications/{notification}',[NotificationController::class,'destory']);

//pusher api 
Route::post('/pusher/auth',function(Request $request){
  
    $pusher = new Pusher(
        config('broadcasting.connections.pusher.key'),
        config('broadcasting.connections.pusher.secret'),
        config('broadcasting.connections.pusher.app_id'),
        config('broadcasting.connections.pusher.options')
    );

    return $pusher->socket_auth($request->channel_name, $request->socket_id);
});
//shares
Route::get('/shares',[shareController ::class,'index']);
Route::get('/shares/{share}',[shareController::class,'show']);
Route::post('/shares',[shareController ::class,'store']);
Route::delete('/shares/{shares}',[shareController ::class ,'destory']);