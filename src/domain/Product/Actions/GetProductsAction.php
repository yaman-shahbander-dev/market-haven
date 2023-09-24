<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\ProductData;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductColor;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetProductsAction
{
    use AsAction;

    public function __construct(
        protected Product $product,
        protected ProductColor $productColor
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $products = QueryBuilder::for($this->product->productsDetails())
            ->allowedIncludes(['reviews'])
            ->paginate();

        return ProductData::collection($products);
    }
}
