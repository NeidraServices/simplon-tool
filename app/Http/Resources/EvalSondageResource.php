<?php

namespace App\Http\Resources;

use App\Models\EvalSondageLines;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class EvalSondageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $createdAt = new DateTime($this->created_at);
        $createAtFormated = $createdAt->format('Y-m-d H:i:s');
        
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'comments'      => $this->comments,
            'global_note'   => $this->global_note,
            'sondage_lines' => EvalSondageLines::collection(''),
            'created_at'    => $createAtFormated,
        ];
    }
}
