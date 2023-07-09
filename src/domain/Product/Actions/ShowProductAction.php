<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\ProductData;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductColor;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowProductAction
{
    use AsAction;

    public function __construct(
        protected Product $product,
        protected ProductColor $productColor
    ) {
    }

    public function handle(string $id): ProductData
    {
        $product = QueryBuilder::for($this->product->productsDetails($id))
            ->first();

        return ProductData::from($product);
    }
}
