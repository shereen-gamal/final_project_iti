<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public  function photos()
    {
        return $this->hasMany(Photo::class);
    }
    protected $fillable =[
        'content',
        'user_id',

    ];
}
