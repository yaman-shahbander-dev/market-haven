<?php

namespace App\Admin\v1\Http\Category\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'categories',
            'attributes' => [
                'name' => $this->name,
                'main_category_id' => $this->mainCategoryId,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
        ];
    }
}
