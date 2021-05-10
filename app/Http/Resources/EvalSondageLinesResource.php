<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvalSondageLinesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $langage = new EvalLangageResource($this->langage);
        $skill   = new EvalSkillResource($this->skill);
        $sondage = new EvalSkillResource($this->sondage);

        return [
            'id'        => $this->id,
            'note'      => $this->note,
            'question'  => $this->question,
            'type'      => $this->type,
            'langage'   => $langage,
            'skill'     => $skill,
            'sondage'   => $sondage,
            'answers'    => new EvalUserAnswerLinesResource($this->answers),
        ];
    }
}
