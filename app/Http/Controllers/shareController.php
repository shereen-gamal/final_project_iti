<?php

namespace App\Http\Controllers;

use App\Models\share;
use Illuminate\Http\Request;

class shareController extends Controller
{
    public function index(){
        $shares = share::all();
        return $shares;

    }
    public function show($id){
        $share = share::with('')->get()->where('id',$id);
        return $share;


    }
    public function update($id, Request $data){
        $share = share::find($id);
        $share->update($data->all());
        return $share;
    } 
    public function store(){
        $data = request()->all();
        $share = share::create(
            $data
        );
        return $share;

    }
    public function destory($id){
        $share = share::find($id);
        $share->delete();
        return $share;
    }
}
