<?php

namespace Domain\Product\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProductData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $title,
        public string $description,
        public string $productPrice,
        public string $discount,
        public string $productQuantity,
        public string $available,
        public string $productColorInfo,
        public string $productBrandNames,
        public string $productCategoryNames,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
