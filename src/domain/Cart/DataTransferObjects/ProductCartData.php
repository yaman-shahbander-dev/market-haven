<?php

namespace Domain\Cart\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProductCartData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $productId,
        public string $cartId,
        public string $quantity,
        public string $price,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
