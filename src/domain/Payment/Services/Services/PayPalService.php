<?php

namespace Domain\Payment\Services\Services;

use App\Enums\StatusCodes\HttpStatus;
use Domain\Order\Models\Order;
use Domain\Payment\Actions\PayPal\ConfirmPaymentAction;
use Domain\Payment\Actions\PayPal\CreatePaymentAction;
use Domain\Payment\Actions\PayPal\GetPaymentAction;
use Domain\Payment\DataTransferObjects\PayPalData;
use Domain\Payment\Models\EPayment;
use Domain\Payment\Services\IServices\IPaymentService;
use Domain\Payment\States\Approved;
use Domain\Payment\States\Captured;
use PayPalHttp\HttpResponse;
use Shared\Helpers\ErrorResult;

class PayPalService implements IPaymentService
{
    public function createPayment(Order $order): PayPalData|ErrorResult
    {
        $result = CreatePaymentAction::run($order);

        return ($result instanceof HttpResponse)
            ? PayPalData::fromArray((array)$result->result, $result->statusCode)
            : ErrorResult::from(['state' => HttpStatus::INTERNAL_SERVER_ERROR->value, 'massage' => $result->getMessage()]);
    }

    public function checkCapablePayment(string $orderId): PayPalData|ErrorResult
    {
        $result = GetPaymentAction::run($orderId);

        if ($result instanceof HttpResponse) {
            $data = PayPalData::fromArray((array)$result->result, $result->statusCode);

            return ($data->state === Approved::getMorphClass())
                ? $data
                : ErrorResult::from(['state' => HttpStatus::BAD_REQUEST->value, 'message' => 'Payment not authorized.']);
        }

        return ErrorResult::from([
            'state' => HttpStatus::INTERNAL_SERVER_ERROR->value, 'massage' => $result->getMessage()
        ]);
    }

    public function confirmPayment(string $orderId): PayPalData|ErrorResult
    {
        $result = ConfirmPaymentAction::run($orderId);

        if ($result instanceof HttpResponse) {
            EPayment::query()->where('gateway_payment_id', $result->result->id)
                ->update([
                    'confirmed_at' => now(),
                    'state' => Captured::getMorphClass()
                ]);

            return PayPalData::fromArray((array)$result->result, $result->statusCode);
        }

        return ErrorResult::from([
            'state' => HttpStatus::INTERNAL_SERVER_ERROR->value, 'massage' => $result->getMessage()
        ]);
    }
}
