<?php

namespace Domain\Category\Actions;

use Domain\Category\Models\Category;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class DeleteCategoryAction
{
    use AsAction;

    public function __construct(
        protected Category $category
    ) {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->category)
            ->where('id', $id)
            ->delete();
    }
}
