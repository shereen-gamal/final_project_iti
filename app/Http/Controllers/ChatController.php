<?php

namespace App\Http\Controllers;
use App\Models\Chat;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){
        $chats = Chat::with('messages.user','user')->get();
        return $chats;
    }

    public function show($id){
        $chat = Chat::with('messages.user','user')->get()->find($id);
        return $chat;
    }

    public function store(){
        $data=request()->all();
        $chat=Chat::create($data);
        return $chat;
    }

    public function destory($id){
        $chat = Chat::findOrFail($id);
        $chat->delete();
        return $chat;
    }




}
