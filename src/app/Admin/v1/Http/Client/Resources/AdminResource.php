<?php

namespace App\Admin\v1\Http\Client\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'users',
            'attributes' => [
                'name' => $this->name,
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'gender' => $this->gender,
                'scope' => $this->scope,
                'type' => $this->type,
                'email' => $this->email,
                'banned_at' => $this->bannedAt,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
                'bearer_token' => $this->bearerToken
            ],
        ];
    }
}
