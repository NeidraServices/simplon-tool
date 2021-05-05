<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Deliver_CommentairesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user=new UserResource($this->user);
        $comm=new Deliver_CommentairesResource($this->comm);
            return [
                'id'    => $this->id,
                'text' => $this->text,
                'users'  => $user,
                'commentaires'  => $comm,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        
    }
}
