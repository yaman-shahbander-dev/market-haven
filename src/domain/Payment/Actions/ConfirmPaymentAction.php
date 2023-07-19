<?php

namespace Domain\Payment\Actions;

use Domain\Payment\DataTransferObjects\OrderEPaymentData;
use Domain\Payment\Managers\IManagers\IPaymentManager;
use Lorisleiva\Actions\Concerns\AsAction;

class ConfirmPaymentAction
{
    use AsAction;

    public function __construct(
        protected IPaymentManager $paymentManager
    ) {
    }

    public function handle(OrderEPaymentData $data)
    {
        $paymentService = $this->paymentManager->make($data->order->paymentGateway);
        $checkOrder = $paymentService->checkCapablePayment($data->ePayment->gatewayPaymentId);

        return $checkOrder;
    }
}
