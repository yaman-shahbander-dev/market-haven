<?php

use Database\Factories\Category\CategoryFactory;
use Illuminate\Http\Response;

beforeEach(function () {
   $this->categories = CategoryFactory::new()->count(10)->create();
});

it('gets paginated categories for the user', function () {
   $this->get(route('category.index'))
       ->assertStatus(Response::HTTP_OK);
});

it('gets a category for the admin', function () {
    $this->get(route('category.show', ['category' => $this->categories->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});
