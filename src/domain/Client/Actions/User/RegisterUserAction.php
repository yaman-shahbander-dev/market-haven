<?php

namespace Domain\Client\Actions\User;

use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\DataTransferObjects\UserData;
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
        if ($authData->name === null) {
            $authData->name = $authData->login;
        }

        $user = QueryBuilder::for($this->user)->create($authData->except('login')->toArray());

        if ($user === null) {
            return null;
        }

        if (AssignPermissionsToUserAction::run($user)) {
            return LoginAction::run($authData, $user);
        }

        return null;
    }
}
