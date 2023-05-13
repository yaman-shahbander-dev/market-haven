<?php

use Database\Factories\Category\CategoryFactory;
use Domain\Category\Actions\CreateCategoryAction;
use Domain\Category\DataTransferObjects\CategoryData;

it('creates a new category from action', function () {
    $category = CategoryFactory::new()->definition();
    $category = CreateCategoryAction::run(CategoryData::from($category));
    $this->assertDatabaseCount('categories', 1);
    expect($category)
        ->toBeObject()
        ->toHaveKeys(['id', 'main_category_id', 'name', 'created_at', 'updated_at', 'deleted_at']);
});
