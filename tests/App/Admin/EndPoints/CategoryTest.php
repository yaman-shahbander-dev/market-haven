<?php

use Database\Factories\Category\CategoryFactory;
use Illuminate\Http\Response;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->categories = CategoryFactory::new()->count(10)->create();
    $this->admin = UserFactory::new()->admin()->create();
    actingAs($this->admin, ['admin']);
});

it('gets paginated categories for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::CATEGORY_VIEW_ANY->value, ['admin']);
    $this->get(route('admin.category.index'))->assertStatus(Response::HTTP_OK);
});

it('gets a category for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::CATEGORY_VIEW_ANY->value, ['admin']);
    $this->get(route('admin.category.show', ['category' => $this->categories->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('stores a category for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::CATEGORY_CREATE->value, ['admin']);
    $this->post(route('admin.category.store', ['name' => $this->categories->first()->name . ' test']))
        ->assertStatus(Response::HTTP_OK);
});

it('updates a category for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::CATEGORY_UPDATE->value, ['admin']);
    $this->put(
        route('admin.category.update', [
        'category' => $this->categories->first(),
        'name' => $this->categories->first()->name . ' test'
    ])
    )->assertStatus(Response::HTTP_OK);
});

it('deletes a category for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::CATEGORY_DELETE->value, ['admin']);
    $this->delete(route('admin.category.destroy', ['category' => $this->categories->first()]))
        ->assertStatus(Response::HTTP_OK);
});
