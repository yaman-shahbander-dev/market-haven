<?php

namespace Domain\Category\Actions;

use Domain\Category\DataTransferObjects\CategoryData;
use Domain\Category\Models\Category;
use Lorisleiva\Actions\Concerns\AsAction;
use Shared\Helpers\PaginatedCollectionData;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetCategoriesAction
{
    use AsAction;

    public function __construct(
        protected Category $category
    ) {
    }

    public function handle(): PaginatedCollectionData
    {
        $categories = QueryBuilder::for($this->category)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->jsonPaginate(CategoryData::class);

        return CategoryData::paginatedCollection($categories);
    }
}
