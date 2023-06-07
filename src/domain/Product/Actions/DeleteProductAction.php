<?php

namespace Domain\Product\Actions;

use Domain\Product\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteProductAction
{
    use AsAction;

    public function __construct(
        protected Product $product
    ) {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->product)
            ->where('id', $id)
            ->delete();
    }
}
