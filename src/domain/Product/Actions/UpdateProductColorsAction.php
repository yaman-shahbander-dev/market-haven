<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\ProductColorData;
use Domain\Product\Models\ProductColor;
use Domain\Product\Models\ProductDetail;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateProductColorsAction
{
    use AsAction;

    public function __construct(
        protected ProductColor $productColor
    ) {
    }

    public function handle(string $productDetailsId, DataCollection $productColorData): bool
    {
        foreach ($productColorData as $item) {
            $result = $this->productColor
                ->where([
                    'id' => $item->id,
                    'product_detail_id' => $productDetailsId
                ])
                ->update([
                    'color' => $item->color,
                    'quantity' => $item->quantity
                ]);

            if (!$result) {
                return false;
            }
        }

        return true;
    }
}
