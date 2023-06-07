<?php

namespace Domain\Product\Actions;

use Domain\Brand\DataTransferObjects\BrandData;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductBrand;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;

class SyncProductBrandsAction
{
    use AsAction;

    public function __construct(
        protected ProductBrand $productBrand
    ) {
    }

    public function handle(Product $product, array $productBrandIds): ?string
    {
        if (!empty($product->brands()->sync($productBrandIds))) {
            $brands = $product->brands()->select('brands.name')->get();
            return $brands->pluck('name')->implode(', ');
        }

        return null;
    }
}
