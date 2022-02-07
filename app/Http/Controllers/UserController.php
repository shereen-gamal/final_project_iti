<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


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

        $allusers = user::all();

        return $allusers;
    }

    public function show($userId)
    {
        $oneUser = user::find($userId);
        return  $oneUser;
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
            'name' => $data['firstname'] . " " . $data['lastname'],
            'isAdmin' => isset($data['isAdmin']) ? $data['isAdmin'] : False,
            'school' => 'cairo school',
            'address' => 'my address',
            'profilePic' => 'image',
            'mobile' => '01234567891',
            'location' => 'my location',
        ]);
        return $user;
    }
}
