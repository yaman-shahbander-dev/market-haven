<?php

use Database\Factories\Category\CategoryFactory;
use Domain\Category\Actions\UpdateCategoryAction;
use Domain\Category\DataTransferObjects\CategoryData;

it('updates a new category from action', function () {
    $category = CategoryFactory::new()->create();
    $result = UpdateCategoryAction::run(CategoryData::from($category));
    $this->assertDatabaseCount('categories', 1);
    expect($result)
        ->toBeTrue();
});
