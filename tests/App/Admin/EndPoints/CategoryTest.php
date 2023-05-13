<?php

use Database\Factories\Category\CategoryFactory;
use Illuminate\Http\Response;

beforeEach(function () {
   $this->categories = CategoryFactory::new()->count(10)->create();
});

it('gets paginated categories for the admin', function () {
   $this->get(route('admin.category.index'))
       ->assertStatus(Response::HTTP_OK);
});

it('gets a category for the admin', function () {
    $this->get(route('admin.category.show', ['category' => $this->categories->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('stores a category for the admin', function () {
    $this->post(route('admin.category.store', ['name' => $this->categories->first()->name . ' test']))
        ->assertStatus(Response::HTTP_OK);
});

it('updates a category for the admin', function () {
    $this->put(route('admin.category.update', [
        'category' => $this->categories->first()->id,
        'name' => $this->categories->first()->name . ' test'
    ]))->assertStatus(Response::HTTP_OK);
});

it('deletes a category for the admin', function () {
    $this->delete(route('admin.category.destroy', ['category' => $this->categories->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});
