<?php

namespace Domain\Category\Actions;

use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Category\Models\Category;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateCategoryAction
{
    use AsAction;

    public function __construct(
        protected Category $category
    ) {
    }

    public function handle(CategoryData $data): CategoryData|null
    {
        $category = QueryBuilder::for($this->category)
            ->create([
                'name' => $data->name,
                'main_category_id' => $data->mainCategoryId
            ]);

        return $category ? CategoryData::from($category) : null;
    }
}
