<?php

use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\Shared\CreateTokenAction;
use Domain\Client\Actions\Shared\RevokeTokenAction;
use Illuminate\Support\Facades\Artisan;

it("revokes tokens from the admin", function () {
    Artisan::call("passport:install");
    $admin = UserFactory::new()->admin()->create();
    CreateTokenAction::run($admin);
    $result = RevokeTokenAction::run($admin);
    expect($result)->toBeTrue();
});
