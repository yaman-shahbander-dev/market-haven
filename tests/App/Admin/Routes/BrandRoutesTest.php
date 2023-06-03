<?php

test('checks if routes are exist in brand file that is located in admin v1 folder', function () {
    $brandURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.brand');

    $this->expect(route('admin.brand.index'))
        ->toBe($brandURL . '/brand');

    $this->expect(route('admin.brand.show', ['brand' => '0']))
        ->toBe($brandURL . '/brand/0');

    $this->expect(route('admin.brand.store'))
        ->toBe($brandURL . '/brand');

    $this->expect(route('admin.brand.update', ['brand' => '0']))
        ->toBe($brandURL . '/brand/0');

    $this->expect(route('admin.brand.destroy', ['brand' => '0']))
        ->toBe($brandURL . '/brand/0');
});
