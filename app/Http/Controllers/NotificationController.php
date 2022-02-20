<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error\Notice;

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
        $notification = Notification::create([
            'type'=>$data['type'],
            'from_user_id'=> $data['from_user_id'],
            'to_user_id'=> $data['to_user_id'],
            'post_id'=>$data['post_id'],
        ]);
        return $notification;
    }

    public function destory($id){
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return $notification;
    }
}
