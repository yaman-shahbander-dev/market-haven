<?php

namespace App\Admin\v1\Http\Location\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'countries',
            'attributes' => [
                'continent_id' => $this->continentId,
                'name' => $this->name,
                'full_name' => $this->fullName,
                'capital' => $this->capital,
                'code' => $this->code,
                'code_alpha3' => $this->codeAlpha3,
                'emoji' => $this->emoji,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
                'cities' => $this->when($this->cities, function () {
                    return CityResource::collection($this->cities->items());
                })
            ]
        ];
    }
}
