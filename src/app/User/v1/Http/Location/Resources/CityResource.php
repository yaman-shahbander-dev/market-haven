<?php

namespace App\User\v1\Http\Location\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'cities',
            'attributes' => [
                'country_id' => $this->countryId,
                'name' => $this->name,
                'full_name' => $this->fullName,
                'code' => $this->code,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
                'addresses' => $this->when($this->addresses, function () {
                    return AddressResource::collection($this->addresses->items());
                })
            ]
        ];
    }
}
