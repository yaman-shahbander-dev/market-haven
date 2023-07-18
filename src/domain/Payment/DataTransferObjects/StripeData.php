<?php

namespace Domain\Payment\DataTransferObjects;

use App\Enums\StatusCodes\HttpStatus;
use Domain\Payment\Enums\PaymentGatewayEnum;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class StripeData extends BaseData
{
    public function __construct(
        public string $gatewayPaymentId,
        public string $gatewayClientPaymentId,
        public string $state, //public PaymentState $state;
        public string $gatewayState,
        public string $paymentGateway,
        public ?bool $isSucceed,
        public ?string $statusCode
    ) {
    }

    public static function fromArray(array $data): StripeData
    {
        $stripePaymentStatuses = [
            'requires_payment_method' => 'created',
            'requires_capture' => 'approved',
            'processing' => 'pending',
            'succeeded' => 'succeed',
            'canceled' => 'failed'
        ];

        return new self(
            $data['id'],
            $data['client_secret'],
            $stripePaymentStatuses[$data['status']],
            $data['status'],
            PaymentGatewayEnum::STRIPE->value,
            true,
            HttpStatus::OK->value
        );
    }
}
