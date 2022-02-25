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
        return $allposts;    
    }

    public function show($postId)
    {
        //$onepost= Post::find($postId);
        $onepost = Post::with('photos','comments.user','shares','postLikes','user')->get()->find($postId);
        //  dd($onepost->photos);
        return new PostResource($onepost);
    }

    // public function showsave()
    // {
    //     //$onepost= Post::find($postId);
    //     $post = Post::with('photos','comments.user','shares','postLikes','user')->where('user_id','=',auth()->user()->id)->where('save_post','=','1')->get();
    //     //dd($onepost->photos);
    //     return PostResource::collection($post);
    // }

    public function store()
    {
        $data = request()->all();
        $post = Post::create([
            'content' => $data['content'],
            'user_id' => isset($data['user_id'])? $data['user_id']: null,
            'page_id' => isset($data['page_id'])? $data['page_id']: null,
            'hasPic' => false,
            // 'save_post'=>false,
        ]);
        return $post;
    }

    public function update($id, Request $data)
    {
        $post = Post::find($id);
        $post->update($data->all());
        return $post;
    }
    /*public function savepost($id, Request $data)
    {
        $post = Post::find($id);
        $post->update(array('save_post' => 1));
        return $post;
    }
    public function deletesave($id, Request $data)
    {
        $post = Post::find($id);
        $post->update(array('save_post' => 0));
        return $post;
    }*/
    public function destory($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }
}
