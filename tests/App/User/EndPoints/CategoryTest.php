<?php

use Database\Factories\Category\CategoryFactory;
use Illuminate\Http\Response;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->categories = CategoryFactory::new()->count(10)->create();
    $this->user = UserFactory::new()->create();
    actingAs($this->user);
});

it('gets paginated categories for the user', function () {
    actWithPermission($this->user, PermissionEnum::CATEGORY_VIEW_ANY->value);
    $this->get(route('category.index'))
        ->assertStatus(Response::HTTP_OK);
});

it('gets a category for the admin', function () {
    actWithPermission($this->user, PermissionEnum::CATEGORY_VIEW_ANY->value);
    $this->get(route('category.show', ['category' => $this->categories->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});
