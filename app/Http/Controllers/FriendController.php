<?php

namespace App\Http\Controllers;
use App\Models\Friend;
use CreateFriendsTable;
use Illuminate\Http\Request;

class FriendController extends Controller
{

    public function destroy($friendId)
    {
      $oneFriend = Friend::findOrFail($friendId);
      $oneFriend->delete();
      return  $oneFriend;
    }

    public function index(){
        $pages = Friend::with('user')->get();
        return $pages;
    }
    public function store()
    {
        $data = request()->all();
        $friend = Friend::create([
            //only data from form
            'user_id' => $data['user_id'],
            'friend_id'=>$data ['friend_id'],
        ]);
        return $friend;
    }
}
