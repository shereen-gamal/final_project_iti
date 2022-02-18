<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatLine;
use Illuminate\Http\Request;

class ChatLineController extends Controller
{
    public function store(){
        $data = request()->all();
        $chatLine = ChatLine::create([
            'from_user_id' => $data['from_user_id'],
            'to_user_id' => $data['to_user_id'],
            'chat_id' => $data['chat_id'],
        ]);
        return $chatLine;
    }
    
}
