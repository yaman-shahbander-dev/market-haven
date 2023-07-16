<?php

namespace Domain\Order\Actions\User;

use App\Exceptions\ProductQuantityNotEnoughException;
use Domain\Product\Models\ProductColor;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckCartProductQuantityAction
{
    use AsAction;

    public function __construct(
        protected ProductColor $productColor
    ) {
    }

    public function handle($cartProducts, $cartProductsData): bool
    {
        foreach ($cartProducts as $i => $cartProduct) {
            $cartProductData = $cartProductsData[$i];

            if ($cartProductData['quantity'] > $cartProduct['quantity']) {
                return false;
            }

            if ($cartProductData['quantity'] > $cartProduct['productColor']['quantity']) {
                return throw new ProductQuantityNotEnoughException($cartProduct['product']['title']);
            }
        }

        return true;
    }
}
