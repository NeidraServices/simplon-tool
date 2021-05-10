<?php

namespace App\Http\Resources;

use App\Models\EvalSondageLines;
use Illuminate\Http\Resources\Json\JsonResource;

class EvalUserAnswerLinesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lines =  new EvalSondageLinesResource($this->sondageLine);
        return [
            "id"        => $this->id,
            "note"      => $this->note,
            "reponse"   => $this->reponse,
            "sondage_line_id" => $lines
        ];
    }
}
