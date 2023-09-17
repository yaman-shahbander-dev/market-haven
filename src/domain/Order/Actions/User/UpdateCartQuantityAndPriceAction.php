<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\Models\Cart;
use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateCartQuantityAndPriceAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(OrderCartProductsData $data): bool
    {
        $cartProductsQuantity = collect($data->orderData->cartProducts)->map(function ($cartProduct) {
            return $cartProduct['quantity'];
        })->sum();

        return QueryBuilder::for($this->cart)
            ->where('id', $data->cart->id)
            ->update([
                'quantity' => $data->cart->quantity - $cartProductsQuantity,
                'price' => $data->cart->price - $data->orderData->price,
            ]);
    }
}
