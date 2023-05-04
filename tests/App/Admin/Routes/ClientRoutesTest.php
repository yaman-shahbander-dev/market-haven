<?php

test('checks if routes are exist in client file that is located in admin v1 folder', function () {
    $clientURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.client');

    $this->expect(route('admin.login'))
        ->toBe($clientURL . '/login');

    $this->expect(route('admin.logout'))
        ->toBe($clientURL . '/logout');
});
