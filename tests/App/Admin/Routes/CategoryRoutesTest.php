<?php

test('checks if routes are exist in category file that is located in admin v1 folder', function () {
    $categoryURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.category');

    $this->expect(route('admin.category.index'))
        ->toBe($categoryURL . '/category');

    $this->expect(route('admin.category.show', ['category' => '0']))
        ->toBe($categoryURL . '/category/0');

    $this->expect(route('admin.category.store'))
        ->toBe($categoryURL . '/category');

    $this->expect(route('admin.category.update', ['category' => '0']))
        ->toBe($categoryURL . '/category/0');

    $this->expect(route('admin.category.destroy', ['category' => '0']))
        ->toBe($categoryURL . '/category/0');
});
