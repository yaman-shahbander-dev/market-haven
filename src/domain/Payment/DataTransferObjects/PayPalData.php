<?php

namespace Domain\Payment\DataTransferObjects;

use App\Enums\StatusCodes\HttpStatus;
use Domain\Payment\Enums\PaymentGatewayEnum;
use Domain\Payment\Models\EPayment;
use Domain\Payment\States\PaymentState;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PayPalData extends BaseData
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

    public static function fromArray(array $data, string $statusCode): PayPalData
    {
        $payPalPaymentStatuses = [
            'created',
            'approved',
            'pending',
            'captured',
            'denied',
            'expired',
            'failed',
            'succeed'
        ];

        return new self(
            $data['id'],
            $data['id'],
            (in_array(strtolower($data['status']), $payPalPaymentStatuses))
                ? PaymentState::make(strtolower($data['status']), new EPayment)
                : PaymentState::make('failed', new EPayment),
            $data['status'],
            PaymentGatewayEnum::PAYPAL->value,
            $statusCode == 201,
            $statusCode
        );
    }
}
