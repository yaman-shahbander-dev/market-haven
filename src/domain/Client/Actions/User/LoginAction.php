<?php

namespace Domain\Client\Actions\User;

use App\Exceptions\Client\UserNotFoundException;
use Domain\Client\Actions\Shared\CreateTokenAction;
use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\DataTransferObjects\UserData;
use Domain\Client\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class LoginAction
{
    use AsAction;

    public function __construct(protected User $user)
    {
    }

    public function handle(AuthData $authData, ?User $authUser = null): UserData|null
    {
        $user = $authUser ?? QueryBuilder::for($this->user)
            ->where('email', $authData->email)
            ->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (Hash::check($authData->password, $user->password)) {
            return CreateTokenAction::run($user);
        }

        return null;
    }
}
