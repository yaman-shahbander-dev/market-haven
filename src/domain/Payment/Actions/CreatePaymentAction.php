<?php

namespace Domain\Payment\Actions;

use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Domain\Order\DataTransferObjects\OrderData;
use Domain\Order\Models\Order;
use Domain\Payment\DataTransferObjects\EPaymentData;
use Domain\Payment\DataTransferObjects\OrderEPaymentData;
use Domain\Payment\Jobs\CreatedOrderMailJob;
use Domain\Payment\Mail\OrderCreatedMail;
use Domain\Payment\Managers\IManagers\IPaymentManager;
use Domain\Payment\Models\PaymentGateway;
use Illuminate\Support\Facades\Mail;
use Lorisleiva\Actions\Concerns\AsAction;
use Shared\Helpers\ErrorResult;

class CreatePaymentAction
{
    use AsAction;

    public function __construct(
        protected IPaymentManager $paymentManager,
        protected PaymentGateway $paymentGateway
    ) {
    }

    public function handle(OrderCartProductsData $data, Order $order)
    {
        $paymentService = $this->paymentManager->make($data->orderData->paymentGateway);
        $gatewayPayment = $paymentService->createPayment($order);

        if ($gatewayPayment instanceof ErrorResult) return $gatewayPayment;

        $gateway = $this->paymentGateway->query()->where('key', $gatewayPayment->paymentGateway)->first();

        $ePaymentData = CreateEPaymentAction::run(EPaymentData::from([
            'gateway_id' => $gateway?->id,
            'gateway_payment_id' => $gatewayPayment->gatewayPaymentId,
            'gateway_client_payment_id' => $gatewayPayment->gatewayClientPaymentId,
            'value' => $order->price,
            'currency' => 'USD', // to be changed
            'gateway_state' => $gatewayPayment->gatewayState,
            'state' => $gatewayPayment->state
        ]));

        CreatedOrderMailJob::dispatch($order)->onQueue('order-creation');

        if ($ePaymentData) return OrderEPaymentData::from(['order' => OrderData::from($order), 'e_payment' => $ePaymentData]);

        return ErrorResult::from([]);
    }
}
