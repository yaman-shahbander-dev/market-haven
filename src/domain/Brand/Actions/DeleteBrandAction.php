<?php

namespace Domain\Brand\Actions;

use Domain\Brand\Models\Brand;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteBrandAction
{
    use AsAction;

    public function __construct(
        protected Brand $brand
    ) {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->brand)
            ->where('id', $id)
            ->delete();
    }
}
