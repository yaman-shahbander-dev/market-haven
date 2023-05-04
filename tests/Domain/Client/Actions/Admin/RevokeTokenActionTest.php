<?php

use Illuminate\Support\Facades\Artisan;
use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\Admin\CreateTokenAction;
use Domain\Client\Actions\Admin\RevokeTokenAction;

it("revokes tokens from the admin", function () {
    Artisan::call("passport:install");
    $admin = UserFactory::new()->admin()->create();
    CreateTokenAction::run($admin);
    $result = RevokeTokenAction::run($admin);
    expect($result)->toBeTrue();
});
