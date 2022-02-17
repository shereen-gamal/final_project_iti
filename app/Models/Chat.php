<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable =['id'];

    public function messages(){
        return $this->hasMany(Message::class,'chat_id','id');
    }

    public function chatLines(){
        return $this->hasMany(ChatLine::class,'chat_id','id');
    }

}
