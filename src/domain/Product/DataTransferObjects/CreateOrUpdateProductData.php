<?php

namespace Domain\Product\DataTransferObjects;

use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CreateOrUpdateProductData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $title,
        public string $description,
        public string $price,
        public string $discount,
        public string $quantity,
        public string $available,
        #[DataCollectionOf(ProductColorData::class)]
        public DataCollection $productColorInfo,
        public array $productBrandIds,
        public array $productCategoryIds,
    ) {
    }
}
