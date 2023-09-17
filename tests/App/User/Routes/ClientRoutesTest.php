<?php

test('checks if routes are exist in client file that is located in user v1 folder', function () {
    $clientURL = config('app.url') . '/' . config('route-prefix.user.v1.prefix') . '/' . config('route-prefix.user.v1.client');

    $this->expect(route('user.login'))
        ->toBe($clientURL . '/login');

    $this->expect(route('user.register'))
        ->toBe($clientURL . '/register');

    $this->expect(route('user.logout'))
        ->toBe($clientURL . '/logout');
});
