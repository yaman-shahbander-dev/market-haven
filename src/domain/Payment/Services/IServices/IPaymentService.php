<?php

namespace Domain\Payment\Services\IServices;

use Domain\Order\Models\Order;

interface IPaymentService
{
    public function createPayment(Order $order);
    public function checkCapablePayment(string $orderId);
    public function confirmPayment(string $orderId);
}
