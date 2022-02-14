<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostLike;

class PostLikeController extends Controller
{
    //
    public function index()
    {

        return PostLike::all();
   
    }
    public function store(){
        $data =request()->all();
        $commentlike= PostLike ::create([
            'post_id'=>$data['post_id'],
            'user_id'=>$data['user_id'],
        ]);
        return $commentlike;
    }
    public function destory($id){
        $commentlike=  PostLike ::findOrFail($id);
        $commentlike->delete();
        return $commentlike;
    }
}
