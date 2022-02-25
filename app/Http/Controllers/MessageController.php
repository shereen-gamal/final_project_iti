<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageEvent;

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

        // event to make realtime application
        event(new MessageEvent($data->content));
        $message=Message::create([	
            'content'=> $data->content,
            'chat_id'=>$data->chat_id,
            'from_user_id'=>$data->from_user_id,
            'to_user_id'=>$data->to_user_id,
        ]);
       
        return $message;
    }

    public function destory($id){
        $message = Message::findOrFail($id);
        $message->delete();
        return $message;
    }
}
