<?php

namespace App\Http\Controllers;

use App\Models\PagesLike;
use Illuminate\Http\Request;

class PagesLikeController extends Controller
{
    public function index(){
        $pagesLikes = PagesLike::with('page')->get();
        return $pagesLikes;

    }
    public function show($id){
        $pagesLike = PagesLike::with('page')->get()->where('id',$id);
        return $pagesLike;


    }
    public function update($id, Request $data){
        $pagesLike = PagesLike::find($id);
        $pagesLike->update($data->all());
        return $pagesLike;
    } 
    public function store(){
        $data = request()->all();
        $pagesLike = PagesLike::create([
            'user_id'=>$data['user_id'],
            'page_id'=>$data['page_id'],
        ]
        );
        return $pagesLike;

    }
    public function destroy($id){
        $pagesLike = PagesLike::find($id);
        $pagesLike->delete();
        return $pagesLike;
    }
    


}
