<?php

namespace App\User\v1\Http\Favorite\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\HasPaginatedCollection;

class FavoriteResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'favorites',
            'attributes' => [
                'user_id' => $this->userId,
                'favorable_type' => $this->favorableType,
                'favorable_id' => $this->favorableId,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
