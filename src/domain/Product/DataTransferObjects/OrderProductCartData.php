<?php

namespace Domain\Product\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderProductCartData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $title,
        public string $description,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ProductDetailData $productDetail,
    ) {
    }
}
