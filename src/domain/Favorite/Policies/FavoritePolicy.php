<?php

namespace Domain\Favorite\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;

class FavoritePolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can(PermissionEnum::FAVORITE_VIEW_ANY->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::FAVORITE_CREATE->value);
    }
}
