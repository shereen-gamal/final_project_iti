<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;	
    protected $fillable =[
        'profile_image',
        'cover_image',
        'page_name',
        'user_id',
        'about',
        'is_reported',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class,'page_id','id');
    }


    public function pageslike(){
        return $this->hasMany(PagesLike::class,'page_id','id');
    }
}
