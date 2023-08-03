<?php

namespace Domain\Payment\Actions\PayPal;

use App\Traits\PayPalHelper;
use Lorisleiva\Actions\Concerns\AsAction;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalHttp\HttpResponse;
use Exception;

class GetPaymentAction
{
    use AsAction, PayPalHelper;

    public function handle(string $orderId): Exception|HttpResponse
    {
        try {
            $ordersGetRequest = new OrdersGetRequest($orderId);
            return (self::client())->execute($ordersGetRequest);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
