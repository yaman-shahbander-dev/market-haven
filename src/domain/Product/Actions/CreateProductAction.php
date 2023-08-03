<?php

namespace Domain\Product\Actions;

use Domain\Product\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateProductAction
{
    use AsAction;

    public function __construct(
        protected Product $product,
    ) {
    }

    public function handle(string $title, string $description): Product|QueryBuilder
    {
        return QueryBuilder::for($this->product)
            ->create([
                'title' => $title,
                'description' => $description
            ]);
    }
}
