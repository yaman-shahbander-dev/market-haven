<?php

namespace Domain\Cart\Actions\Admin;

use Domain\Cart\DataTransferObjects\CartData;
use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetCartsAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $carts = QueryBuilder::for($this->cart)
            ->allowedIncludes(['user', 'productsWithDetails'])
            ->paginate();

        return CartData::collection($carts);
    }
}
