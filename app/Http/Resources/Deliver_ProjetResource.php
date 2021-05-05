<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Deliver_ProjetResource extends JsonResource
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
            'titre' => $this->titre,
            'image'  => $this->image,
            'deadline'  => $this->deadline,
            'description'  => $this->description,
            // 'apprenants' => Deliver_AffectationResource::collection($this->users),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
