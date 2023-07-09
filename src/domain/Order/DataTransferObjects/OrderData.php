<?php

namespace Domain\Order\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $userId,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $state,
        public string $price,
        public ?Carbon $expiredAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
