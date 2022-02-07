<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $allposts=Post::all();
 
        return $allposts;    
    }

    public function show($postId){
        $onepost= Post::find($postId);
        return $onepost;
    }


}
