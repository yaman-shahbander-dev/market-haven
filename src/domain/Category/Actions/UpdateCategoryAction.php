<?php

namespace Domain\Category\Actions;

use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Category\Models\Category;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateCategoryAction
{
    use AsAction;

    public function __construct(
        protected Category $category
    ) {
    }

    public function handle(CategoryData $data): bool
    {
        return QueryBuilder::for($this->category)
            ->where('id', $data->id)
            ->update($data->toArray());
    }
}
