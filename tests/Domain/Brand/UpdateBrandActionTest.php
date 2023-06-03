<?php

use Database\Factories\Brand\BrandFactory;
use Domain\Brand\Actions\UpdateBrandAction;
use Domain\Brand\DataTransferObjects\BrandData;

it('updates a brand from action', function () {
    $this->assertDatabaseCount('brands', 0);
    $brand = BrandFactory::new()->create();
    $result = UpdateBrandAction::run(BrandData::from($brand));
    $this->assertDatabaseCount('brands', 1);
    expect($result)->toBeTrue();
});
