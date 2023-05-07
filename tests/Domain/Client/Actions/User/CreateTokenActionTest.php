<?php

use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\Shared\CreateTokenAction;
use Domain\Client\DataTransferObjects\UserData;
use Domain\Client\Enums\UserScopes;
use Illuminate\Support\Facades\Artisan;

it("create a token for a user", function () {
    Artisan::call('passport:install');
    $user = UserFactory::new()->create();
    $result = CreateTokenAction::run($user);
    expect($result)
        ->toBeObject()
        ->toBeInstanceOf(UserData::class)
        ->toHaveKey('scope', UserScopes::USER->value);
});
