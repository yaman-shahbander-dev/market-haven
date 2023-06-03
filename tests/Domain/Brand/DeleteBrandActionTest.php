<?php

use Database\Factories\Brand\BrandFactory;
use Domain\Brand\Actions\DeleteBrandAction;

it('deletes a brand from action', function () {
    $brand = BrandFactory::new()->create();
    $result = DeleteBrandAction::run($brand->id);
    expect($result)->toBeTrue();
});
