<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\ProductData;
use Domain\Product\Models\Product;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;

class SearchProductsAction
{
    use AsAction;

    public function __construct(protected Product $product)
    {
    }

    public function handle(string $search): ?PaginatedDataCollection
    {
        $products = $this->product
            ->search($search)
            ->query(function ($query) {
                $query->select([
                        'products.*',
                        'product_details.price AS product_price',
                        'product_details.discount',
                        'product_details.quantity AS product_quantity',
                        'product_details.available',
                        DB::raw('(
                            SELECT JSON_ARRAYAGG(JSON_OBJECT("id", id, "color", color, "quantity", quantity))
                            FROM product_colors
                            WHERE product_colors.product_detail_id = product_details.id
                        ) AS product_color_info'),
                        DB::raw('GROUP_CONCAT(DISTINCT brands.name SEPARATOR ", ") AS product_brand_names'),
                        DB::raw('GROUP_CONCAT(DISTINCT categories.name SEPARATOR ", ") AS product_category_names')
                    ])
                    ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
                    ->leftJoin('product_colors', 'product_colors.product_detail_id', '=', 'product_details.id')
                    ->leftJoin('product_brand', 'products.id', '=', 'product_brand.product_id')
                    ->leftJoin('brands', 'product_brand.brand_id', '=', 'brands.id')
                    ->leftJoin('product_category', 'product_category.product_id', '=', 'products.id')
                    ->leftJoin('categories', 'categories.id', '=', 'product_category.category_id')
                    ->groupBy([
                        'products.id',
                        'products.title',
                        'products.description',
                        'products.created_at',
                        'products.updated_at',
                        'products.deleted_at',
                        'product_details.id',
                        'product_details.price',
                        'product_details.discount',
                        'product_details.quantity',
                        'product_details.available',
                    ])
                    ->orderBy('products.id', 'DESC');
            })
            ->paginate();

        return $products ? ProductData::collection($products) : null;
    }
}
