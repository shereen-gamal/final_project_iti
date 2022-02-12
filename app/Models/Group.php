<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable =[
        'group_name'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'groups_users');
    }
}
