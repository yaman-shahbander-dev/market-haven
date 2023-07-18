<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\Models\CartProduct;
use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductsAndColorsQuantityAction
{
    use AsAction;

    public function __construct(
        protected CartProduct $cartProduct
    ) {
    }

    public function handle(OrderCartProductsData $data): bool
    {
        $result = collect($data->orderData->cartProducts)->map(function ($cartProduct, $key) use ($data) {
            $cartProductData = $data->cartProducts[$key];

            $result1 = UpdateCartProductQuantityAndPriceAction::run($cartProduct, $cartProductData);

            $result2 = UpdateProductDetailQuantityAction::run($cartProduct, $cartProductData);

            $result3 = UpdateProductColorQuantityAction::run($cartProduct, $cartProductData);

            return $result1 && $result2 && $result3;
        });

        return !$result->contains(false);
    }
}
