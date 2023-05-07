<?php

use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\Shared\CreateTokenAction;
use Domain\Client\DataTransferObjects\AdminData;
use Domain\Client\Enums\UserScopes;
use Illuminate\Support\Facades\Artisan;

it("create a token for an admin", function () {
    Artisan::call('passport:install');
    $admin = UserFactory::new()->admin()->create();
    $result = CreateTokenAction::run($admin);
    expect($result)
        ->toBeObject()
        ->toBeInstanceOf(AdminData::class)
        ->toHaveKey('scope', UserScopes::ADMIN->value);
});
