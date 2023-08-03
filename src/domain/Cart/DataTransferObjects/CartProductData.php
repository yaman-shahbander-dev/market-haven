<?php

namespace Domain\Cart\DataTransferObjects;

use Carbon\Carbon;
use Domain\Product\DataTransferObjects\OrderProductCartData;
use Domain\Product\DataTransferObjects\ProductColorData;
use Domain\Product\DataTransferObjects\ProductData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CartProductData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $productId,
        public ?string $productColorId,
        public ?string $cartId,
        public int $quantity,
        public ?float $price,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?OrderProductCartData $product,
        public ?ProductColorData $productColor,
    ) {
    }
}
