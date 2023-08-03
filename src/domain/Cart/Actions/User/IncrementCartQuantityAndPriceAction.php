<?php

namespace Domain\Cart\Actions\User;

use Domain\Cart\DataTransferObjects\ProductCartData;
use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;

class IncrementCartQuantityAndPriceAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(Cart $cart, ProductCartData $data): bool
    {
        return $cart->update([
            'quantity' => (int)$cart->quantity + (int)$data->quantity,
            'price' => (double)$cart->price + ((double)$data->price * (int)$data->quantity)
        ]);
    }
}
