<?php

namespace Domain\Product\Actions;

use Domain\Product\DataTransferObjects\ProductColorData;
use Domain\Product\Models\ProductColor;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class CreateProductColorsAction
{
    use AsAction;

    public function __construct(
        protected ProductColor $productColor
    ) {
    }

    public function handle(string $productDetailsId, DataCollection $productColorData): false|string
    {
        $data = [];

        foreach ($productColorData as $item) {
            $data[] = [
                'id' => Str::orderedUuid()->toString(),
                'product_detail_id' => $productDetailsId,
                'color' => $item->color,
                'quantity' => $item->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $productColors = tap(
            QueryBuilder::for($this->productColor)
        )
            ->insert($data)
            ->where('product_detail_id', $productDetailsId)
            ->select(['id', 'color', 'quantity'])
            ->get();

        return json_encode($productColors);
    }
}
