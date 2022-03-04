<?php

namespace App\Http\Controllers;

use App\Models\CoverPicture;
use Illuminate\Http\Request;

class CoverPictureController extends Controller
{
    public function index()
    { 
        return CoverPicture::all();

        
    }
    public function show($photoId)
    {
        return CoverPicture::find($photoId);
        
    }
    public function store()
    {
        $data =request()->all();
        $photo=CoverPicture::create([
            'user_id'=>$data['post_id'],
            'coverPic'=>$data['coverPic'],
        ]);
        return $photo ;
    }



    public function destory($id){
        $photo =CoverPicture::findOrFail($id);
        $photo->delete();
        return $photo;
    }
}
