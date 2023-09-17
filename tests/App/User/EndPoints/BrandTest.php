<?php

use Database\Factories\Brand\BrandFactory;
use Illuminate\Http\Response;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->brands = BrandFactory::new()->count(10)->create();
    $this->user = UserFactory::new()->create();
    actingAs($this->user, ['user']);
});

it('gets paginated brands for the user', function () {
    actWithPermission($this->user, PermissionEnum::BRAND_VIEW_ANY->value);
    $this->get(route('user.brand.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a brand for the user', function () {
    actWithPermission($this->user, PermissionEnum::BRAND_VIEW_ANY->value);
    $this->get(route('user.brand.show', ['brand' => $this->brands->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});
