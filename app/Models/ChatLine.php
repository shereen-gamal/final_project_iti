<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatLine extends Model
{
    use HasFactory;

    protected $fillable = ['from_user_id','to_user_id','chat_id'];

    public function chat(){
        return $this->belongsTo(Chat::class,'chat_id','id');
    }

    public function fromUser(){
        return $this->belongsTo(User::class,'from_user_id','id');
    }
    
    public function toUser(){
        return $this->belongsTo(User::class,'to_user_id','id');
    }


}
