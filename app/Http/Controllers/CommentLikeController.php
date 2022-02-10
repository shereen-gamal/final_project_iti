<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function index()
    {

        $allcommentlikes= CommentLike ::all();
 
        return $allcommentlikes;    
    }

    public function show($commentlikeId){
        $onecommentlike=  CommentLike ::find($commentlikeId);
        return $onecommentlike;
    }

    public function store(){
        $data =request()->all();
        $commentlike= CommentLike ::create([
            'comment_id'=>$data['comment_id'],
            'user_id'=>$data['user_id'],
        ]);
        return $commentlike;
    }

    // public function update($id,Request $data){
    //     $post =Post::find($id);
    //     $post->update($data->all());
    //     return $post;
    // } 
    
    public function destory($id){
        $commentlike=  CommentLike ::findOrFail($id);
        $commentlike->delete();
        return $commentlike;
    }



}
