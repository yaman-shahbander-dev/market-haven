<?php

namespace Domain\Order\Actions\User;

use App\Exceptions\DataNotFoundException;
use Domain\Cart\DataTransferObjects\CartProductData;
use Domain\Cart\Models\Cart;
use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Domain\Order\DataTransferObjects\OrderData;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * create an order
 * @param OrderData $orderData
 * @param Cart $cart
 * @param DataCollection<CartProductData> $cartProducts
*/

class CreateOrderAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(OrderData $orderData)
    {
        $cart = QueryBuilder::for($this->cart)
            ->where([
                'id' => $orderData->cartId,
                'user_id' => $orderData->userId
            ])
            ->first();

        if (!$cart) return throw new DataNotFoundException();

        $cartProducts = GetCartProductsAction::run($cart, $orderData->cartProducts);

        if (!empty($cartProducts)) {
            if (CheckCartProductQuantityAction::run($cartProducts, $orderData->cartProducts)) {
                // create product in db
                //final result is returned in here
                return FillOrderDataAction::run(
                    OrderCartProductsData::from(['order_data' => $orderData, 'cart_products' => $cartProducts, 'cart' => $cart])
                );
            }
            return false;
        }
        return false;
    }
}
