<?php

namespace Domain\Product\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProductColorData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $color,
        public string $quantity,
    ) {
    }
}
