<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //

    public function index(){
        $groups = Group::with('')->get();
        return $groups;

    }
    public function show($id){
        $group = Group::with('')->get()->where('id',$id);
        return $group;


    }
    public function update($id, Request $data){
        $group = Group::find($id);
        $group->update($data->all());
        return $group;
    } 
    public function store(){
        $data = request()->all();
        $group = Group::create([
            'group_name'=>$data['group_name']
        ]);
        return $group;

    }
    public function destory($id){
        $group = Group::find($id);
        $group->delete();
        return $group;
    }


}
