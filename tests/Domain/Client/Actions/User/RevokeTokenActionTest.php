<?php

use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\Shared\CreateTokenAction;
use Domain\Client\Actions\Shared\RevokeTokenAction;
use Illuminate\Support\Facades\Artisan;

it("revokes tokens from the user", function () {
    Artisan::call("passport:install");
    $user = UserFactory::new()->create();
    CreateTokenAction::run($user);
    $result = RevokeTokenAction::run($user);
    expect($result)->toBeTrue();
});
