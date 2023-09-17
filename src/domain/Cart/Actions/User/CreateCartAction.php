<?php

namespace Domain\Cart\Actions\User;

use Domain\Cart\DataTransferObjects\CartData;
use Domain\Cart\DataTransferObjects\CreateCartData;
use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateCartAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(CreateCartData $data): CartData
    {
        $cart = QueryBuilder::for($this->cart)->create([
            'name' => $data->name,
            'user_id' => $data->userId,
            'quantity' => 0,
            'price' => 0
        ]);

        return CartData::from($cart);
    }
}
