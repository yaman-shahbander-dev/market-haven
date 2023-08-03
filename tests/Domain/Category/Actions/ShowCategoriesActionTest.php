<?php

use Database\Factories\Category\CategoryFactory;
use Domain\Category\Actions\ShowCategoryAction;

it('gets a category from action', function () {
    $category = CategoryFactory::new()->create();
    $category = ShowCategoryAction::run($category->id);
    expect($category)
        ->toBeObject()
        ->toHaveKeys(['id', 'main_category_id', 'name', 'created_at', 'updated_at', 'deleted_at']);
});
