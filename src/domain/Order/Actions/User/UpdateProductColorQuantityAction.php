<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\DataTransferObjects\CartProductData;
use Domain\Product\Models\ProductColor;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductColorQuantityAction
{
    use AsAction;

    public function __construct(
        protected ProductColor $productColor
    ) {
    }

    public function handle(array $cartProduct, CartProductData $cartProductData): bool
    {
        return $this
            ->productColor
            ->query()
            ->where('id', $cartProductData->productColor->id)
            ->update([
                'quantity' => $cartProductData->productColor->quantity - $cartProduct['quantity']
            ]);
    }
}
