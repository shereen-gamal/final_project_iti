<?php

namespace App\Http\Controllers;
use App\Http\Resources\CommentResource;

use App\Models\Comment;
use App\Models\Friend;
use Illuminate\Http\Request;
use App\Models\Notification;


class CommentController extends Controller
{
    public function index(){

        $comments = Comment::with('user','post')->get();
        return  CommentResource::collection($comments);
    }

    public function show($id){
        $comment = Comment::with('user','post')->get()->find($id);
        return new CommentResource($comment);

    }


    public function store(){
        $data = request()->all();
        $comment = Comment::create([
            'content'=>$data['content'],
            'user_id'=>isset($data['user_id'])?$data['user_id']:1,
            'post_id'=>isset($data['post_id'])?$data['post_id']:1,
        ]);
        // $notification = Notification::create([
        //     'type'=>'commented',
        //     'from_user_id'=> $data['user_id'],
        //     'to_user_id'=> $data['to_user_id'],
        //     'post_id'=>$data['post_id'],
        // ]);
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