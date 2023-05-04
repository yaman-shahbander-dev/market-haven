<?php

use Illuminate\Support\Facades\Artisan;
use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\Admin\CreateTokenAction;
use Domain\Client\Actions\Admin\RevokeTokenAction;

it("revokes tokens from the user", function () {
    Artisan::call("passport:install");
    $user = UserFactory::new()->create();
    CreateTokenAction::run($user);
    $result = RevokeTokenAction::run($user);
    expect($result)->toBeTrue();
});
