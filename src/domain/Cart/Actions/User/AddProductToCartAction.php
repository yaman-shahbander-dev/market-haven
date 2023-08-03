<?php

namespace Domain\Cart\Actions\User;

use App\Exceptions\DataNotFoundException;
use Domain\Cart\DataTransferObjects\ProductCartData;
use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class AddProductToCartAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(ProductCartData $data): DataNotFoundException|bool
    {
        $cart = QueryBuilder::for($this->cart)
            ->where('id', $data->cartId)
            ->first();

        if (!$cart) return throw new DataNotFoundException();

        $result = IncrementCartQuantityAndPriceAction::run($cart, $data);

        if ($result) {
            return IncrementCartProductAction::run($cart, $data);
        }

       return false;
    }
}
