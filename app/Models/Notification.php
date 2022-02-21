<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable =[
        'type',
        'from_user_id',
        'to_user_id',
        'post_id',
    ];
  
    public function from_user(){
        return $this->belongsTo(User::class,'from_user_id');
    }

    public function to_user(){
        return $this->belongsTo(User::class,'to_user_id');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }


}
