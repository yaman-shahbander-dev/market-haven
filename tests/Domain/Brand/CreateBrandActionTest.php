<?php

use Database\Factories\Brand\BrandFactory;
use Domain\Brand\Actions\CreateBrandAction;
use Domain\Brand\DataTransferObjects\BrandData;

it('creates a new brand from action', function () {
    $this->assertDatabaseCount('brands', 0);
    $brand = BrandFactory::new()->definition();
    $brand = CreateBrandAction::run(BrandData::from($brand));
    $this->assertDatabaseCount('brands', 1);
    expect($brand)
        ->toBeObject()
        ->toHaveKeys(['id', 'name', 'created_at', 'updated_at', 'deleted_at']);
});
