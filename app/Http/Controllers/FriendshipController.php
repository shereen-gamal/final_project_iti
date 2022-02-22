<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Friend;
use App\Models\ChatLine;


use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function friend(){
        $data = request()->all();
        $last_chat = Chat::latest('created_at')->first();
        if ($last_chat == null){
            $last_chat_id = 1;
        }
        else{
            $last_chat_id = $last_chat->id;
        }

        $new_id = $last_chat_id+1;

        Chat::create([
            'id'=>$new_id,
        ]);

        ChatLine::create([
            'from_user_id'=>$data['user_id'],
            'to_user_id'=>$data['friend_id'],
            'chat_id'=>$new_id
        ]);
        ChatLine::create([
            'from_user_id'=>$data['friend_id'],
            'to_user_id'=>$data['user_id'],
            'chat_id'=>$new_id

        ]);
        Friend::create([
            'user_id'=>$data['user_id'],
            'friend_id'=>$data['friend_id']
        ]);
       
        return "we are now friends";

    }
    public function unfriend($friends_id){
        //get friend row to be deleted
        $friendship =Friend::findOrFail($friends_id);
        $user_id = $friendship->user_id;
        $friend_id = $friendship->friend_id;
        // dd($friendship);

        //get first chatline row to( be deleted
        $chatLines1 = ChatLine::all()->where('to_user_id',$friend_id);
        $chatLine1 = $chatLines1->where('from_user_id',$user_id)->first();

        //get second chatline row to be deleted
        $chatLines2 = ChatLine::all()->where('to_user_id',$user_id);
        $chatLine2 = $chatLines2->where('from_user_id',$friend_id)->first();
       
        $chat_id = $chatLine2->chat_id;
        $chat = Chat::findOrFail($chat_id);

        //get chat row to be deleted
        $friendship->delete();
        $chatLine1->delete();
        $chatLine2->delete();
        $chat->delete();

        return "delete done";
    }
}
