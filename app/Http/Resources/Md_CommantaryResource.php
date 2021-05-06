<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Md_CommantaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'user'          => new UserResource($this->users),
            'description'   => $this->description,
            'createdAt'     => $this->created_at
         ];
    }
}
