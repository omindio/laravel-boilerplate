<?php

namespace App\Domain\Users\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->getId(),
            'name' => $this->resource->getName(),
            'email' => $this->resource->getEmail(),
            'created_at' => $this->created_at,
            'roles' => $this->roles->pluck('name'),
            'permissions' => $this->permissions->pluck('name'),
        ];
    }
}
