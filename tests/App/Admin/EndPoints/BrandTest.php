<?php

use Database\Factories\Brand\BrandFactory;
use Illuminate\Http\Response;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->brands = BrandFactory::new()->count(10)->create();
    $this->admin = UserFactory::new()->admin()->create();
    actingAs($this->admin, ['admin']);
});

it('gets paginated brands for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BRAND_VIEW_ANY->value, ['admin']);
    $this->get(route('admin.brand.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a brand for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BRAND_VIEW_ANY->value, ['admin']);
    $this->get(route('admin.brand.show', ['brand' => $this->brands->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('stores a brand for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BRAND_CREATE->value, ['admin']);
    $this->post(route('admin.brand.store', ['name' => $this->brands->first()->name . ' test']))
        ->assertStatus(Response::HTTP_OK);
});

it('updates a brand for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BRAND_UPDATE->value, ['admin']);
    $this->put(
        route('admin.brand.update', [
        'brand' => $this->brands->first(),
        'name' => $this->brands->first()->name . ' test'
    ])
    )->assertStatus(Response::HTTP_OK);
});

it('deletes a brand for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::BRAND_DELETE->value, ['admin']);
    $this->delete(route('admin.brand.destroy', ['brand' => $this->brands->first()]))
        ->assertStatus(Response::HTTP_OK);
});
