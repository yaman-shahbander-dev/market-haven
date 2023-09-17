<?php

namespace Domain\Cart\Actions\Admin;

use Domain\Cart\DataTransferObjects\CartData;
use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowCartAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(string $id): CartData
    {
        $cart = QueryBuilder::for($this->cart)
            ->where('id', $id)
            ->allowedIncludes(['user', 'productsWithDetails'])
            ->first();

        return CartData::from($cart);
    }
}
