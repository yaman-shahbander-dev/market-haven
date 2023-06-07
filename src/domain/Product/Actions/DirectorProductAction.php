<?php

namespace Domain\Product\Actions;

use Domain\Product\Builders\Directors\ProductDirector;
use Domain\Product\DataTransferObjects\ProductData;
use Domain\Product\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class DirectorProductAction
{
    use AsAction;

    public function __construct(
        public Product $product,
        public ProductDirector $productDirector
    ) {
    }

    public function handle(array $data)
    {
        $productData = $this->productDirector->createProduct(
            $data['title'],
            $data['description'],
            $data['price'],
            $data['discount'],
            $data['quantity'],
            $data['available'],
            $data['product_color_info'],
            $data['product_brand_ids'],
            $data['product_category_ids'],
        );

        $product = CreateProductAction::run($productData->title, $productData->description);

        $productDetails = CreateProductDetailsAction::run($product->id, $productData->price, $productData->discount, $productData->quantity, $productData->available);

        $productColors = CreateProductColorsAction::run($productDetails->id, $productData->productColorInfo);

        $productBrands = SyncProductBrandsAction::run($product, $productData->productBrandIds);

        $productCategories = SyncProductCategoriesAction::run($product, $productData->productCategoryIds);

        return ProductData::from([
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'product_price' => $productDetails->price,
            'discount' => $productDetails->discount,
            'product_quantity' => $productDetails->quantity,
            'available' => $productDetails->available,
            'product_color_info' => $productColors,
            'product_brand_names' => $productBrands,
            'product_category_names' => $productCategories,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ]);
    }
}
