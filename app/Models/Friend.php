<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function friends(){
    //     return $this->hasMany(Friend::class,'friend_id','id');
    // }
    protected $fillable = [
        'user_id',
        'friend_id',
    ];

}
