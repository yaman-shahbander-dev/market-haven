<?php

namespace Domain\Client\Actions\Shared;

use Domain\Client\DataTransferObjects\AdminData;
use Domain\Client\DataTransferObjects\UserData;
use Domain\Client\Enums\UserScopes;
use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTokenAction
{
    use AsAction;

    public function __construct(
      protected User $user
    ) {
    }

    public function handle(User $user): UserData|AdminData
    {
        $user->bearerToken = $user->createToken(
           config('auth.defaults.token_name'),
           [$user->scope]
        )->accessToken;

        return $user->scope === UserScopes::ADMIN->value
            ? AdminData::from($user)
            : UserData::from($user);
    }
}
