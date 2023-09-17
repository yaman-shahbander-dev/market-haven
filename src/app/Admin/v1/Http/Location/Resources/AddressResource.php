<?php

namespace App\Admin\v1\Http\Location\Resources;

use App\Helpers\HasPaginatedCollection;
use App\User\v1\Http\Order\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'addresses',
            'attributes' => [
                'city_id' => $this->cityId,
                'order_id' => $this->orderId,
                'address' => $this->address,
                'postal_code' => $this->postalCode,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
                'city' => $this->when($this->city, function () {
                    return CityResource::make($this->city);
                }),
                'order' => $this->when($this->order, function () {
                    return OrderResource::make($this->order);
                }),
            ]
        ];
    }
}
