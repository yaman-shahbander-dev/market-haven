<?php

use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\User\RegisterUserAction;
use Domain\Client\DataTransferObjects\AuthData;

it("checks if register action is working correctly", function () {
   Artisan::call('passport:install');
   $user = UserFactory::new()->definition();
   $this->assertDatabaseCount('users', 0);
   $result = RegisterUserAction::run(AuthData::from($user));
   $this->assertDatabaseCount('users', 1);
   expect($result)->toBeObject();
});
