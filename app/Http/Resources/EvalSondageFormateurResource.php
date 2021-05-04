<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class EvalSondageFormateurResource extends JsonResource
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
            'user'          => $user,
            'accepted'      => $this->accepted == 0 ? 'En attente' : 'Accepter',
            'published'     => $this->published == 0 ? 'En attente' : 'Publier',
            'created_at'    => $createAtFormated,
        ];
    }
}
