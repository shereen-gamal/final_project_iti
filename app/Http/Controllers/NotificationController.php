<?php

namespace App\Http\Controllers;

use App\Events\PostLiked;
use App\Models\Notification;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error\Notice;
use App\Models\Post;


class NotificationController extends Controller
{
    //

    public function index(){
        $notifications = Notification::with(
            'from_user' , 'to_user')->get();
        return $notifications;
    }

    public function show($id){
        $notification = Notification::with(
            'from_user','to_user',
            )->get()->where('id',$id)->first();
        return $notification;

    }

    public function store(){
        $data = request()->all();
        if (isset($data['post_id'])){
            $post = Post::with('user')->get()->where('id',$data['post_id'])->first();
        }
        event(new PostLiked($data['type']));
        $notification = Notification::create([
            'type'=>$data['type'],
            'from_user_id'=> $data['from_user_id'],
            'to_user_id'=>isset($data['to_user_id'])?$data['to_user_id']:$post->user->id,
            'post_id'=>isset($data['post_id'])? $data['post_id']:null,
        ]);
        return $notification;
    }

    public function destory($id){
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return $notification;
    }
}
