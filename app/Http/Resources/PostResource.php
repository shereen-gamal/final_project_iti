<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'content'=>$this->content,
            'comments'=> new CommentResource($this->comments),
            'user_id'=>new UserResource($this->user),
            'post_likes'=>$this->postLikes,
            'created_at'=>$this->created_at,
            'postPic'=>$this->postPic,
            'hasPic'=>$this->hasPic,
            'save_post'=>$this->save_post,
        ];
    }
}
