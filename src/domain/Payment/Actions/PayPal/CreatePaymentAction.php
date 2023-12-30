<?php

namespace Domain\Payment\Actions\PayPal;

use App\Traits\PayPalHelper;
use Domain\Order\Models\Order;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpResponse;

class CreatePaymentAction
{
    use AsAction, PayPalHelper;

    public function handle(Order $order): Exception|HttpResponse
    {
        try {
            $ordersCreateRequest = new OrdersCreateRequest();
            $ordersCreateRequest->body = self::buildOrderRequest('USD', $order->price);
            return (self::client())->execute($ordersCreateRequest);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
