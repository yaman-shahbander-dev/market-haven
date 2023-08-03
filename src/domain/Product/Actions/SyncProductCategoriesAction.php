<?php

namespace Domain\Product\Actions;

use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductCategory;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;

class SyncProductCategoriesAction
{
    use AsAction;

    public function __construct(
        protected ProductCategory $productCategory
    ) {
    }

    public function handle(Product $product, array $productCategoryIds): ?string
    {
        if (!empty($product->categories()->sync($productCategoryIds))) {
            $categories = $product->categories()->select('categories.name')->get();
            return $categories->pluck('name')->implode(', ');
        }

        return null;
    }
}
