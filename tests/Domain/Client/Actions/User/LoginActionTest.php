<?php

use Database\Factories\Client\UserFactory;
use Illuminate\Support\Facades\Artisan;
use Domain\Client\Actions\User\LoginAction;
use Domain\Client\DataTransferObjects\AuthData;

it("it checks the login action for a user", function () {
    Artisan::call('passport:install');
    $user = UserFactory::new()->create();
    $userLoginData = [
        'email' => $user->email,
        'password' => 'password'
    ];
    $this->assertDatabaseCount('users', 1);
    $result = LoginAction::run(AuthData::from($userLoginData));
    expect($result)->toBeObject();
});
