<?php

namespace Domain\Client\DataTransferObjects;

use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class GithubData extends BaseData
{
    public function __construct(
        public ?string $code,
        public ?string $provider,
        public ?string $error,
        public ?string $errorDescription,
        public ?string $errorUri,
    ) {
    }
}
