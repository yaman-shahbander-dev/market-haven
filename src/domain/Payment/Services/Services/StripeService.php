<?php

namespace Domain\Payment\Services\Services;

use App\Enums\StatusCodes\HttpStatus;
use App\Traits\StripeHelper;
use Domain\Order\Models\Order;
use Domain\Payment\Actions\Stripe\CreatePaymentAction;
use Domain\Payment\Actions\Stripe\GetPaymentAction;
use Domain\Payment\DataTransferObjects\StripeData;
use Domain\Payment\Services\IServices\IPaymentService;
use Stripe\PaymentIntent;
use Exception;

class StripeService implements IPaymentService
{
    use StripeHelper;
    public function createPayment(Order $order): StripeData|array
    {
        $result = CreatePaymentAction::run($order);

        return ($result instanceof PaymentIntent)
            ? StripeData::fromArray($result->toArray())
            : $this->getExceptionDto($result, HttpStatus::INTERNAL_SERVER_ERROR->value);
    }

    public function checkCapablePayment(string $orderId): StripeData|array
    {
        $result = GetPaymentAction::run($orderId);

        if ($result instanceof PaymentIntent) {
            // add state here // to be changed
            return StripeData::fromArray($result->toArray());
        }

        return $this->getExceptionDto($result, HttpStatus::INTERNAL_SERVER_ERROR->value);
    }
}
