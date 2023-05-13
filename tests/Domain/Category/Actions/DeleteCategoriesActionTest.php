<?php

use Database\Factories\Category\CategoryFactory;
use Domain\Category\Actions\DeleteCategoryAction;

it('deletes a category from action', function () {
    $category = CategoryFactory::new()->create();
    $result = DeleteCategoryAction::run($category->id);
    $this->assertSoftDeleted($category);
    expect($result)
        ->toBeTrue();
});
