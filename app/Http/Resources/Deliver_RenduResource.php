<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Deliver_RenduResource extends JsonResource
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
            'id'    => $this->id,
            'github_url' => $this->github_url,
            'site_url'  => $this->site_url,
            'user_id'  => $this->user_id,
            'projet_id'  => $this->projet_id,
            'medias'    => Deliver_MediaResource::collection($this->medias),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
