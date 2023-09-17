<?php

namespace Domain\Payment\DataTransferObjects;

use Domain\Order\DataTransferObjects\OrderData;
use Lorisleiva\Actions\Concerns\AsAction;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderEPaymentData extends BaseData
{
    public function __construct(
        public OrderData $order,
        public EPaymentData $ePayment
    ) {
    }
}
