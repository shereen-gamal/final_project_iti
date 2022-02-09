<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentlikeController extends Controller
{
    public function index()
    {
        $allcommentlike=Commentlike::all();
        return $allcommentlike;
    }
    public function show($commentlikeId)
    {
        $onecommentlike= Commentlike::find($commentlikeId);
        return $onecommentlike;
    }
    public function store()
    {
        $data =request()->all();
        $commentlike=Commentlike::create([
            'user_id'=>$data['user_id'],
            'post_id'=>$data['post_id'],
        ]);
        return $commentlike;
    }
    // public function update($id,Request $data){
    //     $commentlike=Commentlike::find($id);
    //     $commentlike->update($data->all());
    //     return $commentlike;
    // }

    public function destory($id){
        $commentlike = Commentlike::findOrFail($id);
        $commentlike->delete();
        return $commentlike;
    }


}
