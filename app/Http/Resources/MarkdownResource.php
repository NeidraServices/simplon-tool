<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarkdownResource extends JsonResource
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
            'title'         => $this->title,
            'status'        => $this->active,
            'category'      => new Md_CategoryResource($this->categories),
            'created_at'      => $this->created_at,
            'commentary'    => Md_CommantaryResource::collection($this->commentaries),
        ];
    }
}
