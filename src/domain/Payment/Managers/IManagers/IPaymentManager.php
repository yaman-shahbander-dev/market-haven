<?php

namespace Domain\Payment\Managers\IManagers;

use Domain\Payment\Services\IServices\IPaymentService;

interface IPaymentManager
{
    public function make(string $payment): IPaymentService;
}
