<?php

test('checks if routes are exist in brand file that is located in user v1 folder', function () {
    $brandURL = config('app.url') . 'BrandRoutesTest.php/' . config('route-prefix.user.v1.prefix') . '/' . config('route-prefix.user.v1.brand');

    $this->expect(route('user.brand.index'))
        ->toBe($brandURL . '/brand');

    $this->expect(route('user.brand.show', ['brand' => '0']))
        ->toBe($brandURL . '/brand/0');
});
