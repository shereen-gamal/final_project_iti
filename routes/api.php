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
use App\Http\Controllers\PagesLikeController;
use App\Models\CommentLike;
use App\Models\postLike;
use App\Models\Friend;
use Pusher\Pusher;
use App\Models\Chat;
use App\Models\ChatLine;
use App\Models\PagesLike;
use App\Http\Controllers\ProfilePictureController;
use App\Events\MessageEvent;
use App\Http\Controllers\ChatLineController;
use App\Http\Controllers\CoverPictureController;
use App\Http\Controllers\FriendRequestController;
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
Route::get('/users/{user}',[UserController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);;
Route::get('/search/{user}',[UserController::class,'search'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/users/{user}',[Usercontroller::class,'destroy'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/users', [UserController::class,'store']);
Route::post('/user/id', [UserController::class,'getUserId']);
Route::post('/user/userid', [UserController::class,'getUserByUserId']);
Route::get('/dashboard/{user}',[UserController::class,'dashboard'])->middleware(['auth:sanctum',"checkStatus"]);
//Route::get('/showsave/{user}',[UserController::class,'showsave']);

//post Routes
Route::get('/posts',[postController::class,'index'])->name('APi'.' api.posts.index');
Route::get('/posts/{post}',[postController::class,'show']);
Route::post('/posts',[PostController::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::put('/posts/{post}',[PostController::class,'update'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/posts/{post}',[PostController::class,'destory'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
//Route::put('/savepost/{post}',[PostController::class,'savepost']);
//Route::put('/deletesave/{post}',[PostController::class,'deletesave']);
//Route::get('/showsave',[PostController::class,'showsave'])->middleware('auth:sanctum');

//comment Routes
Route::get('/comments',[CommentController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/comments/{comment}',[CommentController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/comments',[CommentController::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::put('/comments/{comment}',[CommentController::class ,'update'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/comments/{comment}',[CommentController::class ,'destory'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
//photo Routes
Route::get('/photos',[PhotoController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/photos/{photo}',[PhotoController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/photos',[PhotoController::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
Route::put('/photos/{photo}',[PhotoController::class ,'update'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/photos/{photo}',[PhotoController::class ,'destory'])->middleware(['auth:sanctum',"checkStatus"]);
//group Routes
Route::get('/groups',[GroupController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/groups/{group}',[GroupController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/groups',[GroupController::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::put('/groups/{group}',[GroupController::class ,'update'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/groups/{group}',[GroupController::class ,'destory'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
//commentslike Routes
Route::get('/commentslike',[CommentLikeController ::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/commentslike/{comment}',[CommentLikeController ::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/commentslike',[CommentLikeController ::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/commentslike/{comment}',[CommentLikeController ::class ,'destory'])->middleware(['auth:sanctum',"checkStatus","checkban"]);

//savepostslike Routes
Route::get('/saveposts',[SavePostController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/saveposts/{savepost}',[SavePostController ::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/saveposts',[SavePostController::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
Route::put('/saveposts/{savepost}',[SavePostController::class ,'update'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/saveposts/{savepost}',[SavePostController::class ,'destory'])->middleware(['auth:sanctum',"checkStatus"]);
//postLike
Route::get('/postslikes',[postLikeController ::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/postslikes',[postLikeController ::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/postslikes/{postslike}',[postLikeController ::class ,'destory'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
//chat Routes
Route::get('/chats',[ChatController ::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/chats/{chat}',[ChatController ::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/chats',[ChatController ::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/chats/{chat}',[ChatController ::class ,'destory'])->middleware(['auth:sanctum',"checkStatus"]);
//message Routes
Route::get('/messages',[MessageController ::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/messages/{message}',[MessageController ::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/messages',[MessageController ::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/messages/{message}',[MessageController ::class ,'destory'])->middleware(['auth:sanctum',"checkStatus"]);
//pages Routes
Route::get('/pages',[PageController::class,'index']);
Route::get('/pages/{page}',[PageController::class,'show']);
Route::post('/pages',[PageController::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::put('/pages/{page}',[PageController::class ,'update'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/pages/{page}',[PageController::class ,'destory'])->middleware(['auth:sanctum',"checkStatus","checkban"]);


//pageslike Routes

Route::get('/pagelikes',[PagesLikeController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/pagelikes/{like}',[PagesLikeController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/pagelikes',[PagesLikeController::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
Route::put('/pagelikes/{like}',[PagesLikeController::class ,'update'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/pagelikes/{like}',[PagesLikeController::class ,'destroy'])->middleware(['auth:sanctum',"checkStatus"]);

 //friend Routes
 Route::get('/friends',[FriendController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
 Route::post('/friends',[FriendController::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
 Route::delete('/friends/{friend}',[FriendController::class ,'destroy'])->middleware(['auth:sanctum',"checkStatus"]);

Route::post('/send-message',function(Request $data){
    event(new MessageEvent('from vs'));
});

//For Uploading a file
Route::post('/file',[FileController::class,'file'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/profilepicture/{id}',[FileController::class,'profilePicture'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/postpicture/{id}',[FileController::class,'postPicture']);
Route::post('/coverpicture/{id}',[FileController::class,'coverPicture'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/pagepicture/{id}',[FileController::class,'pagePicture'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/pagecover/{id}',[FileController::class,'pageCover'])->middleware(['auth:sanctum',"checkStatus"]);

//chatline Routes
Route::post('/chatlines',[ChatLineController::class ,'store'])->middleware(['auth:sanctum',"checkStatus"]);

// new update for friend and unfriend api 
Route::post('/friendship',[FriendshipController::class,'friend'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/friendship/{friend}',[FriendshipController::class,'unfriend'])->middleware(['auth:sanctum',"checkStatus"]);

//profile pictures Routes
Route::get('/profilepics',[ProfilePictureController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/profilepics/{profilepic}',[ProfilePictureController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/profilepics/{profilepic}',[ProfilePictureController::class,'destory'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/profilepics',[ProfilePictureController::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
//cover pictures Routes
Route::get('/coverpics',[CoverPictureController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/coverpics/{coverpic}',[CoverPictureController::class,'destory'])->middleware(['auth:sanctum',"checkStatus"]);

//notification Routes
Route::get('/notifications',[NotificationController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/notifications/{notification}',[NotificationController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/notifications',[NotificationController::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/notifications/{notification}',[NotificationController::class,'destory'])->middleware(['auth:sanctum',"checkStatus"]);

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
Route::get('/shares',[shareController ::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/shares/{share}',[shareController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/shares',[shareController ::class,'store'])->middleware(['auth:sanctum',"checkStatus","checkban"]);
Route::delete('/shares/{shares}',[shareController ::class ,'destory'])->middleware(['auth:sanctum',"checkStatus"]);

//friend request Routes
Route::get('/friendrequests',[FriendRequestController::class,'index'])->middleware(['auth:sanctum',"checkStatus"]);
Route::get('/friendrequests/{friendrequest}',[FriendRequestController::class,'show'])->middleware(['auth:sanctum',"checkStatus"]);
Route::post('/friendrequests',[FriendRequestController::class,'store'])->middleware(['auth:sanctum',"checkStatus"]);
Route::delete('/friendrequests/{friendrequest}',[FriendRequestController::class,'destory'])->middleware(['auth:sanctum',"checkStatus"]);


//get all admin in system
Route::get('/admins',[UserController::class,'admins']);
Route::get('/reportedUsers',[UserController::class,'reports']);
Route::get('/normal',[UserController::class,'normal']);