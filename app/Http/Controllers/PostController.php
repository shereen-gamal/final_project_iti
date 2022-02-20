<?php

namespace App\Http\Controllers;
use App\Http\Resources\PostResource;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index()
    {
        $allposts = Post::with('photos','comments.user','shares','postLikes','user.friends','user.friend')->get();
        //    $allposts=Post::all();
        return PostResource::collection($allposts);    
    }

    public function show($postId)
    {
        //$onepost= Post::find($postId);
        $onepost = Post::with('photos','comments.user','shares','postLikes','user')->get()->find($postId);
        //  dd($onepost->photos);
        return new PostResource($onepost);
    }

    public function store()
    {
        $data = request()->all();
        $post = Post::create([
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'hasPic' => false
        ]);
        return $post;
    }

    public function update($id, Request $data)
    {
        $post = Post::find($id);
        $post->update($data->all());
        return $post;
    }

    public function destory($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }
}
