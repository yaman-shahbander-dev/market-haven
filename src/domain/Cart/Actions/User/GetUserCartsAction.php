<?php

namespace Domain\Cart\Actions\User;

use Domain\Cart\DataTransferObjects\CartData;
use Domain\Cart\Models\Cart;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetUserCartsAction
{
    use AsAction;

    public function __construct(
        protected Cart $cart
    ) {
    }

    public function handle(string $userId): PaginatedDataCollection
    {
        $carts = QueryBuilder::for($this->cart)
            ->where('user_id', $userId)
            ->allowedIncludes(['user', 'productsWithDetails'])
            ->paginate();

        return CartData::collection($carts);
    }
}
