<?php

namespace Domain\Payment\Services\Services;

use App\Enums\StatusCodes\HttpStatus;
use App\Traits\StripeHelper;
use Domain\Order\Models\Order;
use Domain\Payment\Actions\Stripe\ConfirmPaymentAction;
use Domain\Payment\Actions\Stripe\CreatePaymentAction;
use Domain\Payment\Actions\Stripe\GetPaymentAction;
use Domain\Payment\DataTransferObjects\StripeData;
use Domain\Payment\Models\EPayment;
use Domain\Payment\Services\IServices\IPaymentService;
use Shared\Helpers\ErrorResult;
use Stripe\PaymentIntent;
use Exception;

class StripeService implements IPaymentService
{
    use StripeHelper;
    public function createPayment(Order $order): StripeData|ErrorResult
    {
        $result = CreatePaymentAction::run($order);

        return ($result instanceof PaymentIntent)
            ? StripeData::fromArray($result->toArray())
            : $this->getExceptionDto($result, HttpStatus::INTERNAL_SERVER_ERROR->value);
    }

    public function checkCapablePayment(string $orderId): ErrorResult|StripeData
    {
        $result = GetPaymentAction::run($orderId);

        if ($result instanceof PaymentIntent) {
            // add state here // to be changed
            $data = StripeData::fromArray($result->toArray());
            return ($data->state == 'approved') // to be changed
                ? $data
                : ErrorResult::from(['message' => 'User did not add payment information']);
        }

        return $this->getExceptionDto($result, HttpStatus::INTERNAL_SERVER_ERROR->value);
    }

    public function confirmPayment(string $orderId): ErrorResult|StripeData
    {
        $result = ConfirmPaymentAction::run($orderId);

        if ($result instanceof PaymentIntent) {
            $data = StripeData::fromArray($result->toArray());
            EPayment::query()->where('gateway_payment_id', $result->id)
                ->update([
                    'confirmed_at' => now(),
                    'state' => 'captured' // to be changed
                ]);
            return $data->state == 'succeed'
                ? $data
                : ErrorResult::from(['message' => 'Payment not captured.', 'state' => HttpStatus::BAD_REQUEST]);
        }

        return $this->getExceptionDto($result, HttpStatus::INTERNAL_SERVER_ERROR->value);
    }
}
