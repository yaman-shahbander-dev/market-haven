<?php

namespace Domain\Client\Actions\Shared;

use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class RevokeTokenAction
{
    use AsAction;

    public function __construct()
    {
    }

    public function handle(User $user): bool
    {
        return $user->tokens()->delete();
    }
}
