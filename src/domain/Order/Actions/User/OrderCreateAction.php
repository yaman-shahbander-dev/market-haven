<?php

namespace Domain\Order\Actions\User;

use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Domain\Order\Models\Order;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @param OrderCartProductsData $data
*/

class OrderCreateAction
{
    use AsAction;

    public function __construct(
        protected Order $order
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

        if ($order) {
            return UpdateCartQuantityAndPriceAction::run($data);
        }

        return false;
    }
}
