<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller


{
    public function store()
    {
        $data = request()->all();
        $user = User::create([
            //only data from form
            'email'=>$data['email'],
            'password'=>$data['password'],
            'firstname'=>$data['firstname'],
            'lasttname'=>$data['lastname'],
            'date_of_birth'=>$data['date_of_birth'],
            'gender'=>$data['gender'],
            //************* */
            
            'name'=>$data['firstname']." ".$data['lastname'],
            'isAdmin'=> isset($data['isAdmin'])?$data['isAdmin']:False,
            'school'=>'cairo school',
            'address'=>'my address',
            'profilePic'=>'image',
            'mobile'=>'01234567891',
            'location'=>'my location',

        ]);
        return $user;
    }
}
