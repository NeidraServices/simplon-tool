<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvalSkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $referentiel = new EvalReferentielResource($this->referentiel);

        return [
            'id'          => $this->id,
            'description' => $this->description,
            'referentiel' => $referentiel,
        ];
    }
}
