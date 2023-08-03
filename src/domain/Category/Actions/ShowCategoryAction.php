<?php

namespace Domain\Category\Actions;

use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Category\Models\Category;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowCategoryAction
{
    use AsAction;

    public function __construct(
        protected Category $category
    ) {
    }

    public function handle(string $id): CategoryData|null
    {
        $category = QueryBuilder::for($this->category)
            ->where('id', $id)
            ->first();

        return $category ? CategoryData::from($category) : null;
    }
}
