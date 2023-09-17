<?php

namespace Domain\Cart\DataTransferObjects;

use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CreateCartData extends BaseData
{
    public function __construct(
        public string $name,
        public string $userId,
    ) {
    }
}
