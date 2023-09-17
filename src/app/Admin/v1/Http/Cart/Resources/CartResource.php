<?php

namespace App\Admin\v1\Http\Cart\Resources;

use App\Admin\v1\Http\Product\Resources\ProductResource;
use App\Helpers\HasPaginatedCollection;
use App\User\v1\Http\Client\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'carts',
            'attributes' => [
                'user_id' => $this->userId,
                'name' => $this->name,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
                'user' => $this->when($this->user, function () {
                    return UserResource::make($this->user);
                }),
                'products_with_details' => $this->when($this->productsWithDetails, function () {
                    return ProductResource::collection($this->productsWithDetails->items());
                }),
            ]
        ];
    }
}
