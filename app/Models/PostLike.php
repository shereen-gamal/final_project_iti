<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    public  function post()
    {
        return $this->belongsTo(Post::class);
    }


    
    use HasFactory;
    protected $fillable =[
        'post_id',
        'user_id',
    ];
}
