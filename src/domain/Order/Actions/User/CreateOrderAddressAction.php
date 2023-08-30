<?php

namespace Domain\Order\Actions\User;

use Domain\Location\Models\Address;
use Domain\Order\DataTransferObjects\OrderData;
use Domain\Order\Models\Order;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateOrderAddressAction
{
    use AsAction;

    public function __construct(
        protected Address $address
    ) {
    }

    public function handle(OrderData $data, Order $order): bool
    {
        $result = QueryBuilder::for($this->address)
            ->create([
                'city_id' => $data->cityId,
                'order_id' => $order->id,
                'address' => $data->address,
                'postal_code' => $data->postalCode,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        return !!$result;
    }
}
