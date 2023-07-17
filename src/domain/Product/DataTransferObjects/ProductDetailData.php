<?php

namespace Domain\Product\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProductDetailData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $productId,
        public float $price,
        public float $discount,
        public int $quantity,
        public bool $available,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
