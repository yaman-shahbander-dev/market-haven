<?php

namespace Domain\Client\Actions\User;

use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\DataTransferObjects\UserData;
use Domain\Client\Enums\UserScopes;
use Domain\Client\Enums\UserTypes;
use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class RegisterUserAction
{
    use AsAction;

    public function __construct(protected User $user)
    {
    }

    public function handle(AuthData $authData): UserData|null
    {
        $user = QueryBuilder::for($this->user)->create($authData->toArray());

        if ($user === null) {
            return null;
        }

        return LoginAction::run($authData, $user);
    }
}
