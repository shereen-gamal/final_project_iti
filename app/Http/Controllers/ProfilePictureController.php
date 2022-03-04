<?php

namespace App\Http\Controllers;

use App\Models\ProfilePicture;
use Illuminate\Http\Request;

class ProfilePictureController extends Controller
{
    public function index()
    { 
        return ProfilePicture::all();

        
    }
    public function show($photoId)
    {
        return ProfilePicture::find($photoId);
        
    }
    public function store()
    {
        $data =request()->all();
        $photo=ProfilePicture::create([
            'user_id'=>$data['post_id'],
            'profilePic'=>$data['profilePic'],
        ]);
        return $photo ;
    }

    public function destory($id){
        $photo =ProfilePicture::findOrFail($id);
        $photo->delete();
        return $photo;
    }

}
