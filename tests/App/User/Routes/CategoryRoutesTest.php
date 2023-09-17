<?php

test('checks if routes are exist in category file that is located in admin v1 folder', function () {
    $categoryURL = config('app.url') . '/' . config('route-prefix.user.v1.prefix') . '/' . config('route-prefix.user.v1.category');

    $this->expect(route('category.index'))
        ->toBe($categoryURL . '/category');

    $this->expect(route('category.show', ['category' => '0']))
        ->toBe($categoryURL . '/category/0');
});
