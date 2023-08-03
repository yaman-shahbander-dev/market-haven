<?php

use Database\Factories\Brand\BrandFactory;
use Domain\Brand\Actions\GetBrandsAction;

it('gets paginated brand from action', function () {
    BrandFactory::new()->count(10)->create();
    $brands = GetBrandsAction::run();
    expect($brands)
        ->toHaveCount(10)
        ->each(function ($brand) {
            expect($brand)->toBeObject();
        });
});
