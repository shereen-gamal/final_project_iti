<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class share extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'user_id',
        'post_id',
    ];

    public  function post()
    {
        return $this->belongsTo(Post::class);
    }


    public  function savepost()
    {
        return $this->belongsTo(SavePost::class);
    }
}
