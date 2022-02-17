<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProfilePicture;
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
            $profilepic = ProfilePicture::create([
                'user_id' => $userid,
                'profilePic' => $compPic,
            ]);
            $path = $request->file('image')->storeAs('public/profiles',$compPic);
        }
    }

    public function postPicture(Request $request,$postid){
        $post = Post::
        where('id', '=', $postid)
        ->first();
        
        if($request->hasFile('image')){
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME );
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ','_',$fileNameOnly). '-' .rand(). '_' . time() . '.' . $extension;
            $post->update(['postPic' =>  $compPic]);
            $post->update(['hasPic' =>  true]);
            $path = $request->file('image')->storeAs('public/posts',$compPic);
        }
    }

    public function coverPicture(Request $request,$userid){
        $user = User::
        where('id', '=', $userid)
        ->first();
        
        if($request->hasFile('image')){
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME );
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ','_',$fileNameOnly). '-' .rand(). '_' . time() . '.' . $extension;
            $user->update(['coverPic' =>  $compPic, 'hasCover' => true]);
            // $profilepic = ProfilePicture::create([
            //     'user_id' => $userid,
            //     'profilePic' => $compPic,
            // ]);
            $path = $request->file('image')->storeAs('public/covers',$compPic);
        }
    }
}
