<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "userId" => $this->user_id,
            "caption" => $this->caption,
            "postText" => $this->post_text,
            "postImage" => $this->post_image,
            "price" => $this->price,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
            "likeCount"=>$this->like_count,
            "commentCount"=>$this->comment_count,
            "user"=>$this->user,
            "like"=>$this->like,
            "comment"=>$this->comment,
        ];
    }
}
