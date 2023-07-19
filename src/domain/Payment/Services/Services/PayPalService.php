<?php

namespace Domain\Payment\Services\Services;

use Domain\Order\Models\Order;
use Domain\Payment\Services\IServices\IPaymentService;

class PayPalService implements IPaymentService
{
    public function createPayment(Order $order)
    {
        return $order;
    }

    public function checkCapablePayment(string $orderId)
    {
        return $orderId;
    }
}
