<?php

namespace Domain\Order\Actions\User;

use App\Exceptions\DataNotFoundException;
use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartProduct;
use Domain\Order\DataTransferObjects\CreateOrderData;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateOrderAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart,
        protected CartProduct $cartProduct
    ) {
    }

    public function handle(CreateOrderData $data)
    {
        $cart = QueryBuilder::for($this->cart)
            ->where([
                'id' => $data->cartId,
                'user_id' => $data->userId
            ])
            ->first();

        if (!$cart) return throw new DataNotFoundException();

        $cartProducts = GetCartProductsAction::run($cart, $data->cartProducts);

        if (count($cartProducts) > 0) {
            $result = CheckCartProductQuantityAction::run($cartProducts, $data->cartProducts);

            // create product in db
            return $result;
        }

        return false;
    }
}
