<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class EvalNotificationResource extends JsonResource
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
        $from = new UserResource($this->from);
        $to = new UserResource($this->to);
        
        return [
            'id'         => $this->id,
            'from'       => $from,
            'to'         => $to,
            'object'     => $this->object,
            'isRead'     => $this->isRead == 1 ? 'lu' : 'non lu',
            'created_at' => $createAtFormated,
        ];
    }
}
