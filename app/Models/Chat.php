<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable =[];

    public function messages(){
        return $this->hasMany(Message::class,'chat_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'secondary_user_id','id');
    }


}
