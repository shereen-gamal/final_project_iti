<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavepostController extends Controller
{
   
    
    public function index()
    {
        $allsavedposts = Savepost::with('user')->get();
        return $allsavedposts ;
    }


    public function show($savedpostId)
    {
        $savedpost =Savepost::with('user')->get()->where('id',$savedpostId);
        return  $savedpost;
    }

    public function store(){
        $data =request()->all();
        $savedpost= Savepost::create(
            [
            'post_id'=>$data['post_id'],
            'user_id'=>$data['user_id'],

        ]);
        return $savedpost;
    }

    public function destory($id){
        $savedpost = Savepost::findOrFail($id);
        $savedpost->delete();
        return $savedpost;
    }


}
