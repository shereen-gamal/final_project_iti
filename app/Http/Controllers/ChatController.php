<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Models\Chat;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){
        $chats = Chat::with(
            'messages.chat',
            'messages.toUser',
            'messages.fromUser',
        )->get();
        return $chats;
    }

    public function show($id){
        $chat = Chat::with(
            'messages.chat',
            'messages.toUser',
            'messages.fromUser',
        )->get()->find($id);
        return $chat;
    }

    public function store(){
        $data=request()->all();
        $chat=Chat::create($data['id']);
        return $chat;
    }

    public function destory($id){
        $chat = Chat::findOrFail($id);
        $chat->delete();
        return $chat;
    }




}
