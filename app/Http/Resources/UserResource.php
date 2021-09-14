<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $token = null;
    public function __construct($resource, $token = null)
    {
        $this->token = $token;
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if (isset($this->token)) {
            $role = new RoleResource($this->role);
            $promotion = new EvalPromotionResource($this->promotion);

            return [
                'id' => $this->id,
                'name' => $this->name,
                'surname' => $this->surname,
                'email' => $this->email,
                'verify'  => $this->verified_at == null ? 'En attente' : 'Valider',
                'role' => $role,
                'token' => $this->token,
                'avatar' => $this->avatar,
                'promotion' => $promotion
            ];
        } else {
            $role = new RoleResource($this->role);
            $promotion = new EvalPromotionResource($this->promotion);

            return [
                'id' => $this->id,
                'name' => $this->name,
                'surname' => $this->surname,
                'verify'  => $this->verified_at == null ? 'En attente' : 'Valider',
                'email' => $this->email,
                'role' => $role,
                'avatar' => $this->avatar,
                'promotion' => $promotion
            ];
        }
    }
}
