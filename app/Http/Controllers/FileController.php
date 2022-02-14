<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function file(Request $request){
        if($request->hasFile('image')){
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME );
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ','_',$fileNameOnly). '-' .rand(). '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/posts',$compPic);

        }
    }

    public function profilePicture(Request $request,$userid){
        $user = User::
        where('id', '=', $userid)
        ->first();
        
        if($request->hasFile('image')){
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME );
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ','_',$fileNameOnly). '-' .rand(). '_' . time() . '.' . $extension;
            $user->update(['profilePic' =>  $compPic]);
            $path = $request->file('image')->storeAs('public/profiles',$compPic);
        }
    }
}
