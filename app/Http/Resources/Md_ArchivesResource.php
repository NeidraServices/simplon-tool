<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Md_ArchivesResource extends JsonResource
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
            'created_at'            => $this->created_at,
            'markdown'      => new MarkdownResource($this->markdown),
        ];
    }
}
