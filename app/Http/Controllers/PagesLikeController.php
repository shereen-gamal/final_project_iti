<?php

namespace App\Http\Controllers;

use App\Models\PagesLike;
use Illuminate\Http\Request;

class PagesLikeController extends Controller
{
    public function index(){
        $pagesLikes = PagesLike::with('')->get();
        return $pagesLikes;

    }
    public function show($id){
        $pagesLike = PagesLike::with('')->get()->where('id',$id);
        return $pagesLike;


    }
    public function update($id, Request $data){
        $pagesLike = PagesLike::find($id);
        $pagesLike->update($data->all());
        return $pagesLike;
    } 
    public function store(){
        $data = request()->all();
        $pagesLike = PagesLike::create(
            $data
        );
        return $pagesLike;

    }
    public function destory($id){
        $pagesLike = PagesLike::find($id);
        $pagesLike->delete();
        return $pagesLike;
    }
    


}
