<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allposts = Post::with('photos','comments','user')->get();
        //    $allposts=Post::all();
        return $allposts;
    }

    public function show($postId)
    {
        //   $onepost= Post::find($postId);
        $onepost = Post::with('photos','comments','user')->get()->where('id', $postId);
        //  dd($onepost->photos);
        return $onepost;
    }

    public function store()
    {
        $data = request()->all();
        $post = Post::create([
            'content' => $data['content'],
            'user_id' => $data['user_id'],
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
