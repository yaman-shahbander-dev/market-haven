<?php

use Database\Factories\Brand\BrandFactory;
use Domain\Brand\Actions\ShowBrandAction;

it('gets a brand from action', function () {
    $brand = BrandFactory::new()->create();
    $brand = ShowBrandAction::run($brand->id);
    expect($brand)
        ->toBeObject()
        ->toHaveKeys(['id', 'name', 'created_at', 'updated_at', 'deleted_at']);
});
