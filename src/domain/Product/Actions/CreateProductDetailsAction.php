<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\CreateOrUpdateProductData;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductDetail;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateProductDetailsAction
{
    use AsAction;

    public function __construct(
        protected ProductDetail $productDetail
    ) {
    }

    public function handle(string $productId, string $price, string $discount, string $quantity, string $available): QueryBuilder|ProductDetail
    {
        return QueryBuilder::for($this->productDetail)
            ->create([
                'product_id' => $productId,
                'price' => $price,
                'discount' => $discount,
                'quantity' => $quantity,
                'available' => $available,
            ]);
    }
}
