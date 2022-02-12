<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::with('chat')->get();
        return $messages;
    }

    public function show($id){
        $message = Message::with('chat')->get()->find($id);
        return $message;
    }

    public function store(Request $data){
        $message=Message::create([
             	
            'content'=>$data->content,
            'chat_id'=>isset($data->chat_id)?$data->chat_id:1,
            'from_user_id'=>isset($data->user1)?$data->user1:1,
            'to_user_id'=>isset($data->user2)?$data->user2:2,
        ]);
        // event to make realtime application
        event(new Message([$data->content]));
        return $message;
    }

    public function destory($id){
        $message = Message::findOrFail($id);
        $message->delete();
        return $message;
    }
}
