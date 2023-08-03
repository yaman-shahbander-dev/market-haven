<?php

namespace Domain\Payment\Actions;

use Domain\Order\Models\Order;
use Domain\Payment\DataTransferObjects\OrderEPaymentData;
use Domain\Payment\Managers\IManagers\IPaymentManager;
use Domain\Payment\States\Captured;
use Lorisleiva\Actions\Concerns\AsAction;
use Shared\Helpers\ErrorResult;

class ConfirmPaymentAction
{
    use AsAction;

    public function __construct(
        protected IPaymentManager $paymentManager
    ) {
    }

    public function handle(OrderEPaymentData $data): bool|ErrorResult
    {
        $paymentService = $this->paymentManager->make($data->order->paymentGateway);
        $checkOrder = $paymentService->checkCapablePayment($data->ePayment->gatewayPaymentId);

        if ($checkOrder instanceof ErrorResult) return $checkOrder;

        $order = Order::find($data->order->id);

        if (!$order->isCaptureable($data)) return ErrorResult::from(['message' => 'Order is not captureable']);

        $confirm = $paymentService->confirmPayment($data->ePayment->gatewayPaymentId);
        if ($confirm instanceof ErrorResult) return $confirm;

        return $order->update(['state' => Captured::getMorphClass(), 'user_id' => $data->order->userId]);
    }
}
