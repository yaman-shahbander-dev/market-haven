<?php

namespace App\Admin\v1\Http\Review\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{

    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'reviews',
            'attributes' => [
                'reviewable_id' => $this->reviewableId,
                'reviewable_type' => $this->reviewableType,
                'user_id' => $this->userId,
                'rating' => $this->rating,
                'review' => $this->review,
                'approved_at' => $this->approvedAt,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
            'relationships' => [
            ]
        ];
    }
}
