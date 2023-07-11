<?php

namespace Domain\Cart\Actions\User;

use App\Exceptions\DataNotFoundException;
use Domain\Cart\DataTransferObjects\ProductCartData;
use Domain\Cart\Models\Cart;
use Domain\Product\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class RemoveProductFromCartAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart,
        protected Product $product
    ) {
    }

    public function handle(ProductCartData $data): DataNotFoundException|bool
    {
        $cart = QueryBuilder::for($this->cart)
            ->where('id', $data->cartId)
            ->first();

        if (!$cart) return throw new DataNotFoundException();

        $product = QueryBuilder::for($this->product)
            ->where('id', $data->productId)
            ->first();

        if (!$product) return throw new DataNotFoundException();

        $result = DecrementCartQuantityAndPriceAction::run($cart, $data);

        if ($result) {
            return DecrementCartProductAction::run($cart, $data);
        }

        return false;
    }
}
