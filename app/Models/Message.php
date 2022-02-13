<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable=['chat_id','content','from_user_id','to_user_id'];
    public function chat(){
        $this->belongsTo(Chat::class);
    }
}
