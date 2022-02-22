<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    public function index(){
        $friend_requests=FriendRequest::with('user','friend')->get();
        return $friend_requests;
    }

    public function show($id){
        $friend_request=FriendRequest::with('user','friend')->get()->where('id',$id)->first();
        return $friend_request;
    }

    public function store(){
        $data = request()->all();
        $friend_request= FriendRequest::create([
            'user_id'=>$data['user_id'],
            'friend_id'=>$data['friend_id'],
        ]);
        return $friend_request;
    }

    public function destory($id){
        $friend_request = FriendRequest::findOrFail($id);
        $friend_request->delete();
        return $friend_request;
    }



}
