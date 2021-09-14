<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Md_ContributionResource extends JsonResource
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
            'user'      => new Md_CategoryResource($this->categories),
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }
}
