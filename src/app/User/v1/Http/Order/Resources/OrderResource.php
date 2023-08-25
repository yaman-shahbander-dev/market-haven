<?php

namespace App\User\v1\Http\Order\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'orders',
            'attributes' => [
                'no' => $this->no,
                'user_id' => $this->userId,
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
                'payment_gateway' => $this->paymentGateway,
                'price' => $this->price,
                'state' => $this->state,
                'expired_at' => $this->expiredAt,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
