<?php

namespace App\Admin\v1\Http\Location\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContinentResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'continents',
            'attributes' => [
                'name' => $this->name,
                'code' => $this->code,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
