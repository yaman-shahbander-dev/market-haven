<?php

use Database\Factories\Category\CategoryFactory;
use Domain\Category\Actions\GetCategoriesAction;
use Spatie\LaravelData\DataCollection;

it('gets paginated categories from action', function () {
    CategoryFactory::new()->count(10)->create();
    $categories = GetCategoriesAction::run();
    expect($categories->data)
        ->toBeInstanceOf(DataCollection::class)
        ->toHaveCount(10)
        ->each(function ($category) {
            expect($category)
                ->toBeObject();
        });
});
