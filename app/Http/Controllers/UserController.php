<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Illuminate\Http\Request;

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


    public function update($UserId, Request $data)
    {
        $oneUser = User::findOrFail($UserId);
        $oneUser->update(
            $data->all()
        );
        return $oneUser;
    }


    public function index()
    {
        // $allusers = user::with('posts','friends','savedposts')->get();
        $allusers = user::with('posts','friends','friend','groups','pageLikes')->get();
        return $allusers;
    }


    public function show($userId)
    {
        // $user =User::with('posts','friends','savedposts')->get()->where('id',$userId);
        $user =User::with('posts.comments.user','friends','friend','groups','pageLikes')->get()->where('id',$userId)->first();
        return  $user;
    }


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
            'password' => Hash::make($data['password']),
            'firstname' => $data['firstname'],
            'lasttname' => $data['lastname'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            //************* */
            'userid' => uniqid(),
            'name' => $data['firstname'] . " " . $data['lastname'],
            'isAdmin' => isset($data['isAdmin']) ? $data['isAdmin'] : False,
            'school' => isset($data['school']) ? $data['school'] :'cairo school',
            'address' => isset($data['address']) ? $data['address'] :'my address',
            'profilePic' => 'image',
            'mobile' => '01234567891',
            'location' => 'my location',
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
