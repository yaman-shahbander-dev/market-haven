<?php

namespace App\Admin\v1\Http\Product\Resources;

use App\Helpers\HasPaginatedCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    use HasPaginatedCollection;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'products',
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'product_price' => $this->productPrice,
                'discount' => $this->discount,
                'product_quantity' => $this->productQuantity,
                'available' => $this->available,
                'product_color_info' => $this->productColorInfo,
                'product_brand_names' => $this->productBrandNames,
                'product_category_names' => $this->productCategoryNames,
                'created_at' => $this->createdAt,
                'updated_at' => $this->updatedAt,
                'deleted_at' => $this->deletedAt,
            ],
        ];
    }
}
