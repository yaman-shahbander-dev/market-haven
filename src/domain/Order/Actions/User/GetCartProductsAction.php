<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartProduct;
use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCartProductsAction
{
    use AsAction;

    public function __construct(
        protected CartProduct $cartProduct
    ) {
    }

    public function handle(Cart $cart, array $cartProducts): Collection
    {

        return $cart
            ->cartProducts()
            ->whereIn('id', collect($cartProducts)->pluck('id'))
            ->with([
                'product' => function ($query) {
                    $query->with('productDetail');
                },
                'productColor'
            ])
            ->get();
    }
}
