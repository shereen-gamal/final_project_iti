<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesLike extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function page(){
        return $this->belongsTo(Page::class);
    }
    


    protected $fillable =[
        'page_id',
        'user_id',
    ];

}
