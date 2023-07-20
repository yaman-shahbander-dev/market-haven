<?php

namespace Domain\Payment\Actions;

use Domain\Order\Models\Order;
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
//        $paymentService = $this->paymentManager->make($data->order->paymentGateway);
//        $checkOrder = $paymentService->checkCapablePayment($data->ePayment->gatewayPaymentId);
//
//        if (is_array($checkOrder)) return false;
//
//        $order = Order::find($data->order->id);
//
//        if (!$order->isCaptureable($data)) return false;
//
//        $confirm = $paymentService->confirmPayment($data->ePayment->gatewayPaymentId);
//        return $confirm;
//
//        if ($confirm) {
//            $order->state = 'captured'; // to be changed
//            return $order->save();
//        }
//
//        return false;
    }
}
