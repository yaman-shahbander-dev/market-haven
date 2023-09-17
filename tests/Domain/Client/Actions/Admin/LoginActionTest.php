<?php

use Database\Factories\Client\UserFactory;
use Illuminate\Support\Facades\Artisan;
use Domain\Client\Actions\Admin\LoginAction;
use Domain\Client\DataTransferObjects\AuthData;

it("it checks the login action for an admin", function () {
    Artisan::call('passport:install');
    $admin = UserFactory::new()->admin()->create();
    $adminLoginData = [
        'email' => $admin->email,
        'password' => 'password'
    ];
    $this->assertDatabaseCount('users', 1);
    $result = LoginAction::run(AuthData::from($adminLoginData));
    expect($result)->toBeObject();
});
