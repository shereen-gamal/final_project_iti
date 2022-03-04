<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Page;
use App\Models\Post;
use App\Models\SavePost;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    }


    public function update($UserId, Request $request)
    {
        $data = $request->all();
        $oneUser = User::findOrFail($UserId);
        $permission = $oneUser->permission;
        $isAdmin = $oneUser->isAdmin;
        $reported = $oneUser->is_reported;
        $oneUser->update([
            'email' => (isset($data['email']))? $data['email']: $oneUser->email,
            'firstname' => isset($data['firstname'])? $data['firstname']: $oneUser->firstname,
            'lasttname' => isset($data['lasttname'])? $data['lasttname']: $oneUser->lasttname,
            // 'name' => $this->firstname . ' ' . $this->lasttname,
            // 'password' => Hash::make($data['password']),
            'date_of_birth' => isset($data['date_of_birth'])? $data['date_of_birth']: $oneUser->date_of_birth,
            'mobile' => isset($data['mobile'])? $data['mobile']: $oneUser->mobile,
            'school'=> isset($data['school'])? $data['school']: $oneUser->school,

            'location' => isset($data['location'])? $data['location']: $oneUser->location,
            'intro' => isset($data['intro'])? $data['intro']: $oneUser->intro,
            'is_reported'=> isset($data['is_reported'])? $data['is_reported']:$reported,
            'isAdmin'=>isset($data['isAdmin'])? $data['isAdmin']:$isAdmin,
            'permission'=>isset($data['permission'])? $data['permission']:$permission,
            'is_banned'=> isset($data['is_banned'])? $data['is_banned']:$oneUser->is_banned,
            'profilePic'=> isset($data['profilePic'])? $data['profilePic']:$oneUser->profilePic,
            'coverPic'=> isset($data['coverPic'])? $data['coverPic']:$oneUser->coverPic,


        ]);
        $updatedUser = User::findOrFail($UserId);
        $updatedUser->update([
            'name' => $updatedUser->firstname . ' ' . $updatedUser->lasttname,
        ]);
        
        return $updatedUser;
    }


    public function index()
    {

    $allusers = user::with('posts','friends','friend','groups','pageLikes',
    'chatLines.toUser',
    'chatLines.chat.messages',
    'pages','savePost')->get();
    return $allusers;
    }

    public function admins(){
        $admins = user::with('posts','friends','friend','groups','pageLikes',
        'chatLines.toUser',
        'chatLines.chat.messages',
        'pages','savePost')->where('isAdmin',true)->where('permission',2)->get();
    return $admins;

    }

    public function normal(){
        $normal = user::with('posts','friends','friend','groups','pageLikes',
        'chatLines.toUser',
        'chatLines.chat.messages',
        'pages','savePost')->where('isAdmin',false)->get();
    return $normal ;

    }

    public function reports(){
        $admins = user::with('posts','friends','friend','groups','pageLikes',
        'chatLines.toUser',
        'chatLines.chat.messages',
        'pages','savePost')->where('is_reported',true)->get();
    return $admins;

    }

    
    public function show($userId)
    {
        $user =User::with(
            'posts.comments.user',
            'savePost',
            'savePost.user'
            ,'savePost.post',
            'savePost.post.photos',
            'savePost.post.comments.user',
            'savePost.post.shares',
            'savePost.post.postLikes',
            'savePost.post.user',
            'friends.posts',
            'friend.posts',
            'pageLikes.page.posts',
            'chatLines.toUser',
            'chatLines.chat.messages',
            'pages',
            'posts.user',
            'posts.postLikes',
            'notifications.from_user',
            'notifications.post',
            'friend_requests.user'

        )->get()->find($userId); 
        return $user;
    }
/*public function showsave($userId)
    {
    $users = user::with('posts.comments.user',
    'friends',
    'friend',
    'pageLikes.page',
    'chatLines.toUser',
    'chatLines.chat.messages',
    'pages',
    'posts.user',
    'posts.postLikes')->join('posts','users.id','=','posts.user_id')->where('posts.user_id','=',$userId)->where('save_post','=','1')->get();
    return $users;
    }*/

    public function destroy($userId)
    {
        $oneUser = user::findOrFail($userId);
        $oneUser->delete();
        return  $oneUser;
    }


    public function store()
    {
        $data = request()->all();
        $user = User::create([
            //only data from form
            'email' => $data['email'],
            'password' =>Hash::make($data['password']),
            'firstname' => $data['firstname'],
            'lasttname' => $data['lastname'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'location' => $data['location'],
            //************* */
            'userid' => uniqid(),
            'name' => $data['firstname'] . " " . $data['lastname'],
            'isAdmin' => isset($data['isAdmin']) ? $data['isAdmin'] : False,
            'school' => isset($data['school']) ? $data['school'] :'NULL',
            'address' => isset($data['address']) ? $data['address'] :'my address',
            'profilePic' => isset($data['profilePic']) ? $data['profilePic'] :'default.jpg',
            'mobile' => 'NULL',
            'hasCover' => false,
            'intro' => 'Hello there! Welcome to my Profile.'
        ]);
        return $user;
    }


    public function getUserId(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->userid;
    }


    function search($name)
    {
        $resultUser = User::with('posts.comments.user','friends','friend','groups','pageLikes','posts.user','posts.postLikes')->where('name', 'LIKE','%'.$name.'%')->get();
        $resultPage = Page::where('page_name', 'LIKE','%'.$name.'%')->get();
        $resultPost = Post::with('photos','comments.user','shares','postLikes','user.friends','user.friend')->where('content', 'LIKE','%'.$name.'%')->get();
         return Response()->json(['resultUser'=>$resultUser,'resultPage'=>$resultPage,'resultPost'=>$resultPost]);
         
    }


    public function getUserByUserId(Request $request)
    {
        $request->validate([
            'userid' => 'required'
        ]);
        $user = User::where('userid', $request->userid)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'userid' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user;
    }
    public function dashboard($userId){
        $user =User::with(
            'friends.posts.user','friends.posts.comments.user','friends.posts.postLikes',
            'friend.posts.user','friend.posts.comments.user','friend.posts.postLikes',
            'pageLikes.page.posts.page','pageLikes.page.posts.comments.user','pageLikes.page.posts.postLikes','pageLikes.page.posts.user'
            
        )->get()->find($userId); 
        return $user;

    }


}
