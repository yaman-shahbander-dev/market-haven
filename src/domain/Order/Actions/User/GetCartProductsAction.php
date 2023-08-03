<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\DataTransferObjects\CartProductData;
use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartProduct;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;

/**
 * Get cart products
 * @param Cart $cart
 * @param DataCollection<CartProductData> $cartProducts
 * @return DataCollection<CartProductData>
 * */
class GetCartProductsAction
{
    use AsAction;

    public function __construct(
        protected CartProduct $cartProduct
    ) {
    }

    public function handle(Cart $cart, DataCollection $cartProducts): DataCollection
    {
        $cartProducts = $cart
            ->cartProducts()
            ->whereIn('id', collect($cartProducts)->pluck('id'))
            ->with([
                'product' => function ($query) {
                    $query->with('productDetail');
                },
                'productColor'
            ])
            ->get();

        return CartProductData::collection($cartProducts);
    }
}
