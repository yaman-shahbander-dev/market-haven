<?php

use Database\Factories\Client\UserFactory;
use Domain\Client\Actions\Admin\CreateTokenAction;
use Domain\Client\Enums\UserScopes;
use Illuminate\Support\Facades\Artisan;
use Domain\Client\DataTransferObjects\AdminData;

it("create a token for an admin", function () {
    Artisan::call('passport:install');
    $admin = UserFactory::new()->admin()->create();
    $result = CreateTokenAction::run($admin);
    expect($result)
        ->toBeObject()
        ->toBeInstanceOf(AdminData::class)
        ->toHaveKey('scope', UserScopes::ADMIN->value);
});
