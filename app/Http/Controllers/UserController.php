<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Page;
use App\Models\Post;
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
        $oneUser->update([
            'email' => (isset($data['email']))? $data['email']: $oneUser->email,
            'firstname' => isset($data['firstname'])? $data['firstname']: $oneUser->firstname,
            'lasttname' => isset($data['lasttname'])? $data['lasttname']: $oneUser->lasttname,
            // 'name' => $this->firstname . ' ' . $this->lasttname,
            // 'password' => Hash::make($data['password']),
            'date_of_birth' => isset($data['date_of_birth'])? $data['date_of_birth']: $oneUser->date_of_birth,
            'mobile' => isset($data['mobile'])? $data['mobile']: $oneUser->mobile,
            'location' => isset($data['location'])? $data['location']: $oneUser->location,
            'intro' => isset($data['intro'])? $data['intro']: $oneUser->intro,


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
    'pages')->get();
    return $allusers;
    }
    public function show($userId)
    {
        $user =User::with(
            'posts.comments.user',
            'friends',
            'friend',
            'pageLikes.page',
            'chatLines.toUser',
            'chatLines.chat.messages',
            'pages',
            'posts.user',
            'posts.postLikes'
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
            'school' => isset($data['school']) ? $data['school'] :'cairo school',
            'address' => isset($data['address']) ? $data['address'] :'my address',
            'profilePic' => 'default.jpg',
            'mobile' => '01234567891',
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


}
