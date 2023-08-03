<?php

namespace Domain\Payment\Actions\PayPal;

use App\Traits\PayPalHelper;
use Lorisleiva\Actions\Concerns\AsAction;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpResponse;
use Exception;

class ConfirmPaymentAction
{
    use AsAction, PayPalHelper;

    public function handle(string $orderId): Exception|HttpResponse
    {
        try {
            $ordersConfirmRequest = new OrdersCaptureRequest($orderId);
            return (self::client())->execute($ordersConfirmRequest);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
