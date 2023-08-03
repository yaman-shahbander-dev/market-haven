<?php

namespace Domain\Payment\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PaymentGatewayData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $name,
        public string $key,
        public ?Carbon $disabledAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
