<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PagesLike;

class PageController extends Controller
{

    public function index(){
        $pages = Page::with('user','pageslike','posts')->get();
        return $pages;
    }

    public function show($id){
        $page = Page::with('user','pageslike','posts.comments.user','posts.postLikes')->get()->find($id);
        return $page;
    }

    public function store(){
        $data = request()->all();
        $page = Page::create([
            // 'profile_image'=>$data['profile_image'],
            // 'cover_image'=>$data['cover_image'],
            'page_name'=>$data['page_name'],
            'user_id'=>$data['user_id'],
            'about'=>$data['about'],
        ]);
        return $page;
    }

    public function update($id, Request $data)
    {
        $page = Page::find($id);
        $page->update($data->all());
        return $page;
    }


    public function destory($id){
        $page=Page::findOrFail($id);
        $page->delete();
        return $page;
    }
}
