<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\postLike;

class postLikeController extends Controller
{
    //
    public function index()
    {

        return postLike::all();
   
    }
    public function store(){
        $data =request()->all();
        $commentlike= postLike ::create([
            'post_id'=>$data['post_id'],
            'user_id'=>$data['user_id'],
        ]);
        return $commentlike;
    }
    public function destory($id){
        $commentlike=  postLike ::findOrFail($id);
        $commentlike->delete();
        return $commentlike;
    }
}
