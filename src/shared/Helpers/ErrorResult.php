<?php

namespace Shared\Helpers;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ErrorResult extends BaseData
{
    public function __construct(
        public mixed $state,
        public ?string $message,
        public mixed $data
    ) {
    }
}
