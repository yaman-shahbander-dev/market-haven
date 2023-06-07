<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\CreateOrUpdateProductData;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductDetail;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateProductAction
{
    use AsAction;

    public function __construct(
        protected Product $product,
        protected ProductDetail $productDetail
    ) {
    }

    public function handle(CreateOrUpdateProductData $data): bool
    {
        $product = tap(
            QueryBuilder::for($this->product)->where('id', $data->id)
        )
            ->update([
                'title' => $data->title,
                'description' => $data->description
            ])
            ->first();

        if ($product) {
            $productDetails = tap(
                QueryBuilder::for($this->productDetail)->where('product_id', $product->id)
            )
                ->update([
                    'price' => $data->price,
                    'discount' => $data->discount,
                    'quantity' => $data->quantity,
                    'available' => $data->available
                ])
                ->first();

            if ($productDetails) {
                $result = UpdateProductColorsAction::run($productDetails->id, $data->productColorInfo);

                $brands = SyncProductBrandsAction::run($product, $data->productBrandIds);

                $categories = SyncProductCategoriesAction::run($product, $data->productCategoryIds);

                return $result && !empty($brands) && !empty($categories);
            }
        }

        return false;
    }
}
