<?php

namespace Domain\Cart\Actions\User;

use Domain\Cart\DataTransferObjects\ProductCartData;
use Domain\Cart\Models\Cart;
use Domain\Product\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class DecrementCartQuantityAndPriceAction
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

        if ($cartProduct->quantity - $data->quantity < 0) {
            return false;
        }

        return $cart->update([
            'quantity' => (int)$cart->quantity - (int)$data->quantity,
            'price' => (double)$cart->price - ((double)$data->price * (int)$data->quantity)
        ]);
    }
}
