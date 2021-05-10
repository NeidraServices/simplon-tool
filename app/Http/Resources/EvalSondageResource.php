<?php

namespace App\Http\Resources;

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
        $user = new UserResource($this->user);


        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'comments'      => $this->comments,
            'global_note'   => $this->global_note,
            'lines'         => EvalSondageLinesResource::collection($this->sondage),
            'userComments'  => EvalUserSondagesCommentsResource::collection($this->userComments),
            'user'          => $user,
            'created_at'    => $createAtFormated,
        ];
    }
}
