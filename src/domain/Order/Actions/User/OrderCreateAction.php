<?php

namespace Domain\Order\Actions\User;

use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Domain\Order\Models\Order;
use Domain\Order\States\Pending;
use Domain\Payment\Actions\CreatePaymentAction;
use Domain\Payment\Managers\IManagers\IPaymentManager;
use Domain\Payment\Models\PaymentGateway;
use Lorisleiva\Actions\Concerns\AsAction;
use Shared\Helpers\ErrorResult;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @param OrderCartProductsData $data
*/

class OrderCreateAction
{
    use AsAction;

    public function __construct(
        protected Order $order,
        protected IPaymentManager $paymentManager,
        protected PaymentGateway $paymentGateway
    ) {
    }

    public function handle(OrderCartProductsData $data)
    {
        $order = QueryBuilder::for($this->order)
            ->create([
                'no' => $data->orderData->no,
                'user_id' => $data->orderData->userId,
                'first_name' => $data->orderData->firstName,
                'last_name' => $data->orderData->lastName,
                'email' => $data->orderData->email,
                'payment_gateway' => $data->orderData->paymentGateway,
                'price' => $data->orderData->price,
                'state' => $data->orderData->state,
                'expired_at' => $data->orderData->expiredAt,
                'created_at' => now(),
                'updated_at' => now()
            ]);


        if (!$order) return ErrorResult::from([]);

        $order->state->transitionTo(Pending::class);

        $result1 = UpdateCartQuantityAndPriceAction::run($data);
        $result2 = UpdateProductsAndColorsQuantityAction::run($data);

        if(!($result1 && $result2)) return ErrorResult::from([]);

        return CreatePaymentAction::run($data, $order);
    }
}
