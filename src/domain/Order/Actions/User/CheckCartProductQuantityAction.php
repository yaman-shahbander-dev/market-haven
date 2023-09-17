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
        $result = collect($cartProducts)->filter(function ($cartProduct, $key) use ($cartProductsData) {
            $cartProductDataQuantity = $cartProductsData[$key]->quantity;

            if ($cartProductDataQuantity > $cartProduct['quantity']) {
                return false;
            }

            if ($cartProductDataQuantity > $cartProduct['product_color']['quantity']) {
                return throw new ProductQuantityNotEnoughException($cartProduct['product']['title']);
            }

            return true;
        });

        return $result->isNotEmpty();
    }
}
