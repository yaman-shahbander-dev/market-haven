<?php

namespace Domain\Client\Actions\Admin;

use App\Exceptions\Client\UserNotFoundException;
use Domain\Client\Actions\Shared\CreateTokenAction;
use Domain\Client\DataTransferObjects\AdminData;
use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\Enums\UserTypes;
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

    public function handle(AuthData $user): AdminData|null
    {
        $admin = QueryBuilder::for($this->user)
            ->where([
                'email' => $user->email,
                'type' => UserTypes::ADMIN
            ])
            ->first();

        if (!$admin) {
            throw new UserNotFoundException();
        }

        if (Hash::check($user->password, $admin->password)) {
            return CreateTokenAction::run($admin);
        }

        return null;
    }
}
