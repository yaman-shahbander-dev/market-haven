<?php

namespace Domain\Payment\DataTransferObjects;

use Carbon\Carbon;
use Domain\Payment\States\PaymentState;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EPaymentData extends BaseData
{
    public function __construct(
        public ?string $id,
        public int $gatewayId,
        public ?string $gatewayPaymentId,
        public ?string $gatewayClientPaymentId,
        public float $value,
        public ?string $gatewayState,
        public ?string $state,
        public ?Carbon $confirmedAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
