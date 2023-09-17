<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\DataTransferObjects\CartProductData;
use Domain\Cart\Models\CartProduct;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCartProductQuantityAndPriceAction
{
    use AsAction;

    public function __construct(
        protected CartProduct $cartProduct
    ) {
    }

    public function handle(array $cartProduct, CartProductData $cartProductData): bool
    {
        return $this
            ->cartProduct
            ->query()
            ->where('id', $cartProduct['id'])
            ->update([
                'quantity' => $cartProductData->quantity - $cartProduct['quantity'],
                'price' => $cartProductData->price - ($cartProductData->product->productDetail->price * $cartProduct['quantity']),
            ]);
    }
}
