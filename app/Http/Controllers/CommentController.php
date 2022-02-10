<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::with('user')->get();
        return $comments;
    }

    public function show($id){
        $comment = Comment::with('user')->get()->where('id',$id);
        return $comment;
    }

    public function store(){
        $data = request()->all();
        $comment = Comment::create([
            'content'=>$data['content'],
            'user_id'=>isset($data['user_id'])?$data['user_id']:1,
            'post_id'=>isset($data['post_id'])?$data['post_id']:1,
        ]);
        return $comment;
    }

    public function update($id,Request $data){
        $comment = Comment::find($id);
        $comment->update($data->all());
        return $comment;
    }

    public function destory($id){
        $comment = Comment::find($id)->delete();
        return $comment;
    }
}