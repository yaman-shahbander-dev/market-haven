<?php

namespace Domain\Order\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CreateOrderData extends BaseData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $payment_gateway,
        public string $cartId,
        public string $userId,
        public array $cartProducts
    ) {
    }
}
