<?php

namespace Domain\Payment\Managers\Managers;

use Domain\Payment\Managers\IManagers\IPaymentManager;
use Domain\Payment\Services\IServices\IPaymentService;
use Domain\Payment\Services\Services\PayPalService;
use Domain\Payment\Services\Services\StripeService;
use Illuminate\Support\Facades\App;

class PaymentManager implements IPaymentManager
{
    public function make(string $payment): IPaymentService
    {
        $createdMethod = 'create' . ucfirst($payment) . 'Service';

        return $this->{$createdMethod}();
    }

    private function createStripeService(): StripeService
    {
        return App::make(StripeService::class);
    }

    private function createPaypalService(): PayPalService
    {
        return App::make(PayPalService::class);
    }
}
