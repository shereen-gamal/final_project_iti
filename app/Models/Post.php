<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PostLikes;

class Post extends Model
{
    use HasFactory;
    public  function photos()
    {
        return $this->hasMany(Photo::class,'post_id','id');
    }

    public  function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id' );
    }

    public  function shares()
    {
        return $this->hasMany(share::class,'post_id','id' );
    }

    public  function postLikes()
    {
        return $this->hasMany(PostLike::class,'post_id','id' );
    }
    public  function savePost()
    {
        return $this->hasMany(SavePost::class,'post_id','id' );
    }
    public  function page()
    {
        return $this->belongsTo(Page::class);
    }
    protected $fillable =[
        'content',
        'user_id',
        'postPic',
        'hasPic',
        'save_post',
        'page_id',
        'is_reported'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
