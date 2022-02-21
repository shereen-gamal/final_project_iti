<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public  function post()
    {
        return $this->belongsTo(Post::class);
    }
    public  function user()
    {
        return $this->belongsTo(User::class);
    }


    use HasFactory;
    protected $fillable =[
        'content',
        'user_id',
        'post_id',
    ];


    //relations here

    public function likes(){
        return $this->hasMany(CommentLike::class);
    }

}
