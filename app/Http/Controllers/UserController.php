<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  

    public function index()
    {

        $allusers=user::all();
 
        return $allusers;    
    }

    public function show($userId){
        $oneUser= user::find($userId);
        return  $oneUser;
    }

    public function destroy($userId)
    {
        $oneUser=user::findOrFail($userId);
        $oneUser->delete();
        return  $oneUser;
    }


}
