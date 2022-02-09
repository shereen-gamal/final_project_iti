<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable =[
        'content',
        'user_id',
        'post_id',
    ];

    public function likes()
    {
        return $this->hasMany(Commentlike::class);
    }

    //relations here
}