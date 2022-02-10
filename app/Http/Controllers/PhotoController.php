<?php

namespace App\Http\Controllers;
use App\Models\Photo;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    { 
        $allphotos=Photo::all();

        return $allphotos;
    }
    public function show($photoId)
    {
        $onephoto= Photo::find($photoId);
        dd($onephoto->post);
        return $onephoto;
    }
    public function store()
    {
        $data =request()->all();
        $photo=Photo::create([
            'image'=>$data['image'],
            'post_id'=>$data['post_id'],
        ]);
        return $photo ;
    }

    public function update($id,Request $data){
        $photo =Photo::find($id);
        $photo->update($data->all());
        return $photo;
    }

    public function destory($id){
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return $photo;
    }
}
