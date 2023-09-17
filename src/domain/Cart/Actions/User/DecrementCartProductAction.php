<?php

namespace Domain\Cart\Actions\User;

use Domain\Cart\DataTransferObjects\ProductCartData;
use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;

class DecrementCartProductAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(Cart $cart, ProductCartData $data): bool
    {
        $cartProduct = $cart->cartProducts()
            ->where([
                'product_id' => $data->productId,
                'product_color_id' => $data->productColorId
            ])
            ->first();

        if ($cartProduct) {
            if ($cartProduct->quantity - $data->quantity == 0) {
                return $cartProduct->delete();
            }

            return $cartProduct->update([
                'quantity' => (int)$cartProduct->quantity - (int)$data->quantity,
                'price' => (double)$cartProduct->price - ((double)$data->price * (int)$data->quantity),
            ]);
        }

        return false;
    }
}
