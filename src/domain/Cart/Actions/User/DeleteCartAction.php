<?php

namespace Domain\Cart\Actions\User;

use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteCartAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(string $cartId): bool
    {
        $cart = QueryBuilder::for($this->cart)
            ->where('id', $cartId)
            ->first();

        if ($cart->cartProducts()->count() > 0) {
            $cart->cartProducts()->delete();
        }

        return $cart->delete();
    }
}
